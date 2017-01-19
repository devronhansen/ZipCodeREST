<?php

namespace ZipCodesREST\Database;

abstract class AbstractDatabase
{
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
     * @param \PDO $pdo
     * @param int $returnLimit
     */
    function __construct($pdo, $returnLimit)
    {
        $this->db = $pdo;
        $this->returnLimit = $returnLimit;
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