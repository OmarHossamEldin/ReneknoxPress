<?php

namespace Reneknox\ReneknoxPress\Initialization;

class Migration
{
    public function call(array $tables, string $type)
    {
        foreach ($tables as $table) {
            $table = new $table();
            switch ($type) {
                case 'up':
                    call_user_func([$table, 'up']);
                    break;
                case 'down';
                    call_user_func([$table, 'down']);
                    break;
            }
        }
    }
}
