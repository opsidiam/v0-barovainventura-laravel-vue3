<?php

return [
    'name' => 'License',
    'email' => [
        'subject' => 'Barová Inventúra',
        'sender_email' => env('MAIL_SENDER_EMAIL', 'vasa@barovainventura.sk'),
        'sender_name' => env('MAIL_SENDER_NAME', 'Vaša barová inventúra')
    ]
];
