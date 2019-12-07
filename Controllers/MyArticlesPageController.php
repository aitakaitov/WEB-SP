<?php

require_once("settings.php");
require_once("IController.php");
require_once("FunctionsMenuPages.php");

/**
 * Class MyArticlesPageController
 */
class MyArticlesPageController implements IController
{
    // Login manager
    private $login;
    // Database access
    private $db;

    /**
     * MyArticlesPageController constructor.
     * Inits database and login manager
     */
    public function __construct()
    {
        require_once(MODELS_DIR."/DBModel.php");
        require_once(SESS_DIR."/WebLogin.php");

        $this -> login = new WebLogin();
        $this -> db = new DBModel();
    }

    public function show($title):string
    {
        global $templateData;
        $templateData['title'] = $title;
        $templateData['currentPageKey'] = "myarticles";

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
        $templateData['articles'] = $this -> db -> getUserArticles($this -> login -> getUserInfo()['id']);

        foreach ($templateData['articles'] as $article)
        {
            $reviews = $this -> db -> getArticleReviews($article['id_article']);
            $article['score1'] = $reviews[0];
        }

        ob_start();

        require_once(VIEWS_DIR."/MyArticlesPageView.php");

        $pageContents = ob_get_clean();

        return $pageContents;
    }
}