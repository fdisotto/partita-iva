<?php

namespace partitaiva;

interface PartitaIvaInterface
{
    public function getPartitaIVA();
    public function setPartitaIVA($partitaIva);
    public function getCodiceComunitario();
    public function setCodiceComunitario($codiceComunitario);
    public function isValid();
}