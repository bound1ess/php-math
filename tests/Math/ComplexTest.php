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
