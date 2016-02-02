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

    public function testConstructorMethod() {
        $rational = $this->make(15, -16);
        $this->assertInteger($rational->getNumerator());
        $this->assertEquals($rational->getNumerator()->getValue(), 15);
        $this->assertInteger($rational->getDenominator());
        $this->assertEquals($rational->getDenominator()->getValue(), -16);
    }

    public function testHelperConstructorMethods() {
        $first = Rational::makeInteger($this->makeInteger(15));
        $this->assertRational($first);
        $this->assertInteger($first->getNumerator());
        $this->assertEquals($first->getNumerator()->getValue(), 15);
        $this->assertInteger($first->getDenominator());
        $this->assertEquals($first->getDenominator()->getValue(), 1);

        $second = Rational::makeZero($this->makeInteger(5));
        $this->assertRational($second);
        $this->assertInteger($second->getNumerator());
        $this->assertEquals($second->getNumerator()->getValue(), 0);
        $this->assertInteger($second->getDenominator());
        $this->assertEquals($second->getDenominator()->getValue(), 5);

        $third = Rational::makeZero();
        $this->assertRational($third);
        $this->assertInteger($third->getNumerator());
        $this->assertEquals($third->getNumerator()->getValue(), 0);
        $this->assertInteger($third->getDenominator());
        $this->assertNotEquals($third->getDenominator()->getValue(), 0);
    }

    public function testConstructorZeroDenominatorException() {
        $this->setExpectedException('Math\\Exceptions\\ZeroDenominatorException');
        $this->make(1, 0);
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

    private function makeInteger(int $value): Integer {
        return new Integer($value);
    }

    private function make(int $num, int $denom): Rational {
        return new Rational($this->makeInteger($num), $this->makeInteger($denom));
    }

    private function assertInteger($value) {
        $this->assertInstanceOf('Math\\Integer', $value);
    }

    private function assertRational($value) {
        $this->assertInstanceOf('Math\\Rational', $value);
    }
}
