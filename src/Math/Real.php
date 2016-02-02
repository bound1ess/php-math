<?php

namespace Math;

abstract class Real extends Number implements Contracts\RealContract {

    abstract public function isPositive(): bool;
    abstract public function isNegative(): bool;
    abstract public function isZero(): bool;
}
