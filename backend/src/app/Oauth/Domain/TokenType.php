<?php

namespace App\Oauth\Domain;

enum TokenType
{
    case Access;
    case Refresh;
}