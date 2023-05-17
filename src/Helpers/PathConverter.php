<?php

namespace Reneknox\ReneknoxPress\Helpers;

class PathConverter
{
    public static function convert(string $filePath, string $needle = '.'): string
    {
        return str_replace($needle, DIRECTORY_SEPARATOR, $filePath);
    }
}