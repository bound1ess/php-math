<?php

namespace Math\Contracts;

use Math\{Integer, Rational};

interface RationalContract {

    public function __construct(Integer $num, Integer $denom);

    public function getNumerator(): Integer;
    public function getDenominator(): Integer;

    public function getInverse(): Rational;

    public function multiply(Rational $value): Rational;
    public function divide(Rational $value): Rational;
    public function add(Rational $value): Rational;
    public function subtract(Rational $value): Rational;

    public function multiplyByInteger(Integer $value): Rational;
    public function divideByInteger(Integer $value): Rational;
    public function addInteger(Integer $value): Rational;
    public function subtractInteger(Integer $value): Rational;

    public function getIntegerPart(): Integer;
    public function getFractionalPart(): Rational;

    public function isEqualTo(Rational $value): bool;
    public function isLessThan(Rational $value): bool;
    public function isGreaterThan(Rational $value): bool;

    public function isEqualToInteger(Integer $value): bool;
    public function isLessThanInteger(Integer $value): bool;
    public function isGreaterThanInteger(Integer $value): bool;

    public function getSimplified(): Rational;
}
