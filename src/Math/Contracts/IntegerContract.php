<?php

namespace Math\Contracts;

use Math\Integer;

interface IntegerContract {

    public function getValue(): int;
    public function getAbsoluteValue(): Integer;

    public function add(Integer $value): Integer;
    public function subtract(Integer $value): Integer;
    public function multiply(Integer $value): Integer;
    public function divide(Integer $value): Integer;

    public function modulo(Integer $value): Integer;
    public function isDivisibleBy(Integer $value): bool;

    public function getGcd(Integer $value): Integer;
    public function getLcm(Integer $value): Integer;

    public function isPrime(): bool;
    public function getFactors(): array;
}
