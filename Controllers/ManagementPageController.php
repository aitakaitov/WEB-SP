<?php

// Variables file
require_once("settings.php");
// Controller interface file
require_once("IController.php");
// Page keys function
require_once("FunctionsMenuPages.php");

/**
 * Class ManagementPageController
 * Loads users from database and calls view
 */
class ManagementPageController implements IController
{
    // Database
    private $db;

    // Login manager
    private $login;

    /**
     * MainPageController constructor.
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

        $templateData['currentPageKey'] = "management";
        $templateData['title'] = $title;

        $pages = array();
        $pages = array_merge($pages, getPageKeys("all"));    // Get pages for everyone                                     // -------------------- MANAGE MENU PAGES BASED ON LOGIN AND PRIVILEGES --------------
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
        $templateData['users'] = $this -> db -> getAllUsers();                                                                      // ----------------------- GET THE USERS --------------------------------

        $templateData['articles'] = $this -> db -> getAllArticles(0);                                                      // ----------------------- GET UNAPPROVED ARTICLES ---------------

        // Start the output buffer
        ob_start();

        // Get the template HTML
        require_once(VIEWS_DIR."/ManagementPageView.php");

        // Get output buffer contents and clean buffer
        $pageContents = ob_get_clean();

        // return page contents
        return $pageContents;
    }
}