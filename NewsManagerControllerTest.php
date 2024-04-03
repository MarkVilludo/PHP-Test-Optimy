<?php

use PHPUnit\Framework\TestCase;

define('ROOT', __DIR__); // define directory path
//include class
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/utils/CommentManager.php');
require_once(ROOT . '/class/News.php');
require_once(ROOT . '/class/Comment.php');
require_once(ROOT . '/index.php');

class NewsManagerControllerTest extends TestCase
{
    public function testDisplayNewsWithComments()
    {
        // Set up the expected output
        $expectedOutput = "############ NEWS news 1 ############\n";
        $expectedOutput .= "this is the description of our fist news\n";
        $expectedOutput .= "Comment 1 : i like this news\n";
        $expectedOutput .= "Comment 2 : i have no opinion about that\n";
        $expectedOutput .= "Comment 3 : are you kidding me ?\n";
        $expectedOutput .= "############ NEWS news 2 ############\n";
        $expectedOutput .= "Comment 4 : this is so true\n";
        $expectedOutput .= "Comment 4 : trolololo\n";
        $expectedOutput .= "############ NEWS news 3 ############\n";
        $expectedOutput .= "Comment 3 : luke i am your father\n";

        // Capture output from displayNewsWithComments() method
        ob_start();
        $newsManagerController = new NewsManagerController();
        $newsManagerController->displayNewsWithComments();
        $actualOutput = ob_get_clean();

        //expected string in return

        // Assert that the actual output matches the expected output
        $this->assertStringContainsString("############ NEWS news 1 ############", $actualOutput);
        $this->assertStringContainsString("############ NEWS news 2 ############", $actualOutput);

        //assume to have this string in db
        $this->assertStringContainsString("this is so false", $actualOutput);
    }
}