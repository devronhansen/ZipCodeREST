<?php

namespace ZipCodesREST\Controllers;

use ZipCodesREST\Database\AbstractDatabase;

class ZipCodesController
{
    /**
     * @var AbstractDatabase
     */
    protected $db;

    /**
     * ZipCodesController constructor.
     * @param AbstractDatabase $db
     */
    function __construct(AbstractDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * Converts the results into json and displays them
     *
     * @param $input
     * @return string
     */
    function show($input)
    {
        return json_encode($this->getOutput($input), JSON_UNESCAPED_UNICODE);
    }

    /**
     * Delegates and returns from the corresponding database functions
     * depending on the input beeing a number or a string
     *
     * @param mixed $input
     * @return mixed
     */
    protected function getOutput($input)
    {
        if (ctype_digit($input)) {
            return $this->db->selectByZipCode($input);
        }
        return $this->db->selectByName($input);
    }
}