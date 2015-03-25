<?php
class PartitaIVATest extends PHPUnit_Framework_TestCase
{
    private $pIva;

    public function setUp()
    {
        $this->pIva = new \fdisotto\PartitaIVA();
    }

    public function testCheckTrue()
    {
        $this->assertTrue($this->pIva->check('01234567891'));
    }

    public function testCheckFalse()
    {
        $this->assertFalse($this->pIva->check('123456'));
    }
}