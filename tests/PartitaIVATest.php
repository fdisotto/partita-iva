<?php
class PartitaIVATest extends PHPUnit_Framework_TestCase
{
    private $pIva;

    public function testCheckTrue()
    {
        $pIva = new \fdisotto\PartitaIVA('07973780013', 'IT');
        $this->assertTrue($pIva->isValid());

        $pIva = new \fdisotto\PartitaIVA('07973780013');
        $this->assertTrue($pIva->isValid());

        $pIva = new \fdisotto\PartitaIVA('66780129987', 'FR');
        $this->assertTrue($pIva->isValid());
    }

    public function testCheckFalse()
    {
        $pIva = new \fdisotto\PartitaIVA('12015485235', 'IT');
        $this->assertFalse($pIva->isValid());
    }
}