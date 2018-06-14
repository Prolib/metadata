<?php

declare(strict_types=1);

namespace ProLib\Metadata;

use Nette\Application\UI\Control;

class MetadataComponent extends Control implements IMetadataComponent {

	/** @var IMetadata */
	private $metadata;

	public function __construct(IMetadata $metadata) {
		$this->metadata = $metadata;
	}

	public function getMetadata(): IMetadata {
		return $this->metadata;
	}

	public function renderOpenGraph(): void {
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/open-graph.latte');

		$template->link = $this->getLink();
		$template->description = $this->metadata->getDescription();
		$template->title = $this->metadata->getTitle();
		$template->type = $this->metadata->getOpenGraph() ? $this->metadata->getOpenGraph()->getType() : 'website';
		$template->image = $this->metadata->getOpenGraph() ?
			$this->metadata->getOpenGraph()->getImage() : $this->metadata->getImage();

		$template->og = null;
		if ($this->metadata->getOpenGraph()) {
			$template->og = $this->metadata->getOpenGraph()->templateToString($this->createTemplate(), $this->metadata);
		}

		$template->render();
	}

	public function renderFavicon(): void {
		if ($this->metadata->getFavicon()) {
			return;
		}
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/favicon.latte');

		$template->favicon = $this->metadata->getFavicon();

		$template->render();
	}

	public function render(): void {
		$template = $this->getTemplate();
		$template->setFile(__DIR__ . '/templates/base.latte');

		$template->title = $this->metadata->getTitle();
		$template->description = $this->metadata->getDescription();
		$template->author = $this->metadata->getAuthor();

		$template->render();
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

	protected function getLink(): string {
		return $this->link('this');
	}

}
