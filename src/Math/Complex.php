<?php

namespace Math;

final class Complex extends Number {

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
}
