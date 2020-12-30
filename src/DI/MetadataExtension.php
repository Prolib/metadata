<?php declare(strict_types = 1);

namespace ProLib\Metadata\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Statement;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use ProLib\Metadata\IMetadata;
use ProLib\Metadata\IMetadataComponent;
use ProLib\Metadata\Metadata;
use ProLib\Metadata\MetadataComponent;
use stdClass;

final class MetadataExtension extends CompilerExtension {

	/** @var array */
	public $defaults = [
		'title' => null,
		'image' => null,
		'themeColor' => null,
		'author' => null,
		'twitterSite' => null,
		'description' => null,
		'favicon' => null,
		'siteName' => null,
		'googleApi' => null,
		'facebookApi' => null,
	];

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'meta' => Expect::structure([
				'title' => Expect::string()->required(),
				'titleComposite' => Expect::string()->required(),
				'siteName' => Expect::string()->nullable(),
				'description' => Expect::string()->nullable(),
				'image' => Expect::string()->nullable(),
				'author' => Expect::string()->nullable(),
				'favicon' => Expect::string()->nullable(),
			]),

			'mobile' => Expect::structure([
				'themeColor' => Expect::string()->nullable(),
			]),

			'api' => Expect::structure([
				'facebook' => Expect::string()->nullable(),
				'google' => Expect::string()->nullable(),
			]),

			'twitter' => Expect::structure([
				'site' => Expect::string()->nullable(),
			]),
		]);
	}

	public function loadConfiguration(): void {
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		$builder->addDefinition($this->prefix('metadata'))
			->setFactory(Metadata::class)
			->setType(IMetadata::class)
			->setSetup($this->prepareSetup($config));

		$builder->addDefinition($this->prefix('metadata.component'))
			->setFactory(MetadataComponent::class)
			->setType(IMetadataComponent::class);
	}

	protected function prepareSetup(stdClass $config): array {
		$setup = [];

		$this->fromConfig((array) $config->meta, $setup);
		$this->fromConfig((array) $config->mobile, $setup);
		$this->fromConfig([
			'googleApi' => $config->api->google,
			'facebookApi' => $config->api->facebook,
			'twitterSite' => $config->twitter->site,
		], $setup);

		/*foreach ($config as $name => $value) {
			if ($value === null) {
				continue;
			}

			$setup[] = new Statement('set' . ucfirst($name), [$this->getContainerBuilder()::literal('?', [$value])]);
		}*/

		return $setup;
	}

	private function fromConfig(array $config, array &$setup): void
	{
		foreach ($config as $name => $value) {
			if ($value === null) {
				continue;
			}

			$setup[] = new Statement('set' . ucfirst($name), [$this->getContainerBuilder()::literal('?', [$value])]);
		}
	}

}
