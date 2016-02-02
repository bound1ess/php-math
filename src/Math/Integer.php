<?php

namespace Math;

use Math\Contracts\IntegerContract;
use Math\Exceptions\LcmNotDefinedException;

final class Integer extends Real implements IntegerContract {

    private static $ZERO = 0;

    private $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value;
    }

    public function getAbsoluteValue(): int {
        return abs($this->value);
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
