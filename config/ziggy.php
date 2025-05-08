<?php

return [
    'groups' => [
        'common' => [
            'home',
        ],
        'guset' => [
            'register',
            'login',
            'password.request',
            'password.email',
            'password.reset',
            'password.store',
        ],
        'auth' => [
            'dashboard',
            'settings',
            'profile.*',
            'password.edit',
            'password.update',
            'appearance',
            'verification.notice',
            'verification.verify',
            'verification.send',
            'password.confirm',
            'login',
            'logout',
        ],
    ],
];
