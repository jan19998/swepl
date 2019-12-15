<?php
require_once __DIR__ ."/../vendor/autoload.php";
class dbconnect
{
    private $remoteConnection;

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::create(__DIR__, '/../.env');
        $dotenv->load();
        $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
        $this->remoteConnection = mysqli_connect(
            getenv('DB_HOST'),
            getenv('DB_USER'),
            getenv('DB_PASS'),
            getenv('DB_NAME'),
            (int)getenv('DB_PORT')
        );
        if (mysqli_connect_errno()) {
            printf("Konnte nicht zur entfernten Datenbank verbinden: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function getConnection() {
        return $this->remoteConnection;
    }

    public function close() {
        mysqli_close($this->remoteConnection);
    }

}