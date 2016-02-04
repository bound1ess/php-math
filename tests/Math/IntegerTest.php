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
        $this->assertEquals($this->make(5)->getAbsoluteValue(), 5);
        $this->assertEquals($this->make(-10)->getAbsoluteValue(), 10);
        $this->assertEquals($this->make(0)->getAbsoluteValue(), 0);
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

    public function testGetGreatestCommonDivisorMethod() {
        $this->assertEquals($this->make(0)->getGreatestCommonDivisor($this->make(5)), 5);
        $this->assertEquals($this->make(7)->getGreatestCommonDivisor($this->make(0)), 7);
        $this->assertEquals($this->make(0)->getGreatestCommonDivisor($this->make(0)), 0);
        $this->assertEquals($this->make(37)->getGreatestCommonDivisor($this->make(1)), 1);
        $this->assertEquals($this->make(4)->getGreatestCommonDivisor($this->make(32)), 4);
        $this->assertEquals($this->make(15)->getGreatestCommonDivisor($this->make(55)), 5);
        $this->assertEquals($this->make(17)->getGreatestCommonDivisor($this->make(7)), 1);
    }

    public function testGetLeastCommonMultipleMethod() {
        $this->assertEquals($this->make(5)->getLeastCommonMultiple($this->make(20)), 20);
        $this->assertEquals($this->make(3)->getLeastCommonMultiple($this->make(7)), 21);
        $this->assertEquals($this->make(12)->getLeastCommonMultiple($this->make(16)), 48);

        $this->setExpectedException('Math\\Exceptions\\LcmNotDefinedException');
        $this->make(0)->getLeastCommonMultiple($this->make(0));
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

    private function make(int $value): Integer {
        return new Integer($value);
    }

    private function assertInteger($value) {
        $this->assertInstanceOf('Math\\Integer', $value);
    }
}
