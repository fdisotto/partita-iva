<?php
require_once '../vendor/autoload.php';

$pIva = new \fdisotto\PartitaIVA('07973780013', 'IT');
if ($pIva->isValid() === true) {
    // exist
}

$pIva = new \fdisotto\PartitaIVA('07973780013');
if ($pIva->isValid() === true) {
    // exist
}

$pIva = new \fdisotto\PartitaIVA('66780129987', 'FR');
if ($pIva->isValid() === true) {
    // exist
}