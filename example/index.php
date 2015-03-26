<?php
require_once '../vendor/autoload.php';

$pIva = new \fdisotto\PartitaIVA();

var_dump($pIva->check('01234567891'));

var_dump($pIva->check('07973780013'));