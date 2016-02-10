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
     * @return Complex
     */
    public function getConjugate(): Complex {
        return new static($this->real, $this->imag->flipSign());
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

    /**
     * @param Complex $value
     * @return Complex
     */
    public function subtract(Complex $value): Complex {
        $newReal = $this->real->subtract($value->getRealPart());
        $newImag = $this->imag->subtract($value->getImagPart());
        return new static($newReal, $newImag);
    }

    /**
     * @param Complex $value
     * @return Complex
     */
    public function multiply(Complex $value): Complex {
        // (a + bi)(c + di) = ac + adi + bci + bdi^2
        // = ac + (ad + bc)i - bd = (ac - bd) + (ad + bc)i
        $newReal = $this->real->multiply($value->getRealPart());
        $newReal = $newReal->subtract($this->imag->multiply($value->getImagPart()));
        $newImag = $this->real->multiply($value->getImagPart());
        $newImag = $newImag->add($this->imag->multiply($value->getRealPart()));
        return new static($newReal, $newImag);
    }

    /**
     * @param Complex $value
     * @return array
     */
    public function divide(Complex $value): array {
        $newReal = $this->multiply($value->getConjugate());
        $newImag = $value->multiply($value->getConjugate());
        return [$newReal, $newImag];
    }
}
