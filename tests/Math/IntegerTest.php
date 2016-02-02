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

    private function make(int $value): Integer {
        return new Integer($value);
    }
}
