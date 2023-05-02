<?php

namespace Reneknox\ReneknoxPress\Exceptions;

use Reneknox\ReneknoxPress\Http\Status;
use Exception;

class UnprocessableContentException extends Exception
{
    protected $message = 'Unprocessable Content';

    private array $errors;

    public function __construct(string $message = "Unprocessable Content", int $code = Status::UNPROCESSABLE_CONTENT, ?Throwable $previous = null, array $errors = [])
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function get_errors(): array
    {
        return $this->errors;
    }

}