<?php
require('../../edit/cms_functions.php');

use PHPUnit\Framework\TestCase;
class functions extends TestCase
{
    public function test_getProjectDataFromPOST_success_length() {
        $array['name'] = 'Example Project';
        $array['type'] = 'Game/Website/Application';
        $array['desc'] = 'This a semi lengthy description of the project, taking up around 300-400 characters. Lorem ipsum galo sengen';
        $array['img'] = 'thisisanimage';
        $array['link'] = 'https://github.com/hoptond';
        $this->assertEquals(5, count($array));
    }

}