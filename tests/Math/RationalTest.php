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
        $this->assertEquals($rational->getNumerator()->getValue(), 15);
        $this->assertEquals($rational->getDenominator()->getValue(), -16);
    }

    public function testHelperConstructorMethods() {
        $first = Rational::makeInteger($this->makeInteger(15));
        $this->assertRational($first);
        $this->assertEquals($first->getNumerator()->getValue(), 15);
        $this->assertEquals($first->getDenominator()->getValue(), 1);

        $second = Rational::makeZero($this->makeInteger(5));
        $this->assertRational($second);
        $this->assertEquals($second->getNumerator()->getValue(), 0);
        $this->assertEquals($second->getDenominator()->getValue(), 5);

        $third = Rational::makeZero();
        $this->assertRational($third);
        $this->assertEquals($third->getNumerator()->getValue(), 0);
        $this->assertNotEquals($third->getDenominator()->getValue(), 0);
    }

    public function testConstructorZeroDenominatorException() {
        $this->setExpectedException('Math\\Exceptions\\ZeroDenominatorException');
        $this->make(1, 0);
    }

    public function testGetNumeratorMethod() {
        $rational = $this->make(1, 1);
        $this->assertInteger($rational->getNumerator());
        $this->assertEquals($rational->getNumerator()->getValue(), 1);
    }

    public function testSetNumeratorMethod() {
        $rational = $this->make(1, 1);
        $rational->setNumerator($this->makeInteger(5));
        $this->assertInteger($rational->getNumerator());
        $this->assertEquals($rational->getNumerator()->getValue(), 5);
    }

    public function testGetDenominatorMethod() {
        $rational = $this->make(1, 1);
        $this->assertInteger($rational->getDenominator());
        $this->assertEquals($rational->getDenominator()->getValue(), 1);
    }

    public function testSetDenominatorMethod() {
        $rational = $this->make(1, 1);
        $rational->setDenominator($this->makeInteger(3));
        $this->assertInteger($rational->getDenominator());
        $this->assertEquals($rational->getDenominator()->getValue(), 3);

        $this->setExpectedException('Math\\Exceptions\\ZeroDenominatorException');
        $rational->setDenominator($this->makeInteger(0));
    }

    public function testGetInverseMethod() {
        $rational = $this->make(3, 5)->getInverse();
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 5);
        $this->assertEquals($rational->getDenominator()->getValue(), 3);

        $this->setExpectedException('Math\\Exceptions\\NoInverseException');
        $this->make(0, 1)->getInverse();
    }

    public function testMultiplyMethod() {
        $rational = $this->make(5, 6)->multiply($this->make(3, 2));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 15);
        $this->assertEquals($rational->getDenominator()->getValue(), 12);

        $rational = $this->make(3, 1)->multiply($this->make(4, 5));
        $this->assertEquals($rational->getNumerator()->getValue(), 12);
        $this->assertEquals($rational->getDenominator()->getValue(), 5);

        $rational = $this->make(0, 2)->multiply($this->make(2, 3));
        $this->assertEquals($rational->getNumerator()->getValue(), 0);
        $this->assertEquals($rational->getDenominator()->getValue(), 6);
    }

    public function testDivideMethod() {
        $rational = $this->make(2, 3)->divide($this->make(5, 4));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 8);
        $this->assertEquals($rational->getDenominator()->getValue(), 15);

        $this->setExpectedException('Math\\Exceptions\\NoInverseException');
        $this->make(2, 3)->divide($this->make(0, 1));
    }

    public function testAddMethod() {
        $rational = $this->make(5, 6)->add($this->make(2, 3));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 27);
        $this->assertEquals($rational->getDenominator()->getValue(), 18);

        $rational = $this->make(2, 4)->add($this->make(3, 6));
        $this->assertEquals($rational->getNumerator()->getValue(), 24);
        $this->assertEquals($rational->getDenominator()->getValue(), 24);
    }

    public function testSubtractMethod() {
        $rational = $this->make(5, 5)->subtract($this->make(3, 5));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 10);
        $this->assertEquals($rational->getDenominator()->getValue(), 25);

        $rational = $this->make(7, 10)->subtract($this->make(1, 3));
        $this->assertEquals($rational->getNumerator()->getValue(), 11);
        $this->assertEquals($rational->getDenominator()->getValue(), 30);
    }

    public function testMultiplyByIntegerMethod() {
        $rational = $this->make(3, 5)->multiplyByInteger($this->makeInteger(4));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 12);
        $this->assertEquals($rational->getDenominator()->getValue(), 5);
    }

    public function testDivideByIntegerMethod() {
        $rational = $this->make(5, 6)->divideByInteger($this->makeInteger(3));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 5);
        $this->assertEquals($rational->getDenominator()->getValue(), 18);
    }

    public function testAddIntegerMethod() {
        $rational = $this->make(3, 7)->addInteger($this->makeInteger(2));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 17);
        $this->assertEquals($rational->getDenominator()->getValue(), 7);
    }

    public function testSubtractIntegerMethod() {
        $rational = $this->make(3, 5)->subtractInteger($this->makeInteger(2));
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), -7);
        $this->assertEquals($rational->getDenominator()->getValue(), 5);
    }

    public function testIncrementMethod() {
        $rational = $this->make(1, 2);
        $rational->increment();
        $this->assertEquals($rational->getNumerator()->getValue(), 3);
        $this->assertEquals($rational->getDenominator()->getValue(), 2);
    }

    public function testDecrementMethod() {
        $rational = $this->make(2, 5);
        $rational->decrement();
        $this->assertEquals($rational->getNumerator()->getValue(), -3);
        $this->assertEquals($rational->getDenominator()->getValue(), 5);
    }

    public function testIsEqualToMethod() {
        $this->assertTrue($this->make(1, 3)->isEqualTo($this->make(1, 3)));
        $this->assertTrue($this->make(5, 10)->isEqualTo($this->make(1, 2)));
        $this->assertTrue($this->make(18, 24)->isEqualTo($this->make(21, 28)));
        $this->assertFalse($this->make(3, 7)->isEqualTo($this->make(7, 3)));
        $this->assertFalse($this->make(9, 12)->isEqualTo($this->make(3, 5)));
        $this->assertFalse($this->make(10, 1)->isEqualTo($this->make(110, 10)));
    }

    public function testGetSimplifiedMethod() {
        $rational = $this->make(10, 20)->getSimplified();
        $this->assertRational($rational);
        $this->assertEquals($rational->getNumerator()->getValue(), 1);
        $this->assertEquals($rational->getDenominator()->getValue(), 2);
    }

    public function testSimplifyMethod() {
        $rational = $this->make(15, 40);
        $rational->simplify();
        $this->assertEquals($rational->getNumerator()->getValue(), 3);
        $this->assertEquals($rational->getDenominator()->getValue(), 8);
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
