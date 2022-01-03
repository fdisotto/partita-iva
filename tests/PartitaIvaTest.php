<?php

use fdisotto\PartitaIVA;
use fdisotto\VatService;

class PartitaIvaTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeValidPartitaIva()
    {
        $vatService = new VatService();
        $pIva = new PartitaIva($vatService);
        $pIva->setPartitaIVA('66780129987');
        $pIva->setCodiceComunitario('FR');
        $this->assertTrue($pIva->isValid());

        $pIva = new PartitaIva($vatService);
        $pIva->setPartitaIVA('07973780013');
        $pIva->setCodiceComunitario('IT');
        $this->assertTrue($pIva->isValid());
    }

    public function testCanBeNotValidPartitaIva()
    {
        $vatService = new VatService();
        $pIva = new PartitaIva($vatService);
        $pIva->setPartitaIVA('12015485235');
        $pIva->setCodiceComunitario('IT');
        $this->assertFalse($pIva->isValid());
    }
}