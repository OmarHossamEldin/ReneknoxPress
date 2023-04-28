<?php

namespace Reneknox\ReneknoxPress\Helpers;

class PathConverter
{
    public static function convert(string $filePath): string
    {
        return str_replace('.', DIRECTORY_SEPARATOR, $filePath);
    }
}