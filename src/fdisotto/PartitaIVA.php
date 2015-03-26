<?php
/**
 * PartitaIva - Partita IVA checker
 *
 * @author      Fabio Di Sotto <fabio.disotto@gmail.com>
 * @copyright   2015 Fabio Di Sotto
 * @link        https://github.com/fdisotto/cac-api
 * @version     2.0.0
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
    /**
     * Return the check result
     *
     * @param string $partitaIVA Partita IVA to check
     * @return bool Check result
     */
    public function check($partitaIVA)
    {
        if (empty($partitaIVA)) {
            return false;
        }

        $pattern = "/^[0-9]{11}$/i";
        if (!preg_match($pattern, trim($partitaIVA))) {
            return false;
        }

        $s = 0;
        for ($i = 0; $i <= 9; $i += 2 ) {
            $s+= ord($partitaIVA[$i]) - ord('0');
        }

        for ($i = 1; $i <= 9; $i += 2 ) {
            $c = 2 * (ord($partitaIVA[$i]) - ord('0'));
            if ($c > 9) {
                $c-= 9;
            }
            $s+= $c;
        }

        if (((10 - $s % 10) % 10) != (ord($partitaIVA[10]) - ord('0'))) {
            return false;
        }

        return true;
    }
}