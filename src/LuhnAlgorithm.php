<?php 

namespace Alqudiry\LaraProtectId;

class LuhnAlgorithm {

    /**
     * Luhn core algorithm.
     *
     * @param int $number
     * @return int
     */
    private static function algorithm(int $number) : int
    {
        $sum = 0;
        $parity = 1;
        settype($number, 'string');
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $factor = $parity ? 2 : 1;
            $parity = $parity ? 0 : 1;
            $sum += array_sum(str_split($number[$i] * $factor));
        }

        return $sum;
    }

    /**
     * Compute check digit.
     *
     * @param $number Number to compute.
     */
    public static function calculateId($number)
    {
        if(!is_array($number)) {
            return $number . ((self::algorithm($number) * 9) % 10);
        }

        foreach($number as $index => $n) {
            $number[$index] = $n . ((self::algorithm($n) * 9) % 10);
        }

        return $number;
    }

    /**
     * Validate number containing check digit.
     *
     * @param int $number Number to validate.
     * @return bool
     */
    public static function isValidId(int $number) : bool
    {
        return (self::calculateId($number . '0') % 10) === 0 ? true : false;
    }

    /**
     * Validate number containing check digit.
     *
     * @param $number Number to validate.
     */
    public static function originalId($number)
    {

        if(!is_array($number)) {
            if(!self::isValidId($number)) {
                abort(404);
            }
    
            return substr($number, 0, -1);
        }

        foreach($number as $index => $n) {

            if(!self::isValidId($n)) {
                abort(404);
            }
    
            $number[$index] = substr($n, 0, -1);          
        }

        return $number;        
    }

}