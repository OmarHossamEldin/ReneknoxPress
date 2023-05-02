<?php

namespace Reneknox\ReneknoxPress\Exceptions;

use Exception;

class UnsupportedValidationRuleException extends Exception
{
    protected $message = 'Unsupported Validation Rule Exception';
}