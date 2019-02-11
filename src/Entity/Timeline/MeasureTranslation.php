<?php

namespace AppBundle\Entity\Timeline;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use AppBundle\Entity\EntityTranslationInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\EntityListeners({"AppBundle\Entity\Timeline\MeasureTranslationListener"})
 * @ORM\Table(name="timeline_measure_translations")
 *
 * @UniqueEntity(fields={"locale", "title"}, errorPath="title")
 *
 * @Algolia\Index(autoIndex=false)
 */
class MeasureTranslation implements EntityTranslationInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(length=10)
     */
    protected $locale;
    protected $translatable;
    public function getId()
    {
        return $this->id;
    }
    public function getTranslatable()
    {
        return $this->translatable;
    }
    public function setTranslatable($translatable)
    {
        $this->translatable = $translatable;
        return $this;
    }
    public function getLocale()
    {
        return $this->locale;
    }
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(length=100)
     *
     * @Assert\NotBlank
     * @Assert\Length(max=Measure::TITLE_MAX_LENGTH)
     */
    private $title;

    public function __construct(string $locale = null, string $title = null)
    {
        $this->locale = $locale;
        $this->title = $title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function isEmpty(): bool
    {
        return empty($this->title);
    }
}
