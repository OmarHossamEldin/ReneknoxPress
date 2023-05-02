<?php

namespace Reneknox\ReneknoxPress\Server;

class Request
{
    private array $data;

    public function __construct(
        array $get = [],
        array $post = [],
        array $request = [],
        array $cookies = [],
        array $files = [],
        array $server = []
    )
    {

        $this->data = array_merge($get, $post, $request, $files, $cookies, $server);
    }

    public static function create_from_global(
        array $get = [],
        array $post = [],
        array $request = [],
        array $cookies = [],
        array $files = [],
        array $server = []
    ): Request
    {
        return new self($get, $post, $request, $cookies, $files, $server);
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function all(): array
    {
        return $this->data;
    }

    public function unset(...$keys): void
    {
        foreach ($keys as $key) {
            unset($this->data[$key]);
        }
    }

}