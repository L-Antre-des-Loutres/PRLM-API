<?php

namespace App\Enum;

enum EvolutionCategory: string
{
    case LEVEL_UP = 'level_up';
    case ITEM = 'item';
    case TRADE = 'trade';
    case FRIENDSHIP = 'friendship';
    case OTHER = 'other';
}
