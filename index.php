<?php

define('ROOT', __DIR__); // define directory path
//include class
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/utils/CommentManager.php');

class NewsManagerController
{
    public function displayNewsWithComments()
    {
        // Get all news and comments
        $newsList = NewsManager::getInstance()->listNews();
        $allComments = CommentManager::getInstance()->listComments();
        $commentsByNewsId = []; // Create an associative array to store comments by news ID

        // Group comments by news ID
        // I used this way, to avoid nested loops
        // while still optimizing the retrieval of comments related to each news item
        foreach ($allComments as $comment) {
            $newsId = $comment->getNewsId();
            $commentsByNewsId[$newsId][] = $comment;
        }

        // Loop through each news item
        foreach ($newsList as $news) {
            echo("############ NEWS " . $news->getTitle() . " ############\n"); // Display news title
            echo($news->getBody() . "\n"); // Display news body

            // Check if there are comments associated with the current news item
            if (isset($commentsByNewsId[$news->getId()])) {
                // Retrieve comments associated with the current news item
                // Output each comment related to the current news item
                foreach ($commentsByNewsId[$news->getId()] as $comment) {
                    echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n"); // Display comment
                }
            } else {
                echo("No comments for this news.\n");
            }
        }
    }
}

// Instantiate the controller and call the method
$newsManagerController = new NewsManagerController();
$newsManagerController->displayNewsWithComments();

//comment out this, because it is unused or intended for future use?
// $commentManager = CommentManager::getInstance(); // Get instance of CommentManager
// $c = $commentManager->listComments(); // Retrieve all comments  //
