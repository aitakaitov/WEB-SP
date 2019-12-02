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
     * Returns all approved or not approved articles
     * @return array Articles
     * @param int approved 0 = not 1 = yes
     */
    public function getAllArticles($approved):array
    {
        $query = "SELECT * FROM ".TABLE_ARTICLES." WHERE (approved = ".$approved.") ORDER BY id_article DESC";
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
        $query = "SELECT * FROM ".TABLE_USERS." WHERE (nick = \"".$userInfo['nickname']."\")";

        $result = $this -> pdo -> query($query) -> fetchAll();

        if (count($result) >= 1)
        {
            return false;
        }

        // If empty, add user
        $query = "INSERT INTO ".TABLE_USERS." VALUES (NULL, \"".$userInfo['nickname']."\", \"".$userInfo['name']."\", \"".$userInfo['surname']."\", \"".$userInfo['email']."\", \"".$userInfo['password']."\", "."\"user\", 1)";
        echo $query;
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
        $query = "SELECT * FROM ".TABLE_USERS." WHERE nick = \"".$userName."\"";
        $result = $this -> pdo -> query($query) -> fetchAll();
        $result = $result[0];

        return $result['privilege'];
    }

    /**
     * Fetches all users from database
     * @return array users
     */
    public function getAllUsers()
    {
        $query = "SELECT * FROM ".TABLE_USERS." WHERE privilege != \"admin\" AND active = 1 ORDER BY nick ASC";
        $result = $this -> pdo -> query($query) -> fetchAll();

        return $result;
    }

    /**
     * Deletes user
     * @param $userID
     */
    public function deleteUser($userID)
    {
        $query = "UPDATE ".TABLE_USERS." SET active = 0 WHERE id_user = ".$userID;
        echo $query;
        $this -> pdo -> query($query);
    }

    /**
     * Returns article with specific ID
     * If no such article exists, returns NULL
     * @param $articleID id of article
     * @return array or null
     */
    public function getArticleByID($articleID)
    {
        $query = "SELECT * FROM ".TABLE_ARTICLES." WHERE (id_article = ".$articleID.")";
        $result = $this -> pdo -> query($query) -> fetchAll();

        if (count($result) == 0)
        {
            echo "NULL";
            return null;
        }

        return $result;
    }

    /**
     * Returns all reviews for an article
     * @param $articleID id of article
     * @return array reviews
     */
    public function getArticleReviews($articleID)
    {
        $result = $this -> getArticleByID($articleID);
        $result = $result[0];

        $query = "SELECT * FROM reviews WHERE ((id_review = ".$result['review1'].") or (id_review = ".$result['review2'].") or (id_review = ".$result['review3']."))";
        $result = $this -> pdo -> query($query) -> fetchAll();

        return $result;
    }

    /**
     * Returns user data
     * @param $userID user id
     * @return array
     */
    public function getUserByID($userID)
    {
        $query = "SELECT * FROM ".TABLE_USERS." WHERE (id_user = ".$userID.")";
        $result = $this -> pdo -> query($query) -> fetchAll();

        return $result;
    }

    /**
     * Check if user exists in database
     * @param $nick nickname
     * @param $password password
     * @return bool user exists
     */
    public function userLoginCheck($nick, $password)
    {
        $query = "SELECT * FROM ".TABLE_USERS." WHERE nick = \"".$nick."\" AND password = \"".$password."\" AND active = 1";
        $result = $this -> pdo -> query($query) -> fetchAll();

        if (count($result) == 0) // If no such user exists
        {
            return false;
        } else
            {
                return true;
            }
    }

    /**
     * Sets all three reviewers for an article
     * @param $reviewer1
     * @param $reviewer2
     * @param $reviewer3
     * @param $articleID
     */
    public function setArticleReviewers($reviewer1, $reviewer2, $reviewer3, $articleID)
    {
        $query = "UPDATE ".TABLE_ARTICLES." SET reviewer1 = ".$reviewer1.", reviewer2 = ".$reviewer2.", reviewer3 = ".$reviewer3." WHERE id_article = ".$articleID;
        $this -> pdo -> query($query);
    }

    public function addArticle($article_text, $user, $images, $title)
    {

    }

}