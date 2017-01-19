<?php
/**
 * Created by PhpStorm.
 * User: Ron
 * Date: 05.01.2017
 * Time: 21:28
 */

namespace ZipCodesREST\Tests\Database;


use Mockery\MockInterface;
use ZipCodesREST\Database\GermanDatabase;


class GermanDatabaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GermanDatabase
     */
    protected $object;

    /**
     * @var MockInterface|\PDO
     */
    protected $pdoMock;

    protected function setUp()
    {
        parent::setUp();
        $this->pdoMock = \Mockery::mock(\PDO::class);
        $this->object = new GermanDatabase($this->pdoMock, 10);
    }

    /**
     * @test
     */
    function it_returns_data_by_name()
    {
        $result = ['foo', 'bar'];
        $name = 'antaro tesasda';

        $returnLimit = 100;
        $this->object = new GermanDatabase($this->pdoMock, $returnLimit);

        $stmtMock = \Mockery::mock(\PDOStatement::class);
        $stmtMock->shouldReceive('bindValue')->with(':placeholder', "$name%");
        $stmtMock->shouldReceive('execute')->once();
        $stmtMock->shouldReceive('fetchAll')->once()->with(\PDO::FETCH_ASSOC)->andReturn($result);
        $this->pdoMock->shouldReceive('prepare')->with("SELECT Plz, Bundesland, Ort FROM germany WHERE Ort LIKE :placeholder LIMIT $returnLimit")->andReturn($stmtMock);

        $this->assertEquals($result, $this->object->selectByName($name));
    }

    /**
     * @test
     */
    function it_returns_data_by_zip_code()
    {
        $result = ['foo', 'bar'];
        $zipcode = 25939;

        $returnLimit = 65;
        $this->object = new GermanDatabase($this->pdoMock, $returnLimit);

        $stmtMock = \Mockery::mock(\PDOStatement::class);
        $stmtMock->shouldReceive('bindValue')->with(':placeholder', "$zipcode%");
        $stmtMock->shouldReceive('execute')->once();
        $stmtMock->shouldReceive('fetchAll')->once()->with(\PDO::FETCH_ASSOC)->andReturn($result);
        $this->pdoMock->shouldReceive('prepare')->with("SELECT Plz, Bundesland, Ort FROM germany WHERE Plz LIKE :placeholder LIMIT $returnLimit")->andReturn($stmtMock);

        $this->assertEquals($result, $this->object->selectByZipCode($zipcode));
    }

}
