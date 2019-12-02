<?php

/**
 * Class NewArticlePageController
 * Controller for page with article editing
 */
class NewArticlePageController implements IController
{
    // Login manager
    private $login;

    /**
     * NewArticlePageController constructor.
     */
    public function __construct()
    {
        require_once("settings.php");
        require_once(SESS_DIR."/Weblogin.php");
        require_once("FunctionsMenuPages.php");

        $this -> login = new WebLogin();
    }

    /**
     * @param $title page title
     * @return string page contents
     */
    public function show($title):string
    {
        global $templateData;

        $templateData['currentPageKey'] = "newarticle";
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

            if ($this -> login -> getUserPrivileges() == "admin")   // for admin
            {
                $pages = array_merge($pages, getPageKeys("admin"));
            }
        }

        $templateData['pages'] = $pages;

        ob_start();

        require(VIEWS_DIR."/NewArticlePageView.php");

        $pageContents = ob_get_clean();

        return $pageContents;
    }
}