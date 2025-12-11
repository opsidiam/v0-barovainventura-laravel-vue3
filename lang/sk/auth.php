<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Prihlasovacie údaje nie sú správne.',
    'please_enter_a_username' => 'Zadajte používateľské meno.',
    'please_provide_a_password' => 'Zadajte heslo.',
    'throttle' => 'Prekročený limit pokusov. Skúste znovu o :seconds sekúnd.',
    'email_already_exists' => 'Email už existuje.',
    'logout_successful' => 'Odhlásenie bolo úspešné',
    'need_login' => 'Pred pokračovaním sa musíte prihlásiť.',
    'verify_success' => 'Overenie bolo úspešné.',
    'user_is_not_verified' => 'Používateľ ešte nebol overený.',
    'user_verification_failed' => 'Overenie bolo neúspešné.',
    'user_does_not_exist' => 'Používateľ neexistuje.',
    'token_invalid' => 'Token je neplatný.',
    'token_expired' => 'Platnosť tokenu vypršala.',
    'token_not_found' => 'Autorizačný token sa nenašiel.',
    'or' => 'alebo',
    'register' => [
        'title' => 'Registrácia',
        'name' => 'Meno',
        'surname' => 'Priezvisko',
        'email' => 'Emailová adresa',
        'phone' => 'Telefónne číslo',
        'no_required' => 'Nepovinné',
        'password' => 'Heslo',
        'password_confirm' => 'Potvrdenie hesla',
        'submit' => 'Registrovať sa',
        'have_account' => 'Už máte účet?',
        'login_link' => 'Prihláste sa',
        'reference' => 'Odkiaľ ste sa o nás dozvedeli?'
    ],
    'login' => [
        'title' => 'Prihlásenie',
        'email' => 'Email',
        'email_placeholder' => 'Zadajte váš email',
        'password' => 'Heslo',
        'password_placeholder' => 'Zadajte vaše heslo',
        'remember_me' => 'Zapamätať prihlásenie',
        'submit' => 'Prihlásiť sa',
        'forgot_password' => 'Zabudli ste heslo?',
    ],

    'verify' => [
        'title' => 'Overenie emailovej adresy',
        'fresh_link_sent' => 'Nový overovací odkaz bol odoslaný na vašu emailovú adresu.',
        'check_email' => 'Pred pokračovaním si prosím skontrolujte email a nájdite overovací odkaz.',
        'not_received' => 'Ak ste email neobdržali',
        'request_another' => 'kliknite sem pre opätovné odoslanie',
    ],

    'confirm' => [
        'title' => 'Potvrdenie hesla',
        'message' => 'Pre pokračovanie potvrďte prosím svoje heslo.',
        'password_label' => 'Heslo',
        'password_placeholder' => 'Zadajte svoje heslo',
        'submit' => 'Potvrdiť heslo',
        'forgot_password' => 'Zabudli ste heslo?',
    ],

    'reset' => [
        'title' => 'Obnova hesla',
        'status' => 'Na váš email bol odoslaný odkaz na obnovu hesla.',
        'email_label' => 'Emailová adresa',
        'email_placeholder' => 'Zadajte váš email',
        'submit' => 'Odoslať link na obnovu hesla',
    ],

    'reset_password' => [
        'title' => 'Nastavenie nového hesla',
        'email_label' => 'Emailová adresa',
        'email_placeholder' => 'Zadajte váš email',
        'new_password_label' => 'Nové heslo',
        'new_password_placeholder' => 'Zadajte nové heslo',
        'confirm_password_label' => 'Potvrdenie hesla',
        'confirm_password_placeholder' => 'Zopakujte nové heslo',
        'password_requirements' => 'Heslo musí obsahovať aspoň 8 znakov, jedno veľké písmeno a jednu číslicu.',
        'password_match_error' => 'Heslá sa musia zhodovať.',
        'submit' => 'Nastaviť nové heslo',
    ],

    'validation' => [
        'name' => 'Meno musí mať 2-50 znakov.',
        'surname' => 'Priezvisko musí mať 2-50 znakov.',
        'email' => 'Zadajte prosím platný email.',
        'password' => 'Heslo musí mať aspoň 8 znakov.',
        'password_match' => 'Heslá sa musia zhodovať.',
    ],
    'password' => 'Zadané heslo nie je správne.',
];
