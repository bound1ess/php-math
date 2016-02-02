<?php

namespace Math;

use ReflectionClass;

class RealTest extends Dev\TestCase {

    public function testClassExists() {
        $this->assertTrue(class_exists('Math\\Real'));
    }

    public function testClassIsAbstract() {
        $this->assertTrue((new ReflectionClass('Math\\Real'))->isAbstract());
    }
}
