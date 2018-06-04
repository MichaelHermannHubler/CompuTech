<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 04.06.2018
 * Time: 14:51
 */

class ArrayUtil
{

    function array_remove($array, $value)
    {
        return array_filter($array, function($a) use($value) {
            return $a !== $value;
        });
    }

}