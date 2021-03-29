<?php declare(strict_types = 1);

namespace ProLib\Metadata\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS, Attribute::TARGET_METHOD)]
class Metadata
{

	public function __construct(
		public ?string $title = null,
		public ?string $addToTitle = null,
		public ?bool $noFollow = null,
		public ?bool $noIndex = null,
	)
	{
	}

}
