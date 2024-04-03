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