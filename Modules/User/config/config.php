<?php

return [
    'name' => 'User',
    'email' => [
        'subject_notification' => 'Barová Inventúra',
        'sender_email' => env('MAIL_SENDER_EMAIL', 'vasa@barovainventura.sk'),
        'sender_name' => env('MAIL_SENDER_NAME', 'Vaša barová inventúra')
    ]
];
