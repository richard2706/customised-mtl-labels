<?php

namespace App\Enums;

enum AgeCategory: String
{
    case FOUR_TO_SIX = '4-6';
    case SEVEN_TO_TEN = '7-10';
    case ELEVEN_TO_FOURTEEN = '11-14';
    case FIFTEEN_TO_EIGHTEEN = '15-18';
    case NINETEEN_TO_SIXTY_FOUR = '19-64';
    case SIXTY_FIVE_TO_SEVENTY_FOUR = '65-74';
    case SEVENTY_FIVE_PLUS = '75+';

    public const DEFAULT = self::NINETEEN_TO_SIXTY_FOUR;
}

?>