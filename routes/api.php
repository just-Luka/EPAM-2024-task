<?php

use App\Domain\Controller\EventController;

return [
    '/events' => [
        'GET' => [EventController::class, 'fetch'],
        'POST' => [EventController::class, 'create'],
    ],
];