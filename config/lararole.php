<?php

return [
    'providers' => [
        'user' => [
            'model' => Illuminate\Foundation\Auth\User::class,

            'modules' => [
                [
                    'name' => 'User Management',
                    'modules' => [
                        ['name' => 'Roles',],
                        ['name' => 'Users',],
                    ],
                ],
            ],
        ],
    ],
];
