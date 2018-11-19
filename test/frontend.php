<?php
require('../frontend.php');
use PHPUnit\Framework\TestCase;
class functions extends TestCase
{
    private $array;

    function SetUp()
    {
        $this->array[0]['title'] = 'Project 1';
        $this->array[0]['type'] = 'Project 1 type';
        $this->array[0]['desc'] = 'Project 1 description';
        $this->array[0]['image'] = 'https://imagesite.com/project1image.jpg';
        $this->array[0]['link'] = 'https://github.com/project1';
        $this->array[1]['title'] = 'Project 2';
        $this->array[1]['type'] = 'Project 2 type';
        $this->array[1]['desc'] = 'Project 2 description';
        $this->array[1]['image'] = 'https://imagesite.com/project2image.jpg';
        $this->array[1]['link'] = 'https://github.com/project2';
    }

    function test_getProjectTexts_success() {
        $output = getProjectTexts($this->array);
        $this->assertContains('>Project 1<', $output);
        $this->assertContains('>Project 1 type<', $output);
        $this->assertContains('>Project 1 description<', $output);

        $this->assertContains('>Project 2<', $output);
        $this->assertContains('>Project 2<', $output);
        $this->assertContains('>Project 2 type<', $output);
        $this->assertContains('>Project 2 description<', $output);
    }

    function test_getProjectTexts_error() {
        $this->expectException(TypeError::class);
        $output = getProjectTexts(74);
    }

    function test_getProjectImages_success() {
        $output = getProjectImages($this->array);
        $this->assertContains('src="https://imagesite.com/project1image.jpg"', $output);
        $this->assertContains('src="https://imagesite.com/project2image.jpg', $output);
    }

    function test_getProjectsImages_error() {
        $this->expectException(TypeError::class);
        $output = getProjectImages(7);
    }

    function test_getProjectLinks_success() {
        $output = getProjectLinks($this->array);
        $this->assertContains('href="https://github.com/project1"', $output);
        $this->assertContains('href="https://github.com/project2"', $output);
    }

    function test_getProjectLinks_error() {
        $this->expectException(TypeError::class);
        $output = getProjectLinks(9);
    }
}
?>