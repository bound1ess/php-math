<?php

use Math\Dev\TestCase;

class ComplexHelperTest extends TestCase {

    public function testComplexHelperFunction() {
        $this->assertTrue(function_exists('complex'));
        $this->assertInstanceOf('Math\\Complex', complex(1, 1));
        $complex = complex(1, 2);
        $this->assertEquals($complex->getRealPart()->getValue(), 1);
        $this->assertEquals($complex->getImagPart()->getValue(), 2);
    }
}
