<?php

/**
 * Class WebLogin
 * Manages user login
 */
class WebLogin
{
    // Session
    private $session;

    // Name key
    private $name = "name";

    // Date key
    private $date = "date";

    // Database access
    private $db;

    /**
     * WebLogin constructor.
     * Creates session
     */
    public function __construct()
    {
        include_once(SESS_DIR."/WebSession.php");
        $this -> session = new WebSession();
        include_once(MODELS_DIR."/DBModel.php");
        $this -> db = new DBModel();
    }

    /**
     * Checks whether user is logged in or not
     * @return bool Is user logged?
     */
    public function isUserLogged()
    {
        return $this -> session -> isSessionSet($this -> name);
    }

    /**
     * Login user
     * @param $nick nickname
     * @param $password user password
     * @return bool login successful
     */
    public function login($nick, $password)
    {
        if ($this -> db ->userLoginCheck($nick, $password))
        {
            $this -> session -> addSession($this -> $name, $nick);
            $this -> session -> addSession($this -> $date, date("d. M. Y., G:m:s"));

            return true;
        } else
            {
                return false;
            }
    }

    /**
     * Log out user
     */
    public function logout()
    {
        $this -> session -> removeSession($this -> date);
        $this -> session -> removeSession($this -> date);
    }

    /**
     * Returns user info
     * @return array user info
     */
    public function getUserInfo()
    {
        $info = [];
        $info['nick'] = $this -> session -> getSession($this -> name);
        $info['login_date'] = $this -> session -> getSession($this -> date);

        return $info;
    }

}