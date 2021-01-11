<?php declare(strict_types = 1);

namespace ProLib\Metadata;

use Nette\Application\UI\Control;
use Nette\Utils\Strings;

class MetadataComponent extends Control implements IMetadataComponent
{

	private IMetadata $metadata;

	public function __construct(IMetadata $metadata)
	{
		$this->metadata = $metadata;
	}

	public function getMetadata(): IMetadata
	{
		return $this->metadata;
	}

	public function renderTitle(): void
	{
		echo htmlspecialchars($this->metadata->getTitle(), ENT_QUOTES);
	}

	public function render(): void
	{
		$this->renderBase();
		$this->renderOpenGraph();
		$this->renderTopBar();
		$this->renderFavicon();
		$this->renderApi();
		$this->renderGoogle();
	}

	public function renderBody(): void
	{
		$this->renderGoogleBody();
	}

	public function renderGoogle(): void
	{
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/google.latte');

		$template->analytics = $this->metadata->getGoogle()?->getAnalytics();
		$template->tagManager = $this->metadata->getGoogle()?->getTagManager();
		$template->siteVerification = $this->metadata->getGoogle()?->getSiteVerification();

		$template->render();
	}

	public function renderGoogleBody(): void
	{
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/google.body.latte');

		$template->tagManager = $this->metadata->getGoogle()?->getTagManager();

		$template->render();
	}

	public function renderOpenGraph(): void
	{
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/open-graph.latte');

		$template->link = $this->getLink();
		$template->description = $this->metadata->getDescription();
		$template->title = $this->metadata->getTitle();
		$template->twitterSite = $this->metadata->getTwitterSite();
		$template->twitterCreator = $this->metadata->getTwitterCreator();
		$template->type = $this->metadata->getOpenGraph()?->getType() ?? 'website';
		$template->image = $this->metadata->getOpenGraph()?->getImage() ?? $this->metadata->getImage();
		$template->og = $this->metadata->getOpenGraph()?->templateToString($this->createTemplate(), $this->metadata);

		$template->render();
	}

	public function renderFavicon(): void
	{
		$favicon = $this->metadata->getFavicon();
		if (!$favicon) {
			return;
		}
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/favicon.latte');

		$suffix = ($pos = strrpos($favicon, '.')) !== false ? strtolower(substr($favicon, $pos + 1)) : null;

		$template->type = match ($suffix) {
			'jpg' => 'image/jpeg',
			'png' => 'image/png',
			default => 'image/x-icon'
		};
		$template->favicon = $favicon;

		$template->render();
	}

	public function renderBase(): void
	{
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/base.latte');

		$template->robots = $this->getRobots();
		$template->noFollow = $this->metadata->getNoFollow();
		$template->title = $this->metadata->getTitle();
		$template->description = $this->metadata->getDescription();
		$template->author = $this->metadata->getAuthor();

		$template->render();
	}

	private function getRobots(): string
	{
		$robots = [];
		if ($this->metadata->getNoIndex()) {
			$robots[] = 'noindex';
		}
		if ($this->metadata->getNoFollow()) {
			$robots[] = 'nofollow';
		}

		return implode(', ', $robots);
	}

	public function renderTopBar(?string $color = null): void {
		if (!$color && !$this->metadata->getThemeColor()) {
			return;
		}

		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/top-bar.latte');

		$template->color = $color ?: $this->metadata->getThemeColor();

		$template->render();
	}

	public function renderApi(): void {
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/api.latte');

		$template->facebookApi = $this->metadata->getFacebookApi();

		$template->render();
	}

	protected function getLink(): string
	{
		return $this->link('//this');
	}

}
