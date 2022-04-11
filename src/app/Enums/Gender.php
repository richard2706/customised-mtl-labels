<?php

namespace App\Enums;

use InvalidArgumentException;

enum Gender: string
{
    case FEMALE = 'female';
    case MALE = 'male';
    case UNSPECIFIED = 'unspecified';

    /**
     * Returns the gender from the given value.
     */
    public static function genderFromString($string)
    {
        foreach (self::cases() as $case) {
            if (strcmp($case->value, $string) == 0) {
                return $case;
            }
        }
        throw new InvalidArgumentException('"' . $string . '" does not match a valid gender.');
    }
}

?>