<?php
declare(strict_types=1);

namespace partitaiva;

use SoapClient;

class VatService
{
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
            $client = new SoapClient('http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl', array(
                    'stream_context' => $context,
                    'cache_wsdl' => WSDL_CACHE_NONE)
            );
            return $client;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function checkVat($codiceComunitario, $partitaIva): bool
    {
        $data = array(
            'countryCode' => $codiceComunitario,
            'vatNumber' => $partitaIva
        );
        $result = $this->client->checkVat($data);
        return $result->valid == 1 ? true : false;
    }

}