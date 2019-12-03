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
    private $date = "time";

    // Privileges key
    private $privileges = "privileges";

    // ID key
    private $id = "id";

    // Database access
    private $db;

    /**
     * WebLogin constructor.
     * Creates session
     */
    public function __construct()
    {
        include_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebSession.php");
        $this -> session = new WebSession();
        include_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
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
     * Returns user privileges
     * @return mixed|null
     */
    public function getUserPrivileges()
    {
        return $this -> session -> getSession($this -> privileges);
    }

    /**
     * Login user
     * Add session with user name, login time and privileges and ID
     * @param $nick string nickname
     * @param $password string user password
     * @return bool login successful
     */
    public function login($nick, $password)
    {
        if ($this -> db ->userLoginCheck($nick, $password))
        {
            $this -> session -> addSession($this -> name, $nick);
            $this -> session -> addSession($this -> date, time());

            $userInfo = $this -> db -> getUserByNick($nick);
            $userInfo = $userInfo[0];

            $this -> session -> addSession($this -> privileges, $userInfo['privilege']);
            $this -> session -> addSession($this -> id, $userInfo['id_user']);

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
        session_unset();
        session_destroy();
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
        $info['id'] = $this -> session -> getSession($this -> id);

        return $info;
    }

}