<?php

namespace Math;

use ReflectionClass;

class ComplexTest extends Dev\TestCase {

    public function testClassExists() {
        $this->assertTrue(class_exists('Math\\Complex'));
    }

    public function testClassIsFinal() {
        $this->assertTrue((new ReflectionClass('Math\\Complex'))->isFinal());
    }

    public function testGetRealPartMethod() {
        $this->assertInteger($this->make(3, 5)->getRealPart());
        $this->assertEquals($this->make(3, 5)->getRealPart()->getValue(), 3);
    }

    public function testGetImagPartMethod() {
        $this->assertInteger($this->make(3, 5)->getImagPart());
        $this->assertEquals($this->make(3, 5)->getImagPart()->getValue(), 5);
    }

    public function testAddMethod() {
        $this->assertComplex($this->make(3, 4)->add($this->make(1, 2)));

        $complex = $this->make(3, 4)->add($this->make(1, 2));
        $this->assertEquals($complex->getRealPart()->getValue(), 4);
        $this->assertEquals($complex->getImagPart()->getValue(), 6);

        $complex = $this->make(-7, 4)->add($this->make(3, -20));
        $this->assertEquals($complex->getRealPart()->getValue(), -4);
        $this->assertEquals($complex->getImagPart()->getValue(), -16);
    }

    public function testSubtractMethod() {
        $this->assertComplex($this->make(-1, 1)->subtract($this->make(5, -5)));

        $complex = $this->make(-1, 1)->subtract($this->make(5, -5));
        $this->assertEquals($complex->getRealPart()->getValue(), -6);
        $this->assertEquals($complex->getImagPart()->getValue(), 6);

        $complex = $this->make(10, 0)->subtract($this->make(0, -30));
        $this->assertEquals($complex->getRealPart()->getValue(), 10);
        $this->assertEquals($complex->getImagPart()->getValue(), 30);
    }

    public function testMultiplyMethod() {
        $this->assertComplex($this->make(1, 1)->multiply($this->make(1, 1)));

        $complex = $this->make(3, 7)->multiply($this->make(4, 2));
        $this->assertEquals($complex->getRealPart()->getValue(), -2);
        $this->assertEquals($complex->getImagPart()->getValue(), 34);

        $complex = $this->make(-5, -8)->multiply($this->make(4, 7));
        $this->assertEquals($complex->getRealPart()->getValue(), 36);
        $this->assertEquals($complex->getImagPart()->getValue(), -67);
    }

    private function assertComplex($value) {
        $this->assertInstanceOf('Math\\Complex', $value);
    }

    private function assertInteger($value) {
        $this->assertInstanceOf('Math\\Integer', $value);
    }

    private function make(int $real, int $imag): Complex {
        return new Complex(new Integer($real), new Integer($imag));
    }
}
