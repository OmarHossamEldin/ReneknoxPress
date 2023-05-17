<?php

namespace Reneknox\ReneknoxPress\Render;

use Reneknox\ReneknoxPress\Interfaces\Renderer;

class TemplateEngine implements Renderer
{
    private string $content;

    private array $data;

    public function __construct(string $filePath, array $data = [])
    {
        $this->content = $filePath . '.php';
        $this->data = $data;
    }

    public function with(array $data): TemplateEngine
    {
        $this->data = $data;
        return $this;
    }

    public function render(): string
    {
        extract($this->data);

        ob_start();

        require($this->content);

        return (string) ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }
}