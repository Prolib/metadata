<?php declare(strict_types = 1);

namespace ProLib\Metadata\Nette;

use Nette\Application\UI\ComponentReflection;
use Nette\Application\UI\MethodReflection;
use ProLib\Metadata\Attribute\MetadataAttributeApplier;
use ProLib\Metadata\IMetadata;
use ProLib\Metadata\IMetadataComponent;

trait TPresenter
{

	public IMetadata $metadata;

	private IMetadataComponent $metadataComponent;

	private MetadataAttributeApplier $metadataAttributeApplier;

	final public function injectMetadataPresenter(IMetadataComponent $metadataComponent): void
	{
		$this->metadataComponent = $metadataComponent;
		$this->metadata = $metadataComponent->getMetadata();
		$this->metadataAttributeApplier = new MetadataAttributeApplier($this->metadata);
	}

	/**
	 * @param ComponentReflection|MethodReflection $element
	 */
	public function checkRequirements($element): void
	{
		parent::checkRequirements($element);

		$this->checkRequirementsForMetadata($element);
	}

	private function checkRequirementsForMetadata(ComponentReflection|MethodReflection $element): void
	{
		$this->metadataAttributeApplier->applyByReflection($element);
	}

	protected function createComponentMetadata(): IMetadataComponent
	{
		return $this->metadataComponent;
	}

}
