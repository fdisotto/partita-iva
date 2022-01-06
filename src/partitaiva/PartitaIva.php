<?php
declare(strict_types=1);

namespace partitaiva;

class PartitaIva implements PartitaIvaInterface
{
    private $_partitaIVA;
    private $_codiceComunitario;
    private $vatService;

    public function __construct(VatService $vatService)
    {
        $this->vatService = $vatService;
    }

    /**
     * @return mixed|string
     */
    public function getPartitaIVA()
    {
        return $this->_partitaIVA;
    }

    /**
     * @param mixed|string $partitaIVA
     */
    public function setPartitaIVA($partitaIVA)
    {
        $this->_partitaIVA = $partitaIVA;
    }

    /**
     * @return mixed|string
     */
    public function getCodiceComunitario()
    {
        return $this->_codiceComunitario;
    }

    /**
     * @param mixed|string $codiceComunitario
     */
    public function setCodiceComunitario($codiceComunitario)
    {
        $this->_codiceComunitario = $codiceComunitario;
    }

    public function isValid(): bool
    {
        return $this->vatService->checkVat($this->_codiceComunitario, $this->_partitaIVA);
    }
}