<?php


/**
 * Class DBModel
 */
class DBModel
{
    /**
     * @var PDO  Database access
     */
    private $pdo;

    /**
     * DBModel constructor.
     */
    public function __construct()
    {
        // init db
        $this -> pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
        // force utf-8
        $this -> pdo -> exec("set names utf8");
    }

    /**
     * Returns all approved articles
     * @return array Articles
     */
    public function getAllArticles():array
    {
        $query = "SELECT * FROM ".TABLE_ARTICLES." WHERE (approved = 1) ORDER BY id_article DESC";
        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * Check whether user with same nickname exists and if not, adds user to database. If yes, returns false
     * @param $userInfo Login informace
     * @return false if unsuccessful
     */
    public function addUser($userInfo)
    {
        // Check if same username exists
        $query = "SELECT TOP 1 nick FROM ".TABLE_USERS." WHERE nick = ".$userInfo['nickname'];
        $result = $this -> pdo -> query($query) -> fetchAll();

        if ($result -> rowCount() == 1)
        {
            return false;
        }

        // If empty
        $query = "INSERT INTO ".TABLE_USERS." VALUES (".$userInfo['nickname'].", ".$userInfo['name'].", ".$userInfo['surname'].", ".$userInfo['email'].", ".$userInfo['password'].", "."0}";
         return true;
    }

}