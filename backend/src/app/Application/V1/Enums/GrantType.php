<?php

namespace App\Application\V1\Enums;

enum GrantType: string {
    case Password = 'password';
    case RefreshToken = 'refresh_token';
}