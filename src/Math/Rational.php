<?php

namespace Math;

use Math\Exceptions\{NoInverseException, ZeroDenominatorException};
use Math\Contracts\RationalContract;

final class Rational extends Real implements RationalContract {

    /**
     * @var int
     */
    private static $ZERO = 0;

    /**
     * @var int
     */
    private static $ONE = 1;

    /**
     * @var Integer
     */
    private $num;

    /**
     * @var Integer
     */
    private $denom;

    /**
     * @param Integer $num
     * @param Integer $denom
     * @throws ZeroDenominatorException
     * @return void
     */
    public function __construct(Integer $num, Integer $denom) {
        $this->num = $num;
        $this->denom = $denom;

        if ($this->denom->isZero()) {
            throw new ZeroDenominatorException();
        }
    }

    /**
     * @param Integer $num
     * @param Integer $denom
     * @return Rational
     */
    public static function make(Integer $num, Integer $denom): Rational {
        return new static($num, $denom);
    }

    /**
     * @param Integer $num
     * @return Rational
     */
    public static function makeInteger(Integer $num): Rational {
        return new static($num, integer(static::$ONE));
    }

    /**
     * @param Integer|null $denom
     * @return Rational
     */
    public static function makeZero(Integer $denom = null): Rational {
        if (null == $denom) {
            $denom = integer(static::$ONE);
        }
        return new static(integer(static::$ZERO), $denom);
    }

    /**
     * @return Integer
     */
    public function getNumerator(): Integer {
        return $this->num;
    }

    /**
     * @return Integer
     */
    public function getDenominator(): Integer {
        return $this->denom;
    }

    /**
     * @throws NoInverseException
     * @return Rational
     */
    public function getInverse(): Rational {
        if ($this->num->getValue() == static::$ZERO) {
            throw new NoInverseException();
        }
        $newNum = integer($this->denom->getValue());
        $newDenom = integer($this->num->getValue());
        return new static($newNum, $newDenom);
    }

    /**
     * @param Rational $value
     * @return Rational
     */
    public function multiply(Rational $value): Rational {
        $newNum = $this->num->getValue() * $value->getNumerator()->getValue();
        $newDenom = $this->denom->getValue() * $value->getDenominator()->getValue();
        return new static(integer($newNum), integer($newDenom));
    }

    /**
     * @param Rational $value
     * @return Rational
     */
    public function divide(Rational $value): Rational {
        return $this->multiply($value->getInverse());
    }

    /**
     * @param Rational $value
     * @return Rational
     */
    public function add(Rational $value): Rational {
        $newNum = $this->num->getValue() * $value->denom->getValue();
        $newNum += $value->num->getValue() * $this->denom->getValue();
        $newDenom = $value->denom->getValue() * $this->denom->getValue();
        return new static(integer($newNum), integer($newDenom));
    }

    /**
     * @param Rational $value
     * @return Rational
     */
    public function subtract(Rational $value): Rational {
        $coef = new static(integer(-static::$ONE), integer(static::$ONE));
        return $this->add($value->multiply($coef));
    }

    /**
     * @param Integer $value
     * @return Rational
     */
    public function multiplyByInteger(Integer $value): Rational {
        return $this->multiply(static::makeInteger($value));
    }

    /**
     * @param Integer $value
     * @return Rational
     */
    public function divideByInteger(Integer $value): Rational {
        return $this->divide(static::makeInteger($value));
    }

    /**
     * @param Integer $value
     * @return Rational
     */
    public function addInteger(Integer $value): Rational {
        return $this->add(static::makeInteger($value));
    }

    /**
     * @param Integer $value
     * @return Rational
     */
    public function subtractInteger(Integer $value): Rational {
        return $this->subtract(static::makeInteger($value));
    }

    /**
     * @return Integer
     */
    public function getIntegerPart(): Integer {
        return $this->num->divide($this->denom);
    }

    /**
     * @return Rational
     */
    public function getFractionalPart(): Rational {
        return new static($this->num->modulo($this->denom), $this->denom);
    }

    /**
     * @param Rational $value
     * @return bool
     */
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

    /**
     * @param Rational $value
     * @return bool
     */
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

    /**
     * @param Rational $value
     * @return bool
     */
    public function isGreaterThan(Rational $value): bool {
        if ($this->isEqualTo($value) || $this->isLessThan($value)) {
            return false;
        }
        return true;
    }

    /**
     * @param Integer $value
     * @return bool
     */
    public function isEqualToInteger(Integer $value): bool {
        return $this->isEqualTo(static::makeInteger($value));
    }

    /**
     * @param Integer $value
     * @return bool
     */
    public function isLessThanInteger(Integer $value): bool {
        return $this->isLessThan(static::makeInteger($value));
    }

    /**
     * @param Integer $value
     * @return bool
     */
    public function isGreaterThanInteger(Integer $value): bool {
        return $this->isGreaterThan(static::makeInteger($value));
    }

    /**
     * @return Rational
     */
    public function getSimplified(): Rational {
        $gcd = $this->num->getGreatestCommonDivisor($this->denom);
        $newNum = $this->num->getValue() / $gcd;
        $newDenom = $this->denom->getValue() / $gcd;
        return new static(integer($newNum), integer($newDenom));
    }

    /**
     * @return bool
     */
    public function isPositive(): bool {
        if ($this->num->isPositive() && $this->denom->isPositive()) {
            return true;
        } else if ($this->num->isNegative() && $this->denom->isNegative()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isNegative(): bool {
        if ($this->num->isNegative() && $this->denom->isPositive()) {
            return true;
        } else if ($this->num->isPositive() && $this->denom->isNegative()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isZero(): bool {
        return $this->num->isZero();
    }
}
