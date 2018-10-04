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

    public function test_getProjectDataFromPOST_error_length() {
        $array['title'] = 'Example Project';
        $array['type'] = 'Game/Website/Application';
        $array['desc'] = 'This a semi lengthy description of the project, taking up around 300-400 characters. Lorem ipsum galo sengen';
        $array['link'] = 'https://github.com/hoptond';
        $test = getProjectDataFromPOST($array);
        $empty = 0;
        foreach ($test as $entry) {
            if (empty($entry)) {
                $empty++;
            }
        }
        $this->assertEquals($empty, 1);
    }

    public function test_getProjectDataFromPOST_malform_input() {
        $test = getProjectDataFromPOST(4);
        foreach ($test as $entry) {
            $this->assertEmpty($entry);
        }
    }

    public function test_getContactInfoFromPOST_success_length() {
        $array['icon_id'] = '2';
        $array['link'] = 'wikipedia.org';
        $array['text'] = 'This is some anchor text';
        $test = getContactInfoFromPOST($array);
        $this->assertEquals(3, count($test));
    }

    public function test_getContactInfoFromPOST_error_length()
    {
        $array['icon_id'] = '2';
        $array['link'] = 'wikipedia.org';
        $test = getContactInfoFromPOST($array);
        $empty = 0;
        foreach ($test as $entry) {
            if (empty($entry)) {
                $empty++;
            }
        }
        $this->assertEquals($empty, 1);
    }

    public function test_getContactInfoFromPOST_malform_input() {
        $test = getContactInfoFromPOST(4);
        foreach ($test as $entry) {
            $this->assertEmpty($entry);
        }
    }


    public function test_validateSingleTableRequest_success() {
        $tableA = 'badges';
        $tableB = 'icons';
        $this->assertEquals(validateSingleTableRequest($tableA), TRUE);
        $this->assertEquals(validateSingleTableRequest($tableB), TRUE);
    }

    public function test_validateSingleTableRequest_error() {
        $tableA = 'about';
        $tableB = 'contact';
        $tableC = 'projects';
        $this->assertEquals(validateSingleTableRequest($tableA), FALSE);
        $this->assertEquals(validateSingleTableRequest($tableB), FALSE);
        $this->assertEquals(validateSingleTableRequest($tableC), FALSE);
    }

    public function test_validateSingleTableRequest_malform() {
        $tableA = 8;
        $this->assertEquals(validateSingleTableRequest($tableA), FALSE);
    }

    public function test_validateListTableRequest_success() {
        $tableA = 'projects';
        $this->assertEquals(validateListTableRequest($tableA), TRUE);
    }

    public function test_validateListTableRequest_error() {
        $tableA = 'about';
        $this->assertEquals(validateListTableRequest($tableA), FALSE);
    }

    public function test_validateListTableRequest_malform() {
        $tableA = 6.53;
        $this->assertEquals(validateListTableRequest($tableA), FALSE);
    }

    public function test_listTextColor_success_match() {
        $id = 1;
        $test = listTextColor($id, 1);
        $this->assertEquals($test, ' class="highlight"');
    }

    public function test_listTextColor_success_nomatch() {
        $id = 8;
        $test = listTextColor($id, 1);
        $this->assertEquals($test, '');
    }

    public function test_listTextColor_malform() {
        $this->expectException(TypeError::class);
        $id = 'gorilla';
        $test = listTextColor($id, 1);
    }

    public function test_processMessage_success() {
        $msg = processMessage(4);
        $this->assertEquals($msg, 'Project added successfully!');
    }

    public function test_processMessage_error() {
        $msg = processMessage(27);
        $this->assertEquals($msg, '');
    }

    public function test_processMessage_malform() {
        $this->expectException(TypeError::class);
        $msg = processMessage('octopus');
    }

    public function test_getEditEntryID_success() {
        $get['id'] = 4;
        $get['edit'] ='';
        $id = getEditEntryID($get);
        $this->assertEquals($id, 4);
    }

    public function test_getEditEntryID_error_noedit() {
        $get['id'] = 4;
        $id = getEditEntryID($get);
        $this->assertEquals($id, -1);
    }

    public function test_getEditEntryID_error_noid() {
        $get['edit'] ='';
        $id = getEditEntryID($get);
        $this->assertEquals($id, -1);
    }

    public function test_getEditEntryID_malform() {
        $get['edit'] ='';
        $get['id'] = 'france';
        $id = getEditEntryID($get);
        $this->assertEquals($id, 0);
    }

    public function test_anyFieldEmpty_success_true(){
        $array['name'] = 'Steve';
        $array['age'] = '32';
        $array['gender'] = '';
        $result = anyFieldEmpty($array);
        $this->assertEquals($result, TRUE);
    }

    public function test_anyFieldEmpty_success_false(){
        $array['name'] = 'Steve';
        $array['age'] = '32';
        $array['gender'] = 'male';
        $result = anyFieldEmpty($array);
        $this->assertEquals($result, FALSE);
    }

    public function test_anyFieldEmpty_malform(){
        $this->expectException(TypeError::class);
        $array = 7.5;
        anyFieldEmpty($array);
    }

    public function test_getListHolderEntry_success_highlight() {
        $entry = getListHolderEntry(1,1, 'doeproject.php', 'MAGICIANS');
        $this->assertContains('class="highlight', $entry);
    }

    public function test_getListHolderEntry_success_nohighlight() {
        $entry = getListHolderEntry(1,5, 'doeproject.php', 'MAGICIANS');
        $this->assertNotContains('class="highlight', $entry);
    }

    public function test_getActionLocation_success() {
        $table = getActionLocation('projects');
        $this->assertEquals($table, 'doeproject.php');
    }

    public function test_getActionLocation_error() {
        $table = getActionLocation('about');
        $this->assertEquals($table, 'dash.php');
    }

    public function test_getActionLocation_malform() {
        $table = getActionLocation(4.8);
        $this->assertEquals($table, 'dash.php');
    }


}