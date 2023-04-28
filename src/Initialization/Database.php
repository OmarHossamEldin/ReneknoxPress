<?php

namespace Reneknox\ReneknoxPress\Initialization;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    private string $host;
    private string $database;
    private string $user;
    private string $pass;
    private string $charset;

    public function __construct()
    {
        $this->host = \DB_HOST;
        $this->database = \DB_NAME;
        $this->user = \DB_USER;
        $this->pass = \DB_PASSWORD;
        $this->charset = \DB_CHARSET;
    }

    public function connect()
    {
        $params = [
            "driver" => "mysql",
            "host" => $this->host,
            "database" => $this->database,
            "username" => $this->user,
            "password" => $this->pass,
            'charset' => $this->charset,
            'prefix' => '',
        ];
        $capsule = new Capsule();
        $capsule->addConnection($params);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}
