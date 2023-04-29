<?php

use Reneknox\ReneknoxPress\Render\JsonData;
use Reneknox\ReneknoxPress\Server\Request;
use Reneknox\ReneknoxPress\Http\Status;

function json_response(array $data, int $statusCode = Status::SUCCESS)
{
    return new JsonData($data, $statusCode);
}

function camal_case(string $words, string $delimiter = ' ', string $replaceWith = '', bool $replaceable = false): string
{
    $words = strtolower($words);
    $words = ucwords($words, $delimiter);
    if ($replaceable) {
        $words = str_replace($delimiter, $replaceWith, $words);
    }
    return $words;
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