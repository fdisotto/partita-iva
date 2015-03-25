<?php
require_once '../vendor/autoload.php';

$pIva = new \fdisotto\PartitaIVA();

var_dump($pIva->check('012345678'));

var_dump($pIva->check('01234567891'));