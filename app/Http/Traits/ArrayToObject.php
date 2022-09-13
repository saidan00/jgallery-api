<?php

namespace App\Http\Traits;

use stdClass;

trait ArrayToObject
{
    function array_to_object($array)
    {
        $obj = new stdClass();

        foreach ($array as $k => $v) {
            if (strlen($k)) {
                if (is_array($v)) {
                    $obj->{$k} = $this->array_to_object($v); //RECURSION
                } else {
                    $obj->{$k} = $v;
                }
            }
        }

        return $obj;
    }
}
