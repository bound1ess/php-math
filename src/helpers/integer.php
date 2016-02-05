<?php

use Math\Integer;

if ( ! function_exists('integer')) {
    function integer(int $value): Integer {
        return new Integer($value);
    }
}
