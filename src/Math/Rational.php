<?php

namespace Math;

use Math\Exceptions\{NoInverseException, ZeroDenominatorException};
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

    public function getInverse(): Rational {
        if ($this->num->getValue() == static::$ZERO) {
            throw new NoInverseException();
        }
        $newNum = new Integer($this->denom->getValue());
        $newDenom = new Integer($this->num->getValue());
        return new Rational($newNum, $newDenom);
    }

    public function multiply(Rational $value): Rational {
        $newNum = $this->num->getValue() * $value->getNumerator()->getValue();
        $newDenom = $this->denom->getValue() * $value->getDenominator()->getValue();
        return new Rational(new Integer($newNum), new Integer($newDenom));
    }

    public function divide(Rational $value): Rational {
        return $this->multiply($value->getInverse());
    }

    public function add(Rational $value): Rational {
        $newNum = $this->num->getValue() * $value->denom->getValue();
        $newNum += $value->num->getValue() * $this->denom->getValue();
        $newDenom = $value->denom->getValue() * $this->denom->getValue();
        return new Rational(new Integer($newNum), new Integer($newDenom));
    }

    public function subtract(Rational $value): Rational {
        $coef = new Rational(new Integer(-static::$ONE), new Integer(static::$ONE));
        return $this->add($value->multiply($coef));
    }

    public function multiplyByInteger(Integer $value): Rational {
        return $this->multiply(Rational::makeInteger($value));
    }

    public function divideByInteger(Integer $value): Rational {
        return $this->divide(Rational::makeInteger($value));
    }

    public function addInteger(Integer $value): Rational {
        return $this->add(Rational::makeInteger($value));
    }

    public function subtractInteger(Integer $value): Rational {
        return $this->subtract(Rational::makeInteger($value));
    }

    public function increment() {
        $newRational = $this->addInteger(new Integer(static::$ONE));
        $this->num = $newRational->getNumerator();
        $this->denom = $newRational->getDenominator();
    }

    public function decrement() {
        $newRational = $this->subtractInteger(new Integer(static::$ONE));
        $this->num = $newRational->getNumerator();
        $this->denom = $newRational->getDenominator();
    }

    public function isEqualTo(Rational $value): bool {
        $first = $this->getSimplified();
        $second = $value->getSimplified();
        if ($first->getNumerator()->getValue() != $second->getNumerator()->getValue()) {
            return false;
        }
        if ($first->getDenominator()->getValue() != $second->getDenominator()->getValue()) {
            return false;
        }
        return true;
    }

    public function isLessThan(Rational $value): bool {
        $first = $this->getSimplified();
        $second = $value->getSimplified();
        $lcm = $first->getDenominator()->getLeastCommonMultiple($second->getDenominator());
        $left = $first->getNumerator()->getValue();
        $left *= $lcm / $first->getDenominator()->getValue();
        $right = $second->getNumerator()->getValue();
        $right *= $lcm / $second->getDenominator()->getValue();
        return $left < $right;
    }

    public function isGreaterThan(Rational $value): bool {
        if ($this->isEqualTo($value) || $this->isLessThan($value)) {
            return false;
        }
        return true;
    }

    public function isEqualToInteger(Integer $value): bool {
        return $this->isEqualTo(Rational::makeInteger($value));
    }

    public function isLessThanInteger(Integer $value): bool {
        return $this->isLessThan(Rational::makeInteger($value));
    }

    public function isGreaterThanInteger(Integer $value): bool {
        return $this->isGreaterThan(Rational::makeInteger($value));
    }

    public function getSimplified(): Rational {
        $gcd = $this->num->getGreatestCommonDivisor($this->denom);
        $newNum = $this->num->getValue() / $gcd;
        $newDenom = $this->denom->getValue() / $gcd;
        return new Rational(new Integer($newNum), new Integer($newDenom));
    }

    public function simplify() {
        $newRational = $this->getSimplified();
        $this->num = $newRational->getNumerator();
        $this->denom = $newRational->getDenominator();
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
