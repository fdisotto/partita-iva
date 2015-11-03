<?php
/**
 * PartitaIva - Partita IVA checker
 *
 * @author      Fabio Di Sotto <fabio.disotto@gmail.com>
 * @copyright   2015 Fabio Di Sotto
 * @link        https://github.com/fdisotto/cac-api
 * @version     3.0.0
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace fdisotto;

/**
 * PartitaIVA
 *
 * Partita IVA checker
 *
 * @author Fabio Di Sotto
 */
class PartitaIVA
{
    private $_partitaIVA;
    private $_codiceComunitario;
    private $_valid = false;

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

    public function isValid() {
        $this->getRequest();

        return $this->_valid;
    }

    private function getRequest() {
        try {
            $opts = array(
                'http'=>array(
                    'user_agent' => 'PHPSoapClient'
                )
            );

            $context = stream_context_create($opts);
            $client = new \SoapClient('http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl',
                                     array('stream_context' => $context,
                                           'cache_wsdl' => WSDL_CACHE_NONE));

            $result = $client->checkVat(array(
                'countryCode' => $this->_codiceComunitario,
                'vatNumber' => $this->_partitaIVA
            ));

            $this->_valid = $result->valid == 1 ? true : false;

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}