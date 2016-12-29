<?php

namespace ZipCodesREST\controllers;

use ZipCodesREST\database\AbstractDatabase;

class ZipCodesController
{
    /**
     * @var AbstractDatabase
     */
    protected $db;

    /**
     * @var mixed
     */
    protected $input;

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
        $this->input = $input;
        return json_encode($this->getOutput(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * Delegates and returns from the corresponding database functions
     * depending on the input beeing a number or a string
     *
     * @return mixed
     */
    protected function getOutput()
    {
        if (ctype_digit($this->input)) {
            return $this->db->selectByZipCode($this->input);
        }
        return $this->db->selectByName($this->input);
    }
}