<?php

define('AVAILABLE_ROUTES', [
    'home' => 'RoomController',
    'about' => 'AboutController',
    'room' => 'RoomController',
    'message' => 'MessageController',
]);

define('ROUTE_ACTIONS', [
    'room' => [
        'create' => 'createRoom'
    ],
    'message' => [
        'send' => 'sendMessage',
        'pin' => 'pinMessage'
    ]
]);
