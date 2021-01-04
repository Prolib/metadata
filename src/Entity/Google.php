<?php declare(strict_types = 1);

namespace ProLib\Metadata\Entity;

final class Google
{

	private ?string $analytics;
	private ?string $tagMnager;
	private ?string $siteVerification;

	public function __construct(?string $analytics, ?string $tagManager, ?string $siteVerification)
	{
		$this->analytics = $analytics;
		$this->tagManager = $tagManager;
		$this->siteVerification = $siteVerification;
	}

	public function getAnalytics(): ?string
	{
		return $this->analytics;
	}

	public function getTagManager(): ?string
	{
		return $this->tagManager;
	}

	public function getSiteVerification(): ?string
	{
		return $this->siteVerification;
	}

}
