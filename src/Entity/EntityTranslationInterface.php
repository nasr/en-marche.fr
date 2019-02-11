<?php

namespace AppBundle\Entity;

//use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;

interface EntityTranslationInterface
{
    public function isEmpty(): bool;
}
