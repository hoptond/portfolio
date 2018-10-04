<?php
require('../frontend.php');

use PHPUnit\Framework\TestCase;
class functions extends TestCase
{
    public function test_roundValueUp_success() {
        $array[0] = 2;
        $array[1] = 3;
        $array[2] = 4;
        $array[3] = 9;
        $array[4] = 14;
        $array[5] = 17;
        $array[6] = 19;
        $array[7] = 29;
        $value = roundValueUp($array, 18);
        $this->assertEquals(19, $value);
    }

    public function test_roundValueUp_error() {
        $array[0] = 2;
        $array[1] = 3;
        $array[2] = 4;
        $array[3] = 9;
        $array[4] = 14;
        $array[5] = 17;
        $array[6] = 19;
        $array[7] = 29;
        $value = roundValueUp($array, 31);
        $this->assertEquals(31, $value);
    }

    public function test_roundValueUp_malform() {
        $array[0] = 2;
        $array[1] = 3;
        $array[2] = 4;
        $array[3] = 9;
        $array[4] = 14;
        $array[5] = 17;
        $array[6] = 19;
        $array[7] = 29;
        $value = roundValueUp($array, 'NO!');
        $this->assertEquals('NO!', $value);
    }

    public function test_roundValueDown_success() {
        $array[0] = 2;
        $array[1] = 3;
        $array[2] = 4;
        $array[3] = 9;
        $array[4] = 14;
        $array[5] = 17;
        $array[6] = 19;
        $array[7] = 29;
        $value = roundValueDown($array, 18);
        $this->assertEquals(17, $value);
    }

    public function test_roundValueDown_error() {
        $array[0] = 2;
        $array[1] = 3;
        $array[2] = 4;
        $array[3] = 9;
        $array[4] = 14;
        $array[5] = 17;
        $array[6] = 19;
        $array[7] = 29;
        $value = roundValueDown($array, 5);
        $this->assertEquals(4, $value);
    }

    public function test_roundValueDown_malform() {
        $array[0] = 2;
        $array[1] = 3;
        $array[2] = 4;
        $array[3] = 9;
        $array[4] = 14;
        $array[5] = 17;
        $array[6] = 19;
        $array[7] = 29;
        $value = roundValueUp($array, 'NO!');
        $this->assertEquals('NO!', $value);
    }

}

?>