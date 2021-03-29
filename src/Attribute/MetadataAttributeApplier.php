<?php declare(strict_types = 1);

namespace ProLib\Metadata\Attribute;

use ProLib\Metadata\IMetadata;
use ReflectionClass;
use ReflectionMethod;

final class MetadataAttributeApplier
{

	private IMetadata $metadata;

	public function __construct(IMetadata $metadata)
	{
		$this->metadata = $metadata;
	}

	public function applyByReflection(ReflectionClass|ReflectionMethod $reflection): void
	{
		foreach ($reflection->getAttributes(Metadata::class) as $attribute) {
			$this->applyAttribute($attribute->newInstance());
		}
	}

	public function applyAttribute(Metadata $metadata): void
	{
		if ($metadata->title) {
			$this->metadata->setTitle($metadata->title);
		}

		if ($metadata->addToTitle) {
			$this->metadata->addToTitle($metadata->addToTitle);
		}

		if ($metadata->noFollow !== null) {
			$this->metadata->setNoFollow($metadata->noFollow);
		}

		if ($metadata->noIndex !== null) {
			$this->metadata->setNoIndex($metadata->noIndex);
		}
	}

}
