<?php

namespace App\Enum;

enum MoveCategory: string
{
    case PHYSICAL = 'physical';
    case SPECIAL = 'special';
    case STATUS = 'status';
}

