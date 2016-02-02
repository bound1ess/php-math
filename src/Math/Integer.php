<?php

namespace Math;

use Math\Contracts\IntegerContract;

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
