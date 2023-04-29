<?php

namespace Reneknox\ReneknoxPress\Server;

use Reneknox\ReneknoxPress\Render\TemplateEngine;
use Reneknox\ReneknoxPress\Render\JsonData;
use Reneknox\ReneknoxPress\Http\Status;

class Response
{
    private $action;

    private Header $header;

    public function __construct($action)
    {
        $this->action = $action;
        $this->header = new Header();
    }

    public function set_status_code(int $statusCode): void
    {
        $this->header->statusCode($statusCode);
    }

    public function terminate()
    {
        if ($this->action instanceof TemplateEngine) {
            $this->header->set('Content-Type', 'text/html; charset=utf-8');
            $this->set_status_code(Status::SUCCESS);
        }
        if ($this->action instanceof JsonData) {
            $this->header->set('Content-Type', 'application/json');
            $this->set_status_code($this->action->get_status_code());
        }
        return $this->action;
    }
}