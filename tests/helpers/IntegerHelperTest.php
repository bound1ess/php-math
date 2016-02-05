<?php

use Math\Dev\TestCase;

class IntegerHelperTest extends TestCase {

    public function testIntegerHelperFunction() {
        $integer = integer(15);
        $this->assertInstanceOf('Math\\Integer', $integer);
        $this->assertEquals($integer->getValue(), 15);
    }
}
