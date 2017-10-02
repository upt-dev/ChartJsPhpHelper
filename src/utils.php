<?php 

if (!function_exists('isArrayAssoc')) {
    /**
     * Check is array associative
     * @param  array  $arr  
     * @return boolean      
     */
    function isArrayAssoc($arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
