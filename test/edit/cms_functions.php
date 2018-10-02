<?php
require('../../edit/cms_functions.php');

use PHPUnit\Framework\TestCase;
class functions extends TestCase
{
    public function test_getProjectDataFromPOST_success_length() {
        $array['title'] = 'Example Project';
        $array['type'] = 'Game/Website/Application';
        $array['desc'] = 'This a semi lengthy description of the project, taking up around 300-400 characters. Lorem ipsum galo sengen';
        $array['img'] = 'thisisanimage';
        $array['link'] = 'https://github.com/hoptond';
        $test = getProjectDataFromPOST($array);
        $this->assertEquals(5, count($test));
    }

    public function test_getProjectDataFromPOST_failure_length() {
        $array['title'] = 'Example Project';
        $array['type'] = 'Game/Website/Application';
        $array['desc'] = 'This a semi lengthy description of the project, taking up around 300-400 characters. Lorem ipsum galo sengen';
        $array['link'] = 'https://github.com/hoptond';
        $test = getProjectDataFromPOST($array);
        $this->assertEquals(5, count($test));
    }

    public function test_getProjectDataFromPOST_malform_input() {
        $test = getProjectDataFromPOST(4);
        foreach ($test as $entry) {
            $this->assertNull($entry);
        }
    }

    public function test_validateSingleTableRequest_success() {
        $tableA = 'badges';
        $tableB = 'icons';
        $this->assertEquals(validateListTableRequest($tableA), TRUE);
        $this->assertEquals(validateListTableRequest($tableB), TRUE);
    }



}