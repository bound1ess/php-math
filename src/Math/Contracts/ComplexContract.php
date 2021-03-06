<?php

namespace Math\Contracts;

use Math\{Integer, Complex};

interface ComplexContract {

    public function __construct(Integer $real, Integer $imag);

    public function getRealPart(): Integer;
    public function getImagPart(): Integer;

    public function getConjugate(): Complex;

    public function add(Complex $value): Complex;
    public function subtract(Complex $value): Complex;
    public function multiply(Complex $value): Complex;
    public function divide(Complex $value): array;
}
