<?php

namespace App\Infrastructure;

// This enum has to stay in sync with the DB table "tokens" column "type"
enum TokenType: int
{
    case ACCESS_TOKEN = 1;
    case REFRESH_TOKEN = 2;
}