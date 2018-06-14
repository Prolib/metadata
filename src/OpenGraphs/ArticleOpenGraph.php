<?php

declare(strict_types=1);

namespace ProLib\Metadata\OpenGraphs;

use Nette\Application\UI\ITemplate;
use ProLib\Metadata\IMetadata;

class ArticleOpenGraph implements IOpenGraph {

	/** @var string */
	private $image;

	public function __construct(string $image) {
		$this->image = $image;
	}

	public function getType(): string {
		return 'article';
	}

	public function getImage(): ?string {
		return $this->image;
	}

	public function templateToString(ITemplate $template, IMetadata $metadata): string {
		$template->setFile(__DIR__ . '/templates/article.latte');
		$template->description = $metadata->getDescription();
		$template->title = $metadata->getTitle();
		$template->ref = $this;

		return (string) $template;
	}

}
