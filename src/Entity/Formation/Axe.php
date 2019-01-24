<?php

namespace AppBundle\Entity\Formation;

use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use AppBundle\Entity\EntityMediaInterface;
use AppBundle\Entity\EntityMediaTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="formation_axes")
 * @ORM\Entity

 * @Algolia\Index(autoIndex=false)
 *
 * @UniqueEntity(fields={"title"}, message="Il existe déjà un axe de formation avec ce titre.")
 */
class Axe implements EntityMediaInterface
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
     * @ORM\Column
     *
     * @Assert\NotBlank(message="Veuillez renseigner un titre.")
     * @Assert\Length(
     *     min=2,
     *     max=150,
     *     minMessage="Le titre doit faire au moins 2 caractères.",
     *     minMessage="Le titre doit pas faire plus de 150 caractères."
     * )
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(unique=true)
     *
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

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
     * @var Article[]|Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Formation\Article", mappedBy="axe")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

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

    public function getArticles(): Collection
    {
        return $this->articles;
    }
}
