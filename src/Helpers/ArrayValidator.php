<?php

namespace Reneknox\ReneknoxPress\Helpers;

class ArrayValidator
{
    private array $array;

    public function __construct(?array $array = [])
    {
        $this->array = $array;
    }

    public function array_keys_exists(...$keys)
    {
        $arrayKeys = array_keys($this->array);
        foreach ($keys as $key) {
            if (!in_array($key, $arrayKeys, true)) {
                return false;
            }
        }
        return true;
    }

    public function keys_are_equal($array1, $array2): bool
    {
        return !array_diff_key($array1, $array2) && !array_diff_key($array2, $array1);
    }
}
