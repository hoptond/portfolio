<?php
require('../frontend.php');

use PHPUnit\Framework\TestCase;
class functions extends TestCase
{
    public function test_roundValue_success_exact() {
        $array[0] = 1;
        $array[1] = 3;
        $array[2] = 14;
        $array[3] = 15;
        $array[4] = 16;
        $array[5] = 19;
        $value = roundValue($array, 1, TRUE);
        $this->assertEquals(1, $value);
   }

    public function test_roundValue_success_roundup() {
        $array[0] = 1;
        $array[1] = 3;
        $array[2] = 14;
        $array[3] = 15;
        $array[4] = 16;
        $array[5] = 19;
        $value = roundValue($array, 4, TRUE);
        $this->assertEquals(14, $value);
    }

    public function test_roundValue_success_rounddown() {
        $array[0] = 2;
        $array[1] = 3;
        $array[2] = 14;
        $array[3] = 15;
        $array[4] = 16;
        $array[5] = 19;
        $value = roundValue($array, 18, FALSE);
        $this->assertEquals(16, $value);
    }

}

?>