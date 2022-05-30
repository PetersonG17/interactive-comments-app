<?php

use App\Comment\Api\Actions\GetCommmentAction;

// Define the routes in the app
$app->get('/comments', GetCommmentAction::class);
