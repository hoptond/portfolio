<?php
require('../../edit/security_functions.php');

use PHPUnit\Framework\TestCase;
class functions extends TestCase
{
    public function test_loginExists_success() {
        $name = 'badmin';
        $this->assertEquals(loginExists($name), TRUE);
    }
    public function test_loginExists_fail() {
        $name = 'ff';
        $this->assertEquals(loginExists($name), FALSE);
    }

}