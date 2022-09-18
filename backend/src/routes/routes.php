<?php

use App\Comment\Api\Actions\GetCommentsAction;
use App\User\Api\Actions\PostUserAction;
use GuzzleHttp\Psr7\Response;

// Define the routes in the app
$app->get('/', function ($request, $response, array $args) {
    return new Response(200, [], "You made it");
});

// Comments
$app->get('/comments', GetCommentsAction::class);

// Users
$app->post('/users', PostUserAction::class);
