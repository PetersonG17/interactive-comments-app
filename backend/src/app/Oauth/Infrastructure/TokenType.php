<?php

namespace App\Oauth\Infrastructure;

enum TokenType
{
    case ACCESS;
    case REFRESH;
}