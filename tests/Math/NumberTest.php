<?php

namespace Math;

use ReflectionClass;

class NumberTest extends Dev\TestCase {

    public function testClassExists() {
        $this->assertTrue(class_exists('Math\\Number'));
    }

    public function testClassIsAbstract() {
        $this->assertTrue((new ReflectionClass('Math\\Number'))->isAbstract());
    }
}
