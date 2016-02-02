<?php

namespace Math\Contracts;

use Math\Integer;

interface IntegerContract {

    public function getValue(): int;

    public function getAbsoluteValue(): int;

    public function getGreatestCommonDivisor(Integer $value): int;
}
