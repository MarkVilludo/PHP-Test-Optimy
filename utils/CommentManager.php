<?php

class CommentManager
{
    private static $instance = null;

    private function __construct()
    {
        require_once(ROOT . '/utils/DB.php'); // Include DB utility class
        require_once(ROOT . '/class/Comment.php'); // Include Comment class
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    /**
     * Retrieves all comments from the database.
     * @return array Array of Comment objects.
     */
    public function listComments()
    {
        $db = DB::getInstance(); // Get database instance
        $rows = $db->select('SELECT * FROM `comment`'); // Fetch all comments from the database

        $comments = [];
        foreach ($rows as $row) {
            $n = new Comment(); // Create new Comment object
            // Set properties of Comment object
            $comments[] = $n->setId($row['id'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at'])
                ->setNewsId($row['news_id']);
        }

        return $comments; // Return array of Comment objects
    }

    /**
     * Adds a comment for a specific news item.
     * @param string $body The body of the comment.
     * @param int $newsId The ID of the news item the comment is for.
     * @return int The ID of the inserted comment.
     */
    public function addCommentForNews($body, $newsId)
    {
        $db = DB::getInstance(); // Get database instance
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('". $body . "','" . date('Y-m-d') . "','" . $newsId . "')"; // SQL query to insert a comment
        $db->exec($sql); // Execute the SQL query
        return $db->lastInsertId($sql); // Return the ID of the inserted comment
    }

    /**
     * Deletes a comment by its ID.
     * @param int $id The ID of the comment to delete.
     * @return int The number of affected rows.
     */
    public function deleteComment($id)
    {
        $db = DB::getInstance(); // Get database instance
        $sql = "DELETE FROM `comment` WHERE `id`=" . $id; // SQL query to delete a comment by ID
        return $db->exec($sql); // Execute the SQL query and return the number of affected rows
    }

    /**
     * Delete multiple comments by their IDs.
     * @param array $ids An array of comment IDs to delete.
     * @return int The number of affected rows.
     */
    public function deleteMultipleComments($ids)
    {
        $db = DB::getInstance();
        $placeholders = rtrim(str_repeat('?,', count($ids)), ','); // placeholders for prepared statement
        $sql = "DELETE FROM `comment` WHERE `id` IN ($placeholders)"; // SQL query to delete multiple comments by IDs
        return $db->exec($sql, $ids); // Execute the SQL query with prepared statement and return the number of affected rows
    }
}
