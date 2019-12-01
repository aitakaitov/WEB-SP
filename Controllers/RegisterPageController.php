<?php

// Variables
require_once("settings.php");
// Controller interface
require_once(CONTROLLERS_DIR."/IController.php");
// Menu pages
require_once("FunctionsMenuPages.php");

/**
 * Class RegisterPageController
 */
class RegisterPageController
{
    private $login;

    /**
     * RegisterPageController constructor.
     * Initializes the login manager
     */
    public function __construct()
    {
        require_once(SESS_DIR."/WebLogin.php");
        $this -> login = new WebLogin();
    }

    /**
     * Creates template data and calls for the view to be shown
     * @param $title pagetitle
     * @return false|string output from OB
     */
    public function show($title)
    {
        global $templateData;

        $templateData['title'] = $title;
        $templateData['currentPageKey'] = "register";

        // -------- Pages to be shown in menu -------- //
        $pages = array();
        $pages = array_merge($pages, getPageKeys("all"));    // Get pages for everyone
        // add pages for unlogged users
        if (!$this -> login -> isUserLogged())
        {
            $pages = array_merge($pages, getPageKeys("unlogged"));
        }
        else    // for logged users
        {
            $pages = array_merge($pages, getPageKeys("logged"));

            if ($this -> login -> getUserPrivileges() == "admin")
            {
                $pages = array_merge($pages, getPageKeys("admin"));
            }
        }

        $templateData['pages'] = $pages;

        ob_start();

        require(VIEWS_DIR."/RegisterPageView.php");

        $output = ob_get_clean();

        return $output;
    }
}