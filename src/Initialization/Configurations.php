<?php

namespace  Reneknox\ReneknoxPress\Initialization;

class Configurations
{
    private array $configs = [];

    public function __get($name)
    {
        return $this->configs[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->configs[$name] = $value;
    }
}