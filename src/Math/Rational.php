<?php

namespace Math;

final class Rational extends Real {

    private $num, $denom;

    public function __construct(Integer $num, Integer $denom) {
        $this->num = $num;
        $this->denom = $denom;
    }

    public function getNumerator(): Integer {
        return $this->num;
    }

    public function getDenominator(): Integer {
        return $this->denom;
    }

    public function isPositive(): bool {
        if ($this->num->isPositive() && $this->denom->isPositive()) {
            return true;
        } else if ($this->num->isNegative() && $this->denom->isNegative()) {
            return true;
        } else {
            return false;
        }
    }

    public function isNegative(): bool {
        if ($this->num->isNegative() && $this->denom->isPositive()) {
            return true;
        } else if ($this->num->isPositive() && $this->denom->isNegative()) {
            return true;
        } else {
            return false;
        }
    }

    public function isZero(): bool {
        return $this->num->isZero();
    }
}
