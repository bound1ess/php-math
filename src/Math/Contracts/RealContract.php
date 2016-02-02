<?php

namespace Math\Contracts;

interface RealContract {

    public function isPositive(): bool;
    public function isNegative(): bool;
    public function isZero(): bool;
}
