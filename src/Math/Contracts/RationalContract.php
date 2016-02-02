<?php

namespace Math\Contracts;

use Math\{Integer, Rational};

interface RationalContract {

    public function getNumerator(): Integer;
    public function setNumerator(Integer $newNum);

    public function getDenominator(): Integer;
    public function setDenominator(Integer $newDenom);

    public function getInverse(): Rational;

    public function multiply(Rational $value): Rational;
    public function divide(Rational $value): Rational;
    public function add(Rational $value): Rational;
    public function subtract(Rational $value): Rational;
}
