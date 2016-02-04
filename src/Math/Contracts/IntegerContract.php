<?php

namespace Math\Contracts;

use Math\Integer;

interface IntegerContract {

    public function getValue(): int;
    public function getAbsoluteValue(): int;

    public function add(Integer $value): Integer;
    public function subtract(Integer $value): Integer;
    public function multiply(Integer $value): Integer;
    public function divide(Integer $value): Integer;

    //public function mod(Integer $value): Integer;
    //public function isDivisibleBy(Integer $value): bool;

    public function getGreatestCommonDivisor(Integer $value): int;
    public function getLeastCommonMultiple(Integer $value): int;

    public function isPrime(): bool;
}
