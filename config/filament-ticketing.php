<?php

return [
    'user-model' => \App\Models\User::class,

    // You can extend the package's TicketResource to customize to your needs.
    'ticket-resource' => App\Filament\Resources\TicketResource::class,

    // whether a ticket must be strictly interacted with another model
    'is_strictly_interacted' => false,

    // filament navigation
    'navigation' => [
        'group' => 'Layanan TI',
        'sort' => 1,
    ],

    // ticket titles
    'titles' => [
        1 => 'Infrastruktur Jaringan',
        2 => 'Perangkat TI',
        3 => 'Aplikasi',
        4 => 'Video Conference',
    ],

    // ticket statuses
    'statuses' => [
        1 => 'Open',
        2 => 'Pending',
        3 => 'Resolved',
        4 => 'Closed',
    ],

    // ticket priorities
    'priorities' => [
        1 => 'Low',
        2 => 'Normal',
        3 => 'High',
        4 => 'Critical',
    ],

    // use authorization
    'use_authorization' => true,

    // event broadcast channel
    'event_broadcast_channel' => 'ticket-channel',
];
