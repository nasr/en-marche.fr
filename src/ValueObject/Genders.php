<?php

namespace AppBundle\ValueObject;

final class Genders
{
    const MALE = 'male';
    const FEMALE = 'female';
    const OTHER = 'other';

    const ALL = [
        self::MALE,
        self::FEMALE,
        self::OTHER,
    ];

    const CHOICES = [
        'common.gender.man' => self::MALE,
        'common.gender.woman' => self::FEMALE,
        'common.gender.other' => self::OTHER,
    ];

    const CIVILITY_CHOICES = [
        'common.civility.mrs' => self::FEMALE,
        'common.civility.mr' => self::MALE,
    ];

    private function __construct()
    {
    }

    public static function all()
    {
        return self::ALL;
    }
}
