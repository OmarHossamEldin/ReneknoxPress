<?php

namespace Reneknox\ReneknoxPress\Server;

use Reneknox\ReneknoxPress\Initialization\ActionResolver;
use Exception;

class Response
{
    private $action;
    private int $statusCode;

    private Header $header;

    public function __construct()
    {
        $this->header = new Header();
    }

    public function set_action($action, int $statusCode): Response
    {
        [$this->action, $this->statusCode] = [$action, $statusCode];
        return $this;
    }

    public function terminate()
    {
        try {
            $this->set_status_code();
            echo ActionResolver::resolve($this->action);
        } catch (Exception $exception) {
            $exceptionHandler = new ExceptionHandler($exception);
            $errorResponse = $exceptionHandler->handle($this);
            $errorResponse->set_status_code();
            echo ActionResolver::resolve($errorResponse->action);
        }
        exit;
    }

    private function set_status_code(): void
    {
        $this->header->statusCode($this->statusCode);
    }
}