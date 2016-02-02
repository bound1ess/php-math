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

    public function testGetGreatestCommonDivisorMethod() {
        $this->assertEquals($this->make(0)->getGreatestCommonDivisor($this->make(5)), 5);
        $this->assertEquals($this->make(7)->getGreatestCommonDivisor($this->make(0)), 7);
        $this->assertEquals($this->make(0)->getGreatestCommonDivisor($this->make(0)), 0);
        $this->assertEquals($this->make(37)->getGreatestCommonDivisor($this->make(1)), 1);
        $this->assertEquals($this->make(4)->getGreatestCommonDivisor($this->make(32)), 4);
        $this->assertEquals($this->make(15)->getGreatestCommonDivisor($this->make(55)), 5);
        $this->assertEquals($this->make(17)->getGreatestCommonDivisor($this->make(7)), 1);
    }

    private function make(int $value): Integer {
        return new Integer($value);
    }
}
