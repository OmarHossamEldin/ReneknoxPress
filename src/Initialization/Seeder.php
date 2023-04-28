<?php

namespace Reneknox\ReneknoxPress\Initialization;

class Seeder
{
    public function call(array $tablesSeeders)
    {
        foreach ($tablesSeeders as $tableSeeder) {
            $tableSeeder = new $tableSeeder();
            call_user_func([$tableSeeder, 'create']);
        }
    }
}
