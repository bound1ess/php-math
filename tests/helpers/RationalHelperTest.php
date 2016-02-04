<?php

use Math\Dev\TestCase;

class RationalHelperTest extends TestCase {

    public function testRationalHelperFunction() {
        $this->check(rational(), 0, 1);
        $this->check(rational(5), 5, 1);
        $this->check(rational(3, 2), 3, 2);
    }

    private function check($value, int $num, int $denom) {
        $this->assertInstanceOf('Math\\Rational', $value);
        $this->assertEquals($value->getNumerator()->getValue(), $num);
        $this->assertEquals($value->getDenominator()->getValue(), $denom);
    }
}
