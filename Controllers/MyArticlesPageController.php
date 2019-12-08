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

        $index = 0;
        foreach ($templateData['articles'] as $article)             // Get reviews for articles
        {
            $reviews = $this -> db -> getArticleReviews($article['id_article']);

            if ($article['reviewer1'] == null)      // If no reviewers have been assigned -> "Not assigned"
            {
                $templateData['articles'][$index]['score1'] = "Not assigned";
            }
            else if ($article['review1'] != null)   // If reviewer assigned and review present -> score
                {
                    $templateData['articles'][$index]['score1'] = $reviews[0]['points'];
                }
            else    // Id reviewer assigned but no review present -> "No score"
            {
                $templateData['articles'][$index]['score1'] = "No score";
            }

            if ($article['reviewer2'] == null)
            {
                $templateData['articles'][$index]['score2'] = "Not assigned";
            }
            else if ($article['review2'] != null)
                {
                    $templateData['articles'][$index]['score2'] = $reviews[1]['points'];
                }
            else
            {
                $templateData['articles'][$index]['score2'] = "No score";
            }

            if ($article['reviewer3'] == null)
            {
                $templateData['articles'][$index]['score3'] = "Not assigned";
            }
            else if ($article['review3'] != null)
                {
                    $templateData['articles'][$index]['score3'] = $reviews[2]['points'];
                }
            else
                {
                    $templateData['articles'][$index]['score3'] = "No score";
                }

            $index++;
        }

        ob_start();

        require_once(VIEWS_DIR."/MyArticlesPageView.php");

        $pageContents = ob_get_clean();

        return $pageContents;
    }
}