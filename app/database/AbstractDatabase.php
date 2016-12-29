<?php

namespace ZipCodesREST\database;

abstract Class AbstractDatabase
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var int
     */
    protected $returnLimit;

    /**
     * AbstractDatabase constructor.
     */
    function __construct()
    {
        $this->config = include 'config.php';
        $this->returnLimit = $this->config['database']['returnLimit'];

        $this->establishDatabaseConnection();
    }

    /**
     * Delegates if there are errors
     */
    protected function establishDatabaseConnection()
    {
        try {
            $this->connectToDatabase();
        } catch (\PDOException $e) {
            exit("<h2>Error 503</h2><p>Database Connection could not be established</p>");
        }
    }

    /**
     * Connects To the Database with config Values
     */
    protected function connectToDatabase()
    {
        $this->db = new \PDO(
            "mysql:host=" . $this->config['database']['host'] .
            ";dbname=" . $this->config['database']['dbname'] . ";
                charset=utf8",
            $this->config['database']['username'],
            $this->config['database']['password']
        );
    }

    /**
     * @param string $name
     * @return array
     */
    abstract function selectByName(string $name): array;

    /**
     * @param int $zipCode
     * @return array
     */
    abstract function selectByZipCode(int $zipCode): array;
}