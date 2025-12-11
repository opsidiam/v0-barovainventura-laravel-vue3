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

    'failed' => 'These credentials do not match our records.',
    'please_enter_a_username' => 'Please enter a username.',
    'please_provide_a_password' => 'Please provide a password.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'email_already_exists' => 'Email already exists.',
    'logout_successful' => 'Logout successful.',
    'need_login' => 'You need to login before continuing.',
    'verify_success' => 'Verification successful.',
    'user_is_not_verified' => 'User is not verified yet.',
    'user_verification_failed' => 'User verification failed.',
    'user_does_not_exist' => 'User does not exist.',
    'token_invalid' => 'Token is invalid.',
    'token_expired' => 'Token has expired.',
    'token_not_found' => 'Authorization token not found.',
    'or' => 'or',

    'register' => [
        'title' => 'Registration',
        'name' => 'Name',
        'surname' => 'Surname',
        'email' => 'Email address',
        'password' => 'Password',
        'password_confirm' => 'Confirm password',
        'submit' => 'Register',
        'have_account' => 'Already have an account?',
        'login_link' => 'Login',
        'reference' => 'How did you hear about us?'
    ],

    'login' => [
        'title' => 'Login',
        'email' => 'Email',
        'email_placeholder' => 'Enter your email',
        'password' => 'Password',
        'password_placeholder' => 'Enter your password',
        'remember_me' => 'Remember me',
        'submit' => 'Login',
        'forgot_password' => 'Forgot your password?',
    ],

    'verify' => [
        'title' => 'Verify Your Email Address',
        'fresh_link_sent' => 'A fresh verification link has been sent to your email address.',
        'check_email' => 'Before proceeding, please check your email for a verification link.',
        'not_received' => 'If you did not receive the email',
        'request_another' => 'click here to request another',
    ],

    'confirm' => [
        'title' => 'Confirm Password',
        'message' => 'Please confirm your password before continuing.',
        'password_label' => 'Password',
        'password_placeholder' => 'Enter your password',
        'submit' => 'Confirm Password',
        'forgot_password' => 'Forgot Your Password?',
    ],

    'reset' => [
        'title' => 'Reset Password',
        'status' => 'We have emailed your password reset link.',
        'email_label' => 'Email Address',
        'email_placeholder' => 'Enter your email',
        'submit' => 'Send Password Reset Link',
    ],

    'reset_password' => [
        'title' => 'Reset Password',
        'email_label' => 'Email Address',
        'email_placeholder' => 'Enter your email',
        'new_password_label' => 'New Password',
        'new_password_placeholder' => 'Enter new password',
        'confirm_password_label' => 'Confirm Password',
        'confirm_password_placeholder' => 'Repeat new password',
        'password_requirements' => 'Password must contain at least 8 characters, one uppercase letter and one number.',
        'password_match_error' => 'Passwords must match.',
        'submit' => 'Set New Password',
    ],

    'validation' => [
        'name' => 'Name must be 2-50 characters long.',
        'surname' => 'Surname must be 2-50 characters long.',
        'email' => 'Please enter a valid email address.',
        'password' => 'Password must be at least 8 characters.',
        'password_match' => 'Passwords must match.',
    ],

    'password' => 'The provided password is incorrect.',
];
