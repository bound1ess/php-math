<?php

use Math\{Rational, Integer};

if ( ! function_exists('rational')) {
    function rational(int $num = null, int $denom = null): Rational {
        if (null == $num) {
            $num = 0;
        }
        if (null == $denom) {
            $denom = 1;
        }
        return new Rational(new Integer($num), new Integer($denom));
    }
}
