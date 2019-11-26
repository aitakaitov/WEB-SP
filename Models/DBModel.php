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
    public function getAllApprovedArticles():array
    {
        $query = "SELECT * FROM ".TABLE_ARTICLES." WHERE (approved = 1) ORDER BY id_article DESC";
        return $this -> pdo -> query($query) -> fetchAll();
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

        // If empty, add user
        $query = "INSERT INTO ".TABLE_USERS." VALUES (".$userInfo['nickname'].", ".$userInfo['name'].", ".$userInfo['surname'].", ".$userInfo['email'].", ".$userInfo['password'].", "."0}";
        $this -> pdo -> query($query);
        return true;
    }

    /**
     * Return privilege for user name
     * @param $userName user name
     * @return mixed privilege
     */
    public function getUserPrivileges($userName)
    {
        $query = "SELECT * FROM ".TABLE_USERS." WHERE nick = ".$userName;
        $result = $this -> pdo -> query($query) -> fetchAll();

        return $result['privilege'];
    }

    /**
     * Check if user exists in database
     * @param $nick nickname
     * @param $password password
     * @return bool user exists
     */
    public function userLoginCheck($nick, $password)
    {
        $query = "SELECT * FROM ".TABLE_USERS." WHERE nick = ".$nick." AND password = ".$password;
        $result = $this -> pdo -> query($query) -> fetchAll();

        if ($result -> rowCount() == 0) // If no such user exists
        {
            return false;
        } else
            {
                return true;
            }
    }

}