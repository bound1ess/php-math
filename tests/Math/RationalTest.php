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
}
