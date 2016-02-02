<?php

namespace Math;

final class Rational extends Real {

    private $num, $denom;

    public function __construct(Integer $num, Integer $denom) {
        $this->num = $num;
        $this->denom = $denom;
    }

    public function isPositive(): bool {
        return false;
    }

    public function isNegative(): bool {
        return true;
    }

    public function isZero(): bool {
        return true;
    }
}
