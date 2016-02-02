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
}
