<?php declare(strict_types = 1);

namespace ProLib\Metadata\Nette;

use ProLib\Metadata\IMetadata;
use ProLib\Metadata\IMetadataComponent;

trait TPresenter
{

	public IMetadata $metadata;

	private IMetadataComponent $metadataComponent;

	public function injectMetadataPresenter(IMetadataComponent $metadataComponent): void
	{
		$this->metadataComponent = $metadataComponent;
		$this->metadata = $metadataComponent->getMetadata();
	}

	protected function createComponentMetadata(): IMetadataComponent
	{
		return $this->metadataComponent;
	}

}
