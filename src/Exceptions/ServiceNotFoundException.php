<?php

namespace Reneknox\ReneknoxPress\Exceptions;

use Exception;

class ServiceNotFoundException extends Exception
{
    protected $message = 'service not found exception';
}