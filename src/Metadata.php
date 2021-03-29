<?php declare(strict_types = 1);

namespace ProLib\Metadata;

use Nette\Utils\Strings;
use ProLib\Metadata\Entity\Google;
use ProLib\Metadata\OpenGraphs\IOpenGraph;
use Contributte\Imagist\Entity\EmptyImage;
use Contributte\Imagist\Entity\PersistentImageInterface;
use Contributte\Imagist\LinkGeneratorInterface;

class Metadata implements IMetadata
{

	private ?string $title = null;

	private ?string $titleComposite = null;

	private ?string $image = null;

	private ?string $themeColor = null;

	private ?string $author = null;

	private ?string $description = null;

	private ?string $url = null;

	private ?IOpenGraph $openGraph = null;

	private ?string $favicon = null;

	private ?string $siteName = null;

	private ?string $facebookApi = null;

	private bool $noFollow = false;

	private bool $noIndex = false;

	private ?string $twitterSite = null;

	private ?string $twitterCreator = null;

	private ?LinkGeneratorInterface $linkGenerator;

	private ?Google $google;

	public function __construct(?LinkGeneratorInterface $linkGenerator, ?Google $google)
	{
		$this->linkGenerator = $linkGenerator;
		$this->google = $google;
	}

	public function setTitleComposite(string $titleComposite): void
	{
		$this->titleComposite = $titleComposite;
	}

	public function addToTitle(string $title): void
	{
		$title = trim($title);

		if ($this->titleComposite) {
			$this->title = sprintf($this->titleComposite, $title);
		} else {
			$this->title = $title;
		}
	}

	public function setImage(string $image): void
	{
		$this->image = $image;
	}

	public function setImageResource(?PersistentImageInterface $persistentImage, ?string $filter = null): void
	{
		if (!$persistentImage) {
			if ($this->image) {
				return;
			}

			$persistentImage = new EmptyImage();
		}

		if ($filter) {
			$persistentImage = $persistentImage->withFilter($filter);
		}

		if ($link = $this->linkGenerator?->link($persistentImage)) {
			$this->setImage($link);
		}
	}

	public function setThemeColor(string $color): void
	{
		$this->themeColor = $color;
	}

	public function setAuthor(string $author): void
	{
		$this->author = $author;
	}

	public function setTitle(string $title): void
	{
		$this->title = trim($title);
	}

	public function setDescription(string $description): void
	{
		$this->description = Strings::substring(trim($description), 0, 300);
	}

	public function setTwitterSite(?string $twitterSite): void
	{
		$this->twitterSite = $twitterSite;
	}

	public function setTwitterCreator(?string $twitterCreator): void
	{
		$this->twitterCreator = $twitterCreator;
	}

	public function setUrl(?string $url): void
	{
		$this->url = $url;
	}

	public function setOpenGraph(IOpenGraph $openGraph): void
	{
		$this->openGraph = $openGraph;
	}

	public function setFavicon(string $favicon): void
	{
		$this->favicon = $favicon;
	}

	public function setSiteName(string $siteName): void
	{
		$this->siteName = trim($siteName);
	}

	public function setFacebookApi(?string $facebookApi): void
	{
		$this->facebookApi = $facebookApi;
	}

	public function setNoFollow(bool $noFollow = true): void
	{
		$this->noFollow = $noFollow;
	}

	public function setNoIndex(bool $noIndex = true): void
	{
		$this->noIndex = $noIndex;
	}

	//

	public function getGoogle(): ?Google
	{
		return $this->google;
	}

	public function getThemeColor(): ?string
	{
		return $this->themeColor;
	}

	public function getAuthor(): ?string
	{
		return $this->author;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function getTwitterSite(): ?string
	{
		return $this->twitterSite;
	}

	public function getTwitterCreator(): ?string
	{
		return $this->twitterCreator;
	}

	public function getOpenGraph(): ?IOpenGraph
	{
		return $this->openGraph;
	}

	public function getFavicon(): ?string
	{
		return $this->favicon;
	}

	public function getSiteName(): ?string
	{
		return $this->siteName;
	}

	public function getImage(): ?string
	{
		return $this->image;
	}

	public function getFacebookApi(): ?string
	{
		return $this->facebookApi;
	}

	public function getNoFollow(): bool
	{
		return $this->noFollow;
	}

	public function getNoIndex(): bool
	{
		return $this->noIndex;
	}

}
