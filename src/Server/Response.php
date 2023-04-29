<?php

namespace Reneknox\ReneknoxPress\Server;

class Response
{
    private $action;

    private Header $header;

    public function __construct($action)
    {
        $this->action = $action;
        $this->header = new Header();
    }

    public function terminate()
    {
        return [$this->header, $this->action];
    }
}