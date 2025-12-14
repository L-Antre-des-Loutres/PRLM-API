<?php

namespace App\Enum;

enum MoveRange: string
{
    case ONE_POKEMON = 'one_pokemon';
    case ALL_POKEMON = 'all_pokemon';
    case ONE_ENEMY = 'one_enemy';
    case ALL_ENEMY = 'all_enemy';
    case SELF = 'self';
}
