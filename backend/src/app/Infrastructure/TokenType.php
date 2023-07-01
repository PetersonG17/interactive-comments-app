<?php

namespace App\Infrastructure;

enum TokenType: int
{
    case ACCESS = 1;
    case REFRESH = 2;
}