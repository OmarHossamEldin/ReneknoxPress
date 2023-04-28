<?php

namespace Reneknox\ReneknoxPress\Http;

class Status
{
    public const NOT_FOUND = 404;
    public const FORBIDDEN = 403;
    public const UNPROCESSABLE_CONTENT  = 422;
    public const INTERNAL_SERVER_ERROR = 500;
    public const SUCCESS = 200;
    public const CREATED = 201;
    public const UPDATED = 206;
    public const DELETED = 204;
}