<?php

namespace Math\Contracts;

use Math\Integer;

interface RationalContract {

    public function getNumerator(): Integer;
    public function setNumerator(Integer $newNum);

    public function getDenominator(): Integer;
    public function setDenominator(Integer $newDenom);
}
