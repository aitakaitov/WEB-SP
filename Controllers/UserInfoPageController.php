<?php

require_once("settings.php");
require_once("FunctionsMenuPages.php");
require_once("IController.php");

/**
 * Class UserInfoPageController
 */
class UserInfoPageController implements IController
{
    // Database
    private $db;

    // Login manager
    private $login;

    /**
     * UserInfoPageController constructor.
     * Creates database access
     */
    public function __construct()
    {
        // Database model file
        require_once(MODELS_DIR."/DBModel.php");
        // Login manager file
        require_once(SESS_DIR."/WebLogin.php");
        // Init db
        $this -> db = new DBModel();
        // Init login
        $this -> login = new WebLogin();
    }

    public function show($title):string
    {
        global $templateData;

        $templateData = [];

        $templateData['currentPageKey'] = "userinfo";
        $templateData['title'] = $title;

        $pages = array();
        $pages = array_merge($pages, getPageKeys("all"));    // Get pages for everyone                                     // -------------------- MANAGE MENU PAGES BASED ON LOGIN AND PRIVILEGES --------------
        // add pages for unlogged users
        if (!$this -> login -> isUserLogged())
        {
            $pages = array_merge($pages, getPageKeys("unlogged"));
            $templateData['userInfo'] = null;      // get user info
        }
        else    // for logged users
        {
            $pages = array_merge($pages, getPageKeys("logged"));

            // get user info
            $templateData['userInfo'] = $this -> db -> getUserByID($this -> login -> getUserInfo()['id']);
            $templateData['userInfo'] = $templateData['userInfo'][0];

            if ($this -> login -> getUserPrivileges() == "admin")
            {
                $pages = array_merge($pages, getPageKeys("admin"));
            }
        }

        $templateData['pages'] = $pages;

        // Start the output buffer
        ob_start();

        // Get the template HTML
        require_once(VIEWS_DIR."/UserInfoPageView.php");

        // Get output buffer contents and clean buffer
        $pageContents = ob_get_clean();

        // return page contents
        return $pageContents;
    }

}