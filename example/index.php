<?php

use partitaiva\PartitaIVA;
use partitaiva\VatService;

require_once '../vendor/autoload.php';

$pIva = new PartitaIva(new VatService());
if ($pIva->isValid() === true) {
    // exist
}