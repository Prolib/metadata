<?php declare(strict_types = 1);

namespace ProLib\Metadata\OpenGraphs;

use Nette\Application\UI\ITemplate;
use ProLib\Metadata\IMetadata;

interface IOpenGraph {

	public function getType(): string;

	public function getImage(): ?string;

	public function templateToString(ITemplate $template, IMetadata $metadata): string;

}
