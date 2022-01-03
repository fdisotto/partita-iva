<?php
declare(strict_types=1);

namespace partitaiva;

use SoapClient;

class VatService
{
    /**
     * @var bool
     */
    private $_valid = false;
    private $client;

    public function __construct()
    {
        $this->client = $this->getRequest();
    }

    protected function getRequest()
    {
        try {
            $opts = array(
                'http' => array(
                    'user_agent' => 'PHPSoapClient'
                )
            );

            $context = stream_context_create($opts);
            $client = new SoapClient('http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl',
                array('stream_context' => $context,
                    'cache_wsdl' => WSDL_CACHE_NONE));

            return $client;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function checkVat($codiceComunitario, $partitaIva): bool
    {
        $result = $this->client->checkVat(array(
            'countryCode' => $codiceComunitario,
            'vatNumber' => $partitaIva
        ));
        $this->_valid = $result->valid == 1 ? true : false;
        return $this->_valid;
    }

}