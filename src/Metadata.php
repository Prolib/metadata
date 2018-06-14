<?php

declare(strict_types=1);

namespace ProLib\Metadata;

use ProLib\Metadata\OpenGraphs\IOpenGraph;

class Metadata implements IMetadata {

	/** @var string */
	private $title;

	/** @var string */
	private $addTitle;

	/** @var string */
	private $image;

	/** @var string */
	private $themeColor;

	/** @var string */
	private $author;

	/** @var string */
	private $description;

	/** @var string */
	private $url;

	/** @var IOpenGraph */
	private $openGraph;

	/** @var string */
	private $favicon;

	/** @var string */
	private $siteName;

	public function addToTitle(string $append): void {
		$this->addTitle = $append;
	}

	public function setImage(string $image): void {
		$this->image = $image;
	}

	public function setThemeColor(string $color): void {
		$this->themeColor = $color;
	}

	public function setAuthor(string $author): void {
		$this->author = $author;
	}

	public function setTitle(string $title): void {
		$this->title = $title;
	}

	public function setDescription(string $description): void {
		$this->description = $description;
	}

	public function setUrl(?string $url): void {
		$this->url = $url;
	}

	public function setOpenGraph(IOpenGraph $openGraph): void {
		$this->openGraph = $openGraph;
	}

	public function setFavicon(string $favicon): void {
		$this->favicon = $favicon;
	}

	public function setSiteName(string $siteName): void {
		$this->siteName = $siteName;
	}

	public function getThemeColor(): ?string {
		return $this->themeColor;
	}

	public function getAuthor(): ?string {
		return $this->author;
	}

	public function getTitle(): ?string {
		if ($this->addTitle) {
			return $this->addTitle . ' | ' . $this->title;
 		}

		return $this->title;
	}

	public function getDescription(): ?string {
		return $this->description;
	}

	public function getOpenGraph(): ?IOpenGraph {
		return $this->openGraph;
	}

	public function getFavicon(): ?string {
		return $this->favicon;
	}

	public function getSiteName(): ?string {
		return $this->siteName;
	}

	public function getImage(): ?string {
		return $this->image;
	}

}
