<?php

namespace App\Utils\Traits;

trait EnumEnhancements
{
    public static function toArray(): array
    {
        return array_combine(self::getEnumNames(), self::getEnumValues());
    }

    public static function getEnumNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function getEnumValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function random()
    {
        $cases = self::cases();

        return $cases[array_rand($cases)];
    }
}
