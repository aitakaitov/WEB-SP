<?php

require_once("IController.php");
require_once("settings.php");
require_once("FunctionsMenuPages.php");

/**
 * Class ReviewsPageController
 */
class ReviewsPageController implements IController
{
    // database access
    private $db;
    // login manager
    private $login;

    /**
     * ReviewsPageController constructor.
     * Initializes the database access and login manager
     */
    public function __construct()
    {
        require_once(MODELS_DIR."/DBModel.php");
        require_once(SESS_DIR."/WebLogin.php");

        $this -> db = new DBModel();
        $this -> login = new WebLogin();
    }

    public function show($title):string
    {
        global $templateData;
        $templateData['title'] = $title;
        $templateData['currentPageKey'] = "reviews";

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

        $userInfo = $this -> login ->getUserInfo();
        $templateData['articlesToReview'] = $this -> db -> getArticlesToReview($userInfo['id']);

        ob_start();

        require_once(VIEWS_DIR."/ReviewsPageView.php");

        $pageContents = ob_get_clean();

        return $pageContents;
    }
}