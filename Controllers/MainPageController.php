<?php

// Variables file
require_once("settings.php");
// Controller interface file
require_once("IController.php");
// Page keys function
require_once("FunctionsMenuPages.php");

/**
 * Class MainPageController
 * Controller for main page
 * Loads data for template to database
 */
class MainPageController implements IController
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

        $templateData['articles'] = $this -> db ->getAllArticles(1);
        $templateData['currentPageKey'] = "mainpage";
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

        // Start the output buffer
        ob_start();

        // Get the template HTML
        require_once(VIEWS_DIR."/MainPageView.php");

        // Get output buffer contents and clean buffer
        $pageContents = ob_get_clean();

        // return page contents
        return $pageContents;
    }
}