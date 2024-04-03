<?php

class NewsManager
{
    private static $instance = null;

    private function __construct()
    {
        require_once(ROOT . '/utils/DB.php');
        require_once(ROOT . '/utils/CommentManager.php');
        require_once(ROOT . '/class/News.php');
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
     * List all news.
     * @return array Array of News objects.
     */
	public function listNews()
	{
		$db = DB::getInstance();
		$rows = $db->select('SELECT * FROM `news`'); // Query to fetch all news
		$news = [];
		foreach ($rows as $row) {
			// Create a new News object and initialize it with data from the database
			$newsItem = new News();
			$newsItem->setId($row['id'])
					->setTitle($row['title'])
					->setBody($row['body'])
					->setCreatedAt($row['created_at']);
			// Add the News object to the array
			$news[] = $newsItem;
		}

		return $news;
	}

    /**
	 * Define datatypes for params and return data
     * new record for news table, make descrption each params
     * @param string $title Title for the news.
     * @param string $body Body for the news.
     * @return int|bool define return last 
     */
    public function addNews($title, $body)
    {
        $db = DB::getInstance();
        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`)
                VALUES(?, ?, ?)";
        $parameters = array($title, $body, date('Y-m-d'));
        $success = $db->execPrepared($sql, $parameters); // Assuming execPrepared handles prepared statements

        if ($success) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    }

    /**
	 * Define datatypes for params and return data
     * Deletes a news item and its associated comments.
     * @param int $id to be deleted news ID
     * @return int|bool Number of affected rows or false on failure.
     */
    public function deleteNews($id)
    {
        // Fetch only comments associated with the news item being deleted
        $comments = CommentManager::getInstance()->listCommentsByNewsId($id); // Assuming such a method exists
        $idsToDelete = [];
        foreach ($comments as $comment) {
            $idsToDelete[] = $comment->getId();
        }
        // Delete associated comments
        CommentManager::getInstance()->deleteMultipleComments($idsToDelete);

        $db = DB::getInstance();
        $sql = "DELETE FROM `news` WHERE `id`=?";
        $parameters = array($id);
        $affectedRows = $db->execPrepared($sql, $parameters);

        return $affectedRows;
    }
}
