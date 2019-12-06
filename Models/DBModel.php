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
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_ARTICLES." WHERE (approved = ?) ORDER BY id_article DESC");
        $stmt -> execute([$approved]);
        return $stmt -> fetchAll();
    }

    /**
     * Check whether user with same nickname exists and if not, adds user to database. If yes, returns false
     * @param $userInfo Login informace
     * @return false if unsuccessful
     */
    public function addUser($userInfo)
    {
        // Check if same username exists
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_USERS." WHERE (nick = ?");
        $stmt -> execute([$userInfo['nickname']]);

        $result = $stmt -> fetchAll();

        if (count($result) >= 1)
        {
            return false;
        }

        // If empty, add user
        $stmt = $this -> pdo -> prepare("INSERT INTO ".TABLE_USERS." VALUES (:null, :nick, :name, :surname, :email, :pass, :privilege, :active)");
        $stmt -> bindValue(":null", NULL);
        $stmt -> bindValue(":nick", $userInfo['nickname']);
        $stmt -> bindValue(":name", $userInfo['name']);
        $stmt -> bindValue(":surname", $userInfo['surname']);
        $stmt -> bindValue(":email", $userInfo['email']);
        $stmt -> bindValue(":pass", $userInfo['password']);
        $stmt -> bindValue(":privilege", "user");
        $stmt -> bindValue(":active", 1);
        $stmt -> execute();
        return true;
    }

    /**
     * Return privilege for user name
     * @param $userName user name
     * @return mixed privilege
     */
    public function getUserPrivileges($userName)
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_USERS." WHERE nick = ?");
        $stmt -> execute([$userName]);
        $result = $stmt -> fetchAll();
        $result = $result[0];

        return $result['privilege'];
    }

    /**
     * Fetches all users from database
     * @return array users
     */
    public function getAllUsers()
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_USERS." WHERE privilege != ? AND active = ? ORDER BY nick ASC");
        $stmt -> execute(["admin", 1]);
        $result = $stmt -> fetchAll();

        return $result;
    }

    /**
     * Deletes user
     * @param $userID
     */
    public function deleteUser($userID)
    {
        $stmt = $this -> pdo -> prepare("UPDATE ".TABLE_USERS." SET active = ? WHERE id_user = ?");
        $stmt -> execute([0, $userID]);
    }

    /**
     * Returns article with specific ID
     * If no such article exists, returns NULL
     * @param $articleID int id of article
     * @return array or null
     */
    public function getArticleByID($articleID)
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_ARTICLES." WHERE id_article = ?");
        $stmt -> execute([$articleID]);
        $result = $stmt -> fetchAll();

        if (count($result) == 0)
        {
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

        $stmt = $this -> pdo -> prepare("SELECT * FROM reviews WHERE ((id_review = ?) or (id_review = ?) or (id_review = ?))");
        $stmt -> execute([$result['review1'], $result['review2'], $result['review2']]);
        $result = $stmt -> fetchAll();

        return $result;
    }

    /**
     * Returns user data
     * @param $userID user id
     * @return array
     */
    public function getUserByID($userID)
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_USERS." WHERE (id_user = ?)");
        $stmt -> execute([$userID]);
        $result = $stmt -> fetchAll();

        return $result;
    }

    /**
     * Returns user info for a nickname
     * Users have unique nicknames
     * @param $nick
     * @return array
     */
    public function getUserByNick($nick)
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_USERS." WHERE nick = ?");
        $stmt -> execute([$nick]);
        $result = $stmt -> fetchAll();

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
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_USERS." WHERE nick = ? AND password = ? AND active = ?");
        $stmt -> execute([$nick, $password, 1]);
        $result = $stmt -> fetchAll();

        if (count($result) == 0) // If no such user exists
        {
            return false;
        } else
            {
                return true;
            }
    }

    /**
     * Returns all articles that have not been approved yet and one of the reviewers is the user with $userID and none of the reviews are from the user
     * @param $userID user id
     * @return array articles to review
     */
    public function getArticlesToReview($userID)
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM ".TABLE_ARTICLES." WHERE (approved = ?) AND (reviewer1 = ? OR reviewer2 = ? OR reviewer3 = ?)");
        $stmt -> execute([0, $userID, $userID, $userID]);
        $result = $stmt -> fetchAll();

        $invalid = array();
        foreach ($result as $article)
        {
            if ($article['review1'] != null && $article['reviewer1'] == $userID)
            {
                array_push($invalid, $article);
            }
            if ($article['review2'] != null && $article['reviewer2'] == $userID)
            {
                array_push($invalid, $article);
            }
            if ($article['review3'] != null && $article['reviewer3'] == $userID)
            {
                array_push($invalid, $article);
            }
        }

        return array_diff($result, $invalid);
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
        $stmt = $this -> pdo -> prepare("UPDATE ".TABLE_ARTICLES." SET reviewer1 = ?, reviewer2 = ?, reviewer3 = ? WHERE id_article = ?");
        $stmt -> execute([$reviewer1, $reviewer2, $reviewer3, $articleID]);
    }

    /**
     * Adds article into the database. Article is not approved by default
     * @param $article_text
     * @param $user
     * @param $images
     * @param $title
     * @param headerImage
     */
    public function addArticle($article_text, $user, $images, $title, $headerImage)
    {
        //$stmt = $this -> pdo -> prepare("INSERT INTO ".TABLE_ARTICLES." VALUES (NULL, 0, \"".$article_text."\", \"".$title."\", \"".$images."\", \"".$user."\", NULL, NULL, NULL, \"".$headerImage."\", NULL, NULL, NULL)")
        $query = "INSERT INTO ".TABLE_ARTICLES." VALUES (NULL, 0, \"".$article_text."\", \"".$title."\", \"".$images."\", \"".$user."\", NULL, NULL, NULL, \"".$headerImage."\", NULL, NULL, NULL)";
        $this -> pdo -> query($query);
    }

    /**
     * Returns -1 of not and 1/2/3 depending on which reviewer user is
     * @param $userID int user id
     * @param $articleID int article id
     * @return int see function description
     */
    public function canUserReviewArticle($userID, $articleID)
    {
        $query = "SELECT * FROM ".TABLE_ARTICLES." WHERE id_article = ".$articleID;
        $result = $this -> pdo -> query($query) -> fetchAll();

        $result = $result[0];

        if ($result['reviewer1'] == $userID)
        {
            return 1;
        }
        else if ($result['reviewer2'] == $userID)
        {
            return 2;
        }
        else if ($result['reviewer3'] == $userID)
        {
            return 3;
        }
        else
            {
                return -1;
            }
    }

    /**
     * Handles creating a new review and adding it to an article
     * @param $userID int id user
     * @param $reviewText string review text
     * @param $articleID int id article
     * @param $reviewerNumber int 1/2/3 - what review this one should be
     * @param $score int article score
     */
    public function addReviewToArticle($userID, $reviewText, $articleID, $reviewerNumber, $score)
    {
        $query = "INSERT INTO ".TABLE_REVIEWS." VALUES (NULL, \"".$userID."\", ".$score.", \"".$reviewText."\")";
        $this -> pdo -> query($query);

        $query = "SELECT id_review FROM ".TABLE_REVIEWS." ORDER BY id_review DESC LIMIT 1";     // Workaround solution, had problems adding identity to the table. SCOPE_INDENTITY() would be the proper solution
        $reviewID = $this -> pdo -> query($query) -> fetchAll()[0];

        $query = "UPDATE ".TABLE_ARTICLES." SET review".$reviewerNumber." = ".$reviewID." WHERE id_article = ".$articleID;
        $this -> pdo -> query($query);
    }

}