<?php

declare(strict_types=1);

namespace ProLib\Metadata;

use ProLib\Metadata\OpenGraphs\IOpenGraph;

interface IMetadata {

	public function addToTitle(string $append): void;

	// setters

	public function setImage(string $image): void;

	public function setThemeColor(string $color): void;

	public function setAuthor(string $author): void;

	public function setTitle(string $title): void;

	public function setDescription(string $description): void;

	public function setUrl(?string $url): void;

	public function setOpenGraph(IOpenGraph $openGraph): void;

	public function setFavicon(string $favicon): void;

	public function setSiteName(string $siteName): void;

	// getters

	public function getThemeColor(): ?string;

	public function getAuthor(): ?string;

	public function getTitle(): ?string;

	public function getDescription(): ?string;

	public function getOpenGraph(): ?IOpenGraph;

	public function getFavicon(): ?string;

	public function getSiteName(): ?string;

	public function getImage(): ?string;

}
