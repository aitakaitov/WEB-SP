<?php

require_once("settings.php");
require_once("FunctionsMenuPages.php");
require_once("IController.php");

/**
 * Class ArticleReviewPageController
 */
class ArticleReviewPageController implements IController
{
    // Database access
    private $db;
    // Login manager
    private $login;

    /**
     * ArticleReviewPageController constructor.
     * Inits login manager and database access
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
        $templateData['currentPageKey'] = "reviewarticle";

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
        $templateData['error'] = null;        // To signal that article is OK                 // ------------------------------------------------------ CHECK IF THE ARTICLE IS OK ----------------------------------------------------
        $templateData['article'] = null;

        if (isset($_GET['id']) && !empty($_GET['id']))        // We will process the article ID here - decide if user can review article and if the article exists
        {
            $article = $this -> db -> getArticleByID($_GET['id']);

            if (is_null($article))          // If such article doesnt exist
            {
                $templateData['id'] = "notfound";
            }
            else            // If it does
                {
                    $templateData['reviewer_number'] = $this -> db -> canUserReviewArticle($this -> login -> getUserInfo()['id'], $_GET['id']);     // Get the reviewer number
                    echo $templateData['reviewer_number'];
                    if ($templateData['reviewer_number'] == -1)     // If -1 -> not allowed and set error flag
                    {
                        $templateData['error'] = "notallowed";
                    } else
                        {
                            $templateData['article'] = $this -> db -> getArticleByID($_GET['id']);
                        }
                }
        }
        else        // If get is not set or empty, we say not found
            {
                $templateData['error'] = "notfound";
            }

        ob_start();

        require_once(VIEWS_DIR."/ArticleReviewPageView.php");

        $pageContents = ob_get_clean();

        return $pageContents;
    }


}