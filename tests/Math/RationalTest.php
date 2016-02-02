<?php

namespace Math;

use ReflectionClass;

class RationalTest extends Dev\TestCase {

    public function testClassExists() {
        $this->assertTrue(class_exists('Math\\Rational'));
    }

    public function testClassIsFinal() {
        $this->assertTrue((new ReflectionClass('Math\\Rational'))->isFinal());
    }

    public function testIsPositiveMethod() {
        $this->assertTrue($this->make(3, 7)->isPositive());
        $this->assertTrue($this->make(-5, -10)->isPositive());
        $this->assertFalse($this->make(15, -25)->isPositive());
        $this->assertFalse($this->make(-123, 515)->isPositive());
    }

    public function testIsNegativeMethod() {
        $this->assertTrue($this->make(1, -2)->isNegative());
        $this->assertTrue($this->make(-55, 3)->isNegative());
        $this->assertFalse($this->make(1234, 12)->isNegative());
        $this->assertFalse($this->make(-678, -8961)->isNegative());
    }

    public function testIsZeroMethod() {
        $this->assertTrue($this->make(0, 234)->isZero());
        $this->assertTrue($this->make(0, -15)->isZero());
        $this->assertFalse($this->make(1, 1)->isZero());
        $this->assertFalse($this->make(-15, -2)->isZero());
        $this->assertFalse($this->make(-3, 1234)->isZero());
        $this->assertFalse($this->make(5, -2)->isZero());
    }

    private function make(int $num, int $denom): Rational {
        return new Rational(new Integer($num), new Integer($denom));
    }
}
