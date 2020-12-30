<?php declare(strict_types = 1);

namespace ProLib\Metadata;

interface IMetadataComponent 
{

	public function getMetadata(): IMetadata;

}
