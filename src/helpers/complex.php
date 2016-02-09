<?php

use Math\Complex;

if ( ! function_exists('complex')) {
    function complex(int $real, int $imag) {
        return new Complex(integer($real), integer($imag));
    }
}
