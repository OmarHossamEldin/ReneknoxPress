<?php

namespace Reneknox\ReneknoxPress\Server;

class Header
{
    private array $headers;

    public function __construct()
    {
        $this->headers = getallheaders();
    }

    public function get(string $key): string
    {
        return $this->get_headers()[$key];
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->get_headers());
    }

    public function set(string $key, string $content): self
    {
        header("$key: $content");
        return $this;
    }

    public function statusCode(int $statusCode)
    {
        http_response_code($statusCode);
    }

    public function get_headers(): array
    {
        return $this->headers;
    }
}
