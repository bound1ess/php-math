<?php

namespace Math;

use Math\Exceptions\ZeroDenominatorException;
use Math\Contracts\RationalContract;

final class Rational extends Real implements RationalContract {

    private static $ZERO = 0;
    private static $ONE = 1;

    private $num, $denom;

    public function __construct(Integer $num, Integer $denom) {
        $this->num = $num;
        $this->denom = $denom;

        if ($this->denom->isZero()) {
            throw new ZeroDenominatorException();
        }
    }

    public static function makeInteger(Integer $num): Rational {
        return new Rational($num, new Integer(static::$ONE));
    }

    public static function makeZero(Integer $denom = null): Rational {
        if (null == $denom) {
            $denom = new Integer(static::$ONE);
        }
        return new Rational(new Integer(static::$ZERO), $denom);
    }

    public function getNumerator(): Integer {
        return $this->num;
    }

    public function setNumerator(Integer $newNum) {
        $this->num = $newNum;
    }

    public function getDenominator(): Integer {
        return $this->denom;
    }

    public function setDenominator(Integer $newDenom) {
        if ($newDenom->getValue() == static::$ZERO) {
            throw new ZeroDenominatorException();
        }
        $this->denom = $newDenom;
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
