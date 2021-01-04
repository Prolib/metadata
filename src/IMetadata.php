<?php declare(strict_types = 1);

namespace ProLib\Metadata;

use ProLib\Metadata\Entity\Google;
use ProLib\Metadata\OpenGraphs\IOpenGraph;
use WebChemistry\ImageStorage\Entity\PersistentImageInterface;

interface IMetadata
{

	public function addToTitle(string $append): void;

	// setters

	public function setImageResource(?PersistentImageInterface $persistentImage, ?string $filter = null): void;

	public function setTitleComposite(string $titleComposite): void;

	public function setImage(string $image): void;

	public function setThemeColor(string $color): void;

	public function setAuthor(string $author): void;

	public function setTitle(string $title): void;

	public function setDescription(string $description): void;

	public function setTwitterSite(?string $twitterSite): void;

	public function setTwitterCreator(?string $twitterCreator): void;

	public function setUrl(?string $url): void;

	public function setOpenGraph(IOpenGraph $openGraph): void;

	public function setFavicon(string $favicon): void;

	public function setSiteName(string $siteName): void;

	public function setFacebookApi(string $facebookApi): void;

	public function setNoFollow(bool $noFollow = true): void;

	public function setNoIndex(bool $noIndex = true): void;

	// getters

	public function getThemeColor(): ?string;

	public function getAuthor(): ?string;

	public function getTitle(): ?string;

	public function getDescription(): ?string;

	public function getTwitterSite(): ?string;

	public function getTwitterCreator(): ?string;

	public function getOpenGraph(): ?IOpenGraph;

	public function getGoogle(): ?Google;

	public function getFavicon(): ?string;

	public function getSiteName(): ?string;

	public function getImage(): ?string;

	public function getFacebookApi(): ?string;

	public function getNoFollow(): bool;

	public function getNoIndex(): bool;

}
