<?php

namespace Math;

use ReflectionClass;

class IntegerTest extends Dev\TestCase {

    public function testClassExists() {
        $this->assertTrue(class_exists('Math\\Integer'));
    }

    public function testClassIsFinal() {
        $this->assertTrue((new ReflectionClass('Math\\Integer'))->isFinal());
    }

    public function testGetAbsoluteValueMethod() {
        $this->assertInteger($this->make(1)->getAbsoluteValue());
        $this->assertEquals($this->make(5)->getAbsoluteValue()->getValue(), 5);
        $this->assertEquals($this->make(-10)->getAbsoluteValue()->getValue(), 10);
        $this->assertEquals($this->make(0)->getAbsoluteValue()->getValue(), 0);
    }

    public function testAddMethod() {
        $this->assertInteger($this->make(5)->add($this->make(7)));
        $this->assertEquals($this->make(5)->add($this->make(7))->getValue(), 12);
        $this->assertEquals($this->make(10)->add($this->make(-4))->getValue(), 6);
        $this->assertEquals($this->make(-2)->add($this->make(10))->getValue(), 8);
        $this->assertEquals($this->make(-3)->add($this->make(-6))->getValue(), -9);
    }

    public function testSubtractMethod() {
        $this->assertInteger($this->make(6)->subtract($this->make(8)));
        $this->assertEquals($this->make(6)->subtract($this->make(8))->getValue(), -2);
        $this->assertEquals($this->make(5)->subtract($this->make(-3))->getValue(), 8);
        $this->assertEquals($this->make(-6)->subtract($this->make(8))->getValue(), -14);
        $this->assertEquals($this->make(-3)->subtract($this->make(-4))->getValue(), 1);
    }

    public function testMultiplyMethod() {
        $this->assertInteger($this->make(5)->multiply($this->make(3)));
        $this->assertEquals($this->make(7)->multiply($this->make(4))->getValue(), 28);
        $this->assertEquals($this->make(-9)->multiply($this->make(3))->getValue(), -27);
        $this->assertEquals($this->make(6)->multiply($this->make(-9))->getValue(), -54);
        $this->assertEquals($this->make(-4)->multiply($this->make(-13))->getValue(), 52);
    }

    public function testDivideMethod() {
        $this->assertInteger($this->make(6)->divide($this->make(2)));
        $this->assertEquals($this->make(5)->divide($this->make(2))->getValue(), 2);
        $this->assertEquals($this->make(-4)->divide($this->make(3))->getValue(), -1);
        $this->assertEquals($this->make(19)->divide($this->make(-6))->getValue(), -3);
        $this->assertEquals($this->make(-80)->divide($this->make(-16))->getValue(), 5);

        $this->setExpectedException('Math\\Exceptions\\DivisionByZeroException');
        $this->make(1)->divide($this->make(0));
    }

    public function testModuloMethod() {
        $this->assertInteger($this->make(5)->modulo($this->make(6)));
        $this->assertEquals($this->make(7)->modulo($this->make(3))->getValue(), 1);
        $this->assertEquals($this->make(-19)->modulo($this->make(7))->getValue(), -5);
        $this->assertEquals($this->make(37)->modulo($this->make(-11))->getValue(), 4);
        $this->assertEquals($this->make(-59)->modulo($this->make(-13))->getValue(), -7);

        $this->setExpectedException('Math\\Exceptions\\DivisionByZeroException');
        $this->make(1)->modulo($this->make(0));
    }

    public function testIsDivisibleByMethod() {
        $this->assertTrue($this->make(14)->isDivisibleBy($this->make(2)));
        $this->assertTrue($this->make(68)->isDivisibleBy($this->make(-17)));
        $this->assertTrue($this->make(-27)->isDivisibleBy($this->make(9)));
        $this->assertTrue($this->make(-62)->isDivisibleBy($this->make(-31)));

        $this->assertFalse($this->make(40)->isDivisibleBy($this->make(13)));
        $this->assertFalse($this->make(77)->isDivisibleBy($this->make(5)));
        $this->assertFalse($this->make(39)->isDivisibleBy($this->make(18)));
        $this->assertFalse($this->make(15)->isDivisibleBy($this->make(0)));
    }

    public function testGetGcdMethod() {
        $this->assertInteger($this->make(1)->getGcd($this->make(1)));
        $this->assertEquals($this->make(0)->getGcd($this->make(5))->getValue(), 5);
        $this->assertEquals($this->make(7)->getGcd($this->make(0))->getValue(), 7);
        $this->assertEquals($this->make(0)->getGcd($this->make(0))->getValue(), 0);
        $this->assertEquals($this->make(37)->getGcd($this->make(1))->getValue(), 1);
        $this->assertEquals($this->make(4)->getGcd($this->make(32))->getValue(), 4);
        $this->assertEquals($this->make(15)->getGcd($this->make(55))->getValue(), 5);
        $this->assertEquals($this->make(17)->getGcd($this->make(7))->getValue(), 1);
    }

