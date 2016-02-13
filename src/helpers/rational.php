<?php

use Math\{Rational, Integer};

if ( ! function_exists('rational')) {
    function rational(int $num = null, int $denom = null): Rational {
        return new Rational(new Integer($num ?? 0), new Integer($denom ?? 1));
    }
}
