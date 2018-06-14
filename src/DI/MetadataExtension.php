<?php

declare(strict_types=1);

namespace ProLib\Metadata\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Statement;
use ProLib\Metadata\IMetadata;
use ProLib\Metadata\IMetadataComponent;
use ProLib\Metadata\Metadata;
use ProLib\Metadata\MetadataComponent;

class MetadataExtension extends CompilerExtension {

	/** @var array */
	public $defaults = [
		'title' => null,
		'image' => null,
		'themeColor' => null,
		'author' => null,
		'description' => null,
		'favicon' => null,
		'siteName' => null,
	];

	public function loadConfiguration(): void {
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		$builder->addDefinition($this->prefix('metadata'))
			->setFactory(Metadata::class)
			->setType(IMetadata::class)
			->setSetup($this->prepareSetup($config));

		$builder->addDefinition($this->prefix('metadata.component'))
			->setFactory(MetadataComponent::class)
			->setType(IMetadataComponent::class);
	}

	protected function prepareSetup(array $config): array {
		$setup = [];
		foreach ($config as $name => $value) {
			if ($value === null) {
				continue;
			}

			$setup[] = new Statement('set' . ucfirst($name), [$value]);
		}

		return $setup;
	}

}
