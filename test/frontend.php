<?php
require('../frontend.php');

use PHPUnit\Framework\TestCase;
class functions extends TestCase
{
    function test_getProjectIndex_success_next() {
        $post['next_1'] = '';
        $array[0] = 4;
        $array[1] = 2;
        $array[2] = 9;
        $value = getProjectIndex($post, $array);
        $this->assertEquals($value, 2);
    }

    function test_getProjectIndex_success_prev() {
        $post['prev_1'] = '';
        $array[0] = 4;
        $array[1] = 2;
        $array[2] = 9;
        $value = getProjectIndex($post, $array);
        $this->assertEquals($value, 0);
    }

    function test_getProjectIndex_success_overflow() {
        $post['next_2'] = '';
        $array[0] = 4;
        $array[1] = 2;
        $array[2] = 9;
        $value = getProjectIndex($post, $array);
        $this->assertEquals($value, 0);
    }

    function test_getProjectIndex_success_underflow() {
        $post['prev_0'] = '';
        $array[0] = 4;
        $array[1] = 2;
        $array[2] = 9;
        $value = getProjectIndex($post, $array);
        $this->assertEquals($value, 2);
    }

    function test_getProjectIndex_malform() {
        $this->expectException(TypeError::class);
        $post = '4';
        $array[0] = 4;
        $array[1] = 2;
        $array[2] = 9;
        $value = getProjectIndex($post, $array);
    }
}

?>