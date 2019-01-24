<?php

namespace AppBundle\Entity\Formation;

use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use AppBundle\Entity\EntityMediaInterface;
use AppBundle\Entity\EntityMediaTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="formation_articles")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Formation\ArticleRepository")

 * @Algolia\Index(autoIndex=false)
 *
 * @UniqueEntity(fields={"title", "axe"}, message="Il existe déjà un article avec ce titre pour cet axe de formation.")
 * @UniqueEntity(fields={"slug", "axe"}, message="Il existe déjà un article avec cette URL pour cet axe de formation.")
 */
class Article implements EntityMediaInterface
{
    use EntityMediaTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(unique=true)
     *
     * @Assert\NotBlank(message="Veuillez renseigner un titre.")
     * @Assert\Length(min=2, minMessage="Le titre doit faire au moins 2 caractères.")
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(unique=true)
     *
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank(message="Veuillez renseigner une description.")
     * @Assert\Length(min=2, minMessage="La description doit faire au moins 2 caractères.")
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank(message="Veuillez renseigner un contenu.")
     */
    private $content;

    /**
     * @var Axe|null
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Formation\Axe", inversedBy="articles")
     *
     * @Assert\NotBlank(message="Veuillez renseigner un axe.")
     */
    private $axe;

    public function __toString()
    {
        return (string) $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAxe(): ?Axe
    {
        return $this->axe;
    }

    public function setAxe(Axe $axe): void
    {
        $this->axe = $axe;
    }
}
