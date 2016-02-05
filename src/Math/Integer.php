<?php

namespace Math;

use Math\Contracts\IntegerContract;
use Math\Exceptions\{LcmNotDefinedException, DivisionByZeroException};

final class Integer extends Real implements IntegerContract {

    private static $ZERO = 0;

    private $value;

    private $isPrime, $isPrimeTestCached;

    public function __construct(int $value) {
        $this->value = $value;
        $this->isPrimeTestCached = false;
    }

    public function getValue(): int {
        return $this->value;
    }

    public function getAbsoluteValue(): int {
        return abs($this->value);
    }

    public function add(Integer $value): Integer {
        return new Integer($this->value + $value->getValue());
    }

    public function subtract(Integer $value): Integer {
        return new Integer($this->value - $value->getValue());
    }

    public function multiply(Integer $value): Integer {
        return new Integer($this->value * $value->getValue());
    }

    public function divide(Integer $value): Integer {
        if ($value->getValue() == 0) {
            throw new DivisionByZeroException();
        }
        return new Integer(intdiv($this->value, $value->getValue()));
    }

    public function modulo(Integer $value): Integer {
        if ($value->getValue() == 0) {
            throw new DivisionByZeroException();
        }
        return new Integer($this->value % $value->getValue());
    }

    public function isDivisibleBy(Integer $value): bool {
        try {
            $modulo = $this->modulo($value)->getValue();
            return 0 == $modulo;
        } catch (DivisionByZeroException $error) {
            return false;
        }
    }

    public function getGreatestCommonDivisor(Integer $value): int {
        $first = $this->getAbsoluteValue();
        $second = $value->getAbsoluteValue();

        if (0 == $first && 0 == $second) {
            return 0;
        } else if (0 == $first) {
            return $second;
        } else if (0 == $second) {
            return $first;
        }

        while (true) {
            $remainder = $first % $second;
            if (0 == $remainder) {
                break;
            }
            $first = $second;
            $second = $remainder;
        }
        return $second;
    }

    public function getLeastCommonMultiple(Integer $value): int {
        $first = $this->value;
        $second = $value->getValue();
        $gcd = $this->getGreatestCommonDivisor($value);

        if (0 == $gcd) {
            throw new LcmNotDefinedException();
        }

        return abs($first * $second) / $gcd;
    }

    public function isPrime(): bool {
        if ($this->isPrimeTestCached) {
            return $this->isPrime;
        }
        $isPrime = false;
        if (1 < $this->value) {
            $isPrime = true;
            for ($divisor = 2; $divisor * $divisor <= $this->value; ++$divisor) {
                if ($this->value % $divisor == 0) {
                    $isPrime = false;
                    break;
                }
            }
        }
        $this->isPrimeTestCached = true;
        $this->isPrime = $isPrime;
        return $isPrime;
    }

    public function isPositive(): bool {
        return static::$ZERO < $this->value;
    }

    public function isNegative(): bool {
        return static::$ZERO > $this->value;
    }

    public function isZero(): bool {
        return static::$ZERO == $this->value;
    }
}
