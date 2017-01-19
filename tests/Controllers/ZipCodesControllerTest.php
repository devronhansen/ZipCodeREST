<?php

namespace ZipCodesREST\Tests\Controllers;

use ZipCodesREST\Controllers\ZipCodesController;
use ZipCodesREST\Database\AbstractDatabase;

class ZipCodesControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\Mock|AbstractDatabase
     */
    protected $abstractDatabaseMock;

    /**
     * @var ZipCodesController
     */
    private $object;

    protected function setUp()
    {
        parent::setUp();
        $this->abstractDatabaseMock = \Mockery::mock('ZipCodesRest\Database\AbstractDatabase');
        $this->object = new ZipCodesController($this->abstractDatabaseMock);
    }

    /**
     * @test
     */
    function it_shows_correct_data_by_zip_code()
    {
        $this->abstractDatabaseMock->shouldReceive('selectByZipCode')->with(24939)->once()->andReturn([
            'Ort' => 'Flensburg',
            'Bundesland' => 'Schlewig-Holstein',
            'Plz' => '24939'
        ]);

        $this->assertEquals(
            '{"Ort":"Flensburg","Bundesland":"Schlewig-Holstein","Plz":"24939"}',
            $this->object->show(24939)
        );
    }

    /**
     * @test
     */
    function it_shows_correct_data_by_name()
    {
        $expectedResult = [
            'Ort' => 'Flensburg',
            'Bundesland' => 'Schlewig-Holstein',
            'Plz' => '24939'
        ];

        $this->abstractDatabaseMock->shouldReceive('selectByName')->with("Flensburg")->once()->andReturn($expectedResult);

        $this->assertEquals(
            json_encode($expectedResult),
            $this->object->show("Flensburg")
        );
    }
}