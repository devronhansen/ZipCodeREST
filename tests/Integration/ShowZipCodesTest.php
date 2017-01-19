<?php


namespace ZipCodesREST\Tests\Integration;


use ZipCodesREST\Controllers\ZipCodesController;
use ZipCodesREST\Database\GermanDatabase;

class ShowZipCodesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PDO
     */
    protected $db;

    protected function setUp()
    {
        parent::setUp();
        $this->prepareDB();
    }

    /**
     * @test
     */
    function it_returns_the_plz_for_the_requested_name()
    {
        $controller = new ZipCodesController(new GermanDatabase($this->db, 1));
        $this->assertJsonStringEqualsJsonString(
            json_encode([
                [
                    'Plz' => '24941',
                    'Bundesland' => 'SSH',
                    'Ort' => 'Flensburg'
                ]
            ]),
            $controller->show('Flensburg')
        );
    }

    private function prepareDB()
    {
        $this->db = new \PDO('sqlite::memory:', null, null);
        $sql = file_get_contents(__DIR__ . '/../fixtures/germany.sql');
        $this->db->exec($sql);
    }
}