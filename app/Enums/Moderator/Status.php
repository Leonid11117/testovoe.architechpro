<?php

namespace App\Enums\Moderator;

enum Status: string
{
    case ACTIVE = 'active';
    case REMOTE = 'remote';
}