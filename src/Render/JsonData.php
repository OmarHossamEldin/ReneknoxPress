<?php

namespace Reneknox\ReneknoxPress\Render;

use Reneknox\ReneknoxPress\Http\Status;
use Reneknox\ReneknoxPress\Interfaces\Renderer;

class JsonData implements Renderer
{
    private array $data;
    private int $statusCode;

    public function __construct(int $statusCode, array $data = [])
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public static function response(array $data, int $statusCode = Status::SUCCESS): JsonData
    {
        return new JsonData($statusCode, $data);
    }

    public function render(): string
    {
        return json_encode($this->data);
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function get_status_code(): int
    {
        return $this->statusCode;
    }

}