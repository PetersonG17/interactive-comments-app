<?php

use App\Comment\Api\Actions\GetCommentAction;
use GuzzleHttp\Psr7\Response;

// Define the routes in the app
$app->get('/', function ($request, $response, array $args) {
    return new Response(200, [], "You made it");
});

$app->get('/comments', GetCommentAction::class);
