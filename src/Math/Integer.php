<?php

namespace Math;

use Math\Contracts\IntegerContract;
use Math\Exceptions\{LcmNotDefinedException, DivisionByZeroException};

final class Integer extends Real implements IntegerContract {

    /**
     * @var int
     */
    private static $ZERO = 0;

    /**
     * @var int
     */
    private $value;

    /**
     * @var bool
     */
    private $isPrime;

    /**
     * @var bool
     */
    private $isPrimeTestCached;

    /**
     * @var array
     */
    private $factors;

    /**
     * @var bool
     */
    private $areFactorsCached;

    /**
     * @param int $value
     * @return void
     */
    public function __construct(int $value) {
        $this->value = $value;
        $this->isPrimeTestCached = false;
        $this->areFactorsCached = false;
    }

    /**
     * @return int
     */
    public function getValue(): int {
        return $this->value;
    }

    /**
     * @return Integer
     */
    public function getAbsoluteValue(): Integer {
        return new static(abs($this->value));
    }

    /**
     * @param Integer $value
     * @return Integer
     */
    public function add(Integer $value): Integer {
        return new static($this->value + $value->getValue());
    }

    /**
     * @param Integer $value
     * @return Integer
     */
    public function subtract(Integer $value): Integer {
        return new static($this->value - $value->getValue());
    }

    /**
     * @param Integer $value
     * @return Integer
     */
    public function multiply(Integer $value): Integer {
        return new static($this->value * $value->getValue());
    }

    /**
     * @param Integer $value
     * @return Integer
     */
    public function divide(Integer $value): Integer {
        if ($value->getValue() == 0) {
            throw new DivisionByZeroException();
        }
        return new static(intdiv($this->value, $value->getValue()));
    }

    /**
     * @param Integer $value
     * @return Integer
     */
    public function modulo(Integer $value): Integer {
        if ($value->getValue() == 0) {
            throw new DivisionByZeroException();
        }
        return new static($this->value % $value->getValue());
    }

    /**
     * @param Integer $value
     * @return bool
     */
    public function isDivisibleBy(Integer $value): bool {
        try {
            $modulo = $this->modulo($value)->getValue();
            return 0 == $modulo;
        } catch (DivisionByZeroException $error) {
            return false;
        }
    }

    /**
     * @param Integer $value
     * @return Integer
     */
    public function getGcd(Integer $value): Integer {
        $first = $this->getAbsoluteValue()->getValue();
        $second = $value->getAbsoluteValue()->getValue();

        if (0 == $first && 0 == $second) {
            return new static(static::$ZERO);
        } else if (0 == $first) {
            return new static($second);
        } else if (0 == $second) {
            return new static($first);
        }

        while (true) {
            $remainder = $first % $second;
            if (0 == $remainder) {
                break;
            }
            $first = $second;
            $second = $remainder;
        }
        return new static($second);
    }

    /**
     * @param Integer $value
     * @return Integer
     */
    public function getLcm(Integer $value): Integer {
        $first = $this->value;
        $second = $value->getValue();
        $gcd = $this->getGcd($value)->getValue();

        if (0 == $gcd) {
            throw new LcmNotDefinedException();
        }

        return new static(abs($first * $second) / $gcd);
    }

    /**
     * @return bool
     */
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

    /**
     * @return array
     */
    public function getFactors(): array {
        if ($this->areFactorsCached) {
            return $this->factors;
        }
        $factors = [];
        $value = abs($this->value);
        for ($i = 1; $i * $i <= $value; ++$i) {
            if ($value % $i == 0) {
                $factors[] = $i;
                $factors[] = $value / $i;
            }
        }
        $factors = array_unique($factors);
        $this->areFactorsCached = true;
        $this->factors = $factors;
        return $factors;
    }

    /**
     * @return bool
     */
    public function isPositive(): bool {
        return static::$ZERO < $this->value;
    }

    /**
     * @return bool
     */
    public function isNegative(): bool {
        return static::$ZERO > $this->value;
    }

    /**
     * @return bool
     */
    public function isZero(): bool {
        return static::$ZERO == $this->value;
    }
}
