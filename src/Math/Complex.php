<?php

namespace Math;

use Math\Contracts\ComplexContract;

final class Complex extends Number implements ComplexContract {

    /**
     * @var Integer
     */
    private $real;

    /**
     * @var Integer
     */
    private $imag;

    /**
     * @param Integer $real
     * @param Integer $imag
     * @return void
     */
    public function __construct(Integer $real, Integer $imag) {
        $this->real = $real;
        $this->imag = $imag;
    }

    /**
     * @return Integer
     */
    public function getRealPart(): Integer {
        return $this->real;
    }

    /**
     * @return Integer
     */
    public function getImagPart(): Integer {
        return $this->imag;
    }

    /**
     * @param Complex $value
     * @return Complex
     */
    public function add(Complex $value): Complex {
        $newReal = $this->real->add($value->getRealPart());
        $newImag = $this->imag->add($value->getImagPart());
        return new static($newReal, $newImag);
    }
}
