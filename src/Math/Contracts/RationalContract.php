<?php

namespace Math\Contracts;

use Math\{Integer, Rational};

interface RationalContract {

    public function getNumerator(): Integer;
    public function setNumerator(Integer $newNum);

    public function getDenominator(): Integer;
    public function setDenominator(Integer $newDenom);

    public function getInverse(): Rational;
}
