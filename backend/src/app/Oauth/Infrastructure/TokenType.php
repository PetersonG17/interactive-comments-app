<?php

namespace App\Oauth\Infrastructure;

enum TokenType: int
{
    case ACCESS = 1;
    case REFRESH = 2;
}