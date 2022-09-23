<?php

use Slim\Routing\RouteCollectorProxy;
use App\Comment\Api\V1\Actions\GetCommentsAction;
use App\User\Api\V1\Actions\GetTokenAction;
use App\User\Api\V1\Actions\GetUserAction;
use App\User\Api\V1\Actions\PostUserAction;
use GuzzleHttp\Psr7\Response;

// Define the routes in the app
$app->get('/', function ($request, $response, array $args) {
    return new Response(200, [], "You made it");
});

// V1 Routes
$app->group('/api/v1', function (RouteCollectorProxy $group) {

    // Comments
    $group->get('/comments', GetCommentsAction::class);

    // Users
    $group->post('/users', PostUserAction::class);
    $group->get('/users/{id}', GetUserAction::class);

    // Auth
    $group->get('/token', GetTokenAction::class);

});
