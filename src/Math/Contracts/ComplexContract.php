<?php

namespace Math\Contracts;

use Math\Integer;

interface ComplexContract {

    public function __construct(Integer $real, Integer $imag);

    public function getRealPart(): Integer;
    public function getImagPart(): Integer;
}
