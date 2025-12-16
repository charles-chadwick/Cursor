<?php

namespace App\Enums;

enum ContactType: string {
    case Personal = 'Personal';
    case Cell = 'Cell';
    case Office = 'Office';
}