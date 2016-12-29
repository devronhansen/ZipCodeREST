<?php

namespace ZipCodesREST\tests;

use ZipCodesREST\controllers\ZipCodesController;
use ZipCodesREST\database\AbstractDatabase;

class ZipCodesControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\Mock|AbstractDatabase
     */
    protected $abstractDatabaseMock;

    function test_It_Shows_Correct_Data_By_ZipCode()
    {
        $this->abstractDatabaseMock = \Mockery::mock('ZipCodesRest\database\AbstractDatabase');
        $this->abstractDatabaseMock->shouldReceive('selectByZipCode')->with(24939)->once()->andReturn([
            'Ort' => 'Flensburg',
            'Bundesland' => 'Schlewig-Holstein',
            'Plz' => '24939'
        ]);

        $zipCodesController = new ZipCodesController($this->abstractDatabaseMock);
        $result = $zipCodesController->show(24939);
        $this->assertEquals('{"Ort":"Flensburg","Bundesland":"Schlewig-Holstein","Plz":"24939"}', $result);
    }
}