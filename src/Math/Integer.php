<?php

namespace Math;

final class Integer extends Real {

    private static $ZERO = 0;

    private $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value; // @todo make a part of the contract
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