    public function testGetLcmMethod() {
        $this->assertInteger($this->make(1)->getLcm($this->make(1)));
        $this->assertEquals($this->make(5)->getLcm($this->make(20))->getValue(), 20);
        $this->assertEquals($this->make(3)->getLcm($this->make(7))->getValue(), 21);
        $this->assertEquals($this->make(12)->getLcm($this->make(16))->getValue(), 48);

        $this->setExpectedException('Math\\Exceptions\\LcmNotDefinedException');
        $this->make(0)->getLcm($this->make(0));
    }

    public function testIsPrimeMethod() {
        $this->assertFalse($this->make(1)->isPrime());
        $this->assertFalse($this->make(-8)->isPrime());
        $this->assertFalse($this->make(45)->isPrime());
        $this->assertFalse($this->make(169)->isPrime());

        $this->assertTrue($this->make(17)->isPrime());
        $this->assertTrue($this->make(101)->isPrime());
        $this->assertTrue($this->make(59)->isPrime());

        $integer = $this->make(19);
        $this->assertEquals($integer->isPrime(), $integer->isPrime());
    }

    public function testGetFactorsMethod() {
        $this->assertInternalType('array', $this->make(21)->getFactors());
        $this->assertEquals($this->make(18)->getFactors(), [1, 18, 2, 9, 3, 6]);
        $this->assertEquals($this->make(0)->getFactors(), []);
        $this->assertEquals($this->make(-10)->getFactors(), [1, 10, 2, 5]);
        $this->assertEquals($this->make(-16)->getFactors(), [1, 16, 2, 8, 4]);

        $integer = $this->make(13);
        $this->assertEquals($integer->getFactors(), [1, 13]);
        $this->assertCount(2, $integer->getFactors());
    }

    public function testFlipSignMethod() {
        $this->assertInteger($this->make(1)->flipSign());
        $this->assertEquals($this->make(5)->flipSign()->getValue(), -5);
        $this->assertEquals($this->make(-3)->flipSign()->getValue(), 3);
        $this->assertEquals($this->make(0)->flipSign()->getValue(), 0);
    }

    public function testGetDigitsMethod() {
        $this->assertInternalType('array', $this->make(123)->getDigits());
        $this->assertEquals($this->make(123)->getDigits(), [1, 2, 3]);
        $this->assertEquals($this->make(0)->getDigits(), []);
        $this->assertEquals($this->make(-789)->getDigits(), [7, 8, 9]);
    }

    public function testFactorialMethod() {
        $this->assertInteger($this->make(0)->factorial());
        $this->assertEquals($this->make(0)->factorial()->getValue(), 1);
        $this->assertEquals($this->make(5)->factorial()->getValue(), 120);
        $this->assertEquals($this->make(3)->factorial()->getValue(), 6);
        $this->assertEquals($this->make(6)->factorial()->getValue(), 720);

        $this->setExpectedException('Math\\Exceptions\\FactorialNotDefinedException');
        $this->make(-1)->factorial();
    }

    public function testPowerMethod() {
        $this->assertInteger($this->make(2)->power($this->make(4)));
        $this->assertEquals($this->make(2)->power($this->make(4))->getValue(), 16);
        $this->assertEquals($this->make(17)->power($this->make(0))->getValue(), 1);
        $this->assertEquals($this->make(-5)->power($this->make(2))->getValue(), 25);
        $this->assertEquals($this->make(-3)->power($this->make(3))->getValue(), -27);
        $this->assertEquals($this->make(-4)->power($this->make(5))->getValue(), -1024);
    }

    public function testPowerMethodException() {
        $this->setExpectedException('Math\\Exceptions\\NegativeExponentException');
        $this->make(15)->power($this->make(-1));
    }

    public function testPowerMethodAnotherException() {
        $this->setExpectedException('Math\\Exceptions\\BaseIsZeroException');
        $this->make(0)->power($this->make(0));
    }

    public function testIsLessThanMethod() {
        $this->assertTrue($this->make(1)->isLessThan($this->make(2)));
        $this->assertTrue($this->make(-5)->isLessThan($this->make(1)));
        $this->assertTrue($this->make(7)->isLessThan($this->make(9)));
        $this->assertTrue($this->make(-2)->isLessThan($this->make(-1)));
        $this->assertFalse($this->make(3)->isLessThan($this->make(2)));
        $this->assertFalse($this->make(-6)->isLessThan($this->make(-7)));
        $this->assertFalse($this->make(2)->isLessThan($this->make(-2)));
    }

    public function testIsEqualToMethod() {
        $this->assertTrue($this->make(15)->isEqualTo($this->make(15)));
        $this->assertFalse($this->make(-2)->isEqualTo($this->make(2)));
    }

    public function testIsGreaterThanMethod() {
        $this->assertTrue($this->make(2)->isGreaterThan($this->make(1)));
        $this->assertTrue($this->make(-2)->isGreaterThan($this->make(-3)));
        $this->assertTrue($this->make(1)->isGreaterThan($this->make(0)));
        $this->assertFalse($this->make(-2)->isGreaterThan($this->make(-1)));
        $this->assertFalse($this->make(5)->isGreaterThan($this->make(6)));
        $this->assertFalse($this->make(-1)->isGreaterThan($this->make(3)));
    }

    private function make(int $value): Integer {
        return new Integer($value);
    }

    private function assertInteger($value) {
        $this->assertInstanceOf('Math\\Integer', $value);
    }
}
