<?php
declare(strict_types=1);
namespace fdisotto;

class PartitaIVA
{
    private $_partitaIVA;
    private $_codiceComunitario;

    public function __construct($partitaIVA = '', $codiceComunitario = 'IT') {
        if ($codiceComunitario) {
            $this->_codiceComunitario = $codiceComunitario;
        } else {
            throw new \Exception("Codice comunitario dello Stato mancante", 1);
        }

        if ($partitaIVA) {
            $this->_partitaIVA = $partitaIVA;
        } else {
            throw new \Exception("Partita IVA mancante", 1);
        }
    }

    public function isValid(): bool
    {
        $vatService = new VatService();
        return $vatService->checkVat($this->_codiceComunitario, $this->_partitaIVA);
    }
}