<?php

use Reneknox\ReneknoxPress\Initialization\Configurations;
use Reneknox\ReneknoxPress\Server\Request;

function camal_case(string $words, string $delimiter = ' ', string $replaceWith = '', bool $replaceable = false): string
{
    $words = strtolower($words);
    $words = ucwords($words, $delimiter);
    if ($replaceable) {
        $words = str_replace($delimiter, $replaceWith, $words);
    }
    return $words;
}

function configs_get(string $key): ?string
{
    $configurations = get_service(Configurations::class);
    return $configurations->$key;
}

function get_service(string $service)
{
    $plugin = new Plugin();
    return $plugin->get_service($service);
}

function dd(...$vars)
{
    echo '<pre>';
    var_dump(...$vars);
    echo '</pre>';
    die();
}

function is_authenticated(Request $request): bool
{
    $key = 'wordpress_logged_in_' . COOKIEHASH;
    return !!$request->$key;
}

function request(): Request
{
    $data = trim(file_get_contents('php://input'));
    $data = $data ? json_decode($data, true) : [];
    return new Request($_GET, $_POST, $data, $_COOKIE, $_FILES, $_SERVER);
}

function auth()
{
    if (is_authenticated(request())) {
        $user = new stdClass();
        $wpUser = wp_get_current_user();
        $user->id = $wpUser->id;
        $user->username = $wpUser->data->user_login;
        $user->email = $wpUser->data->user_email;
        $user->roles = $wpUser->roles;
        $user->permissions = $wpUser->allcaps;
        return $user;
    }
    return false;
}