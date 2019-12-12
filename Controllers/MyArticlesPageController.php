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
                $templateData['articles'][$index]['text_score1'] = "Not assigned";
                $templateData['articles'][$index]['photo_score1'] = "Not assigned";
                $templateData['articles'][$index]['location_score1'] = "Not assigned";
            }
            else if ($article['review1'] != null)   // If reviewer assigned and review present -> score
                {
                    $templateData['articles'][$index]['text_score1'] = $reviews[0]['text_points'];
                    $templateData['articles'][$index]['photo_score1'] = $reviews[0]['photo_points'];
                    $templateData['articles'][$index]['location_score1'] = $reviews[0]['location_points'];
                }
            else    // Id reviewer assigned but no review present -> "No score"
            {
                $templateData['articles'][$index]['text_score1'] = "No score";
                $templateData['articles'][$index]['photo_score1'] = "No score";
                $templateData['articles'][$index]['location_score1'] = "No score";
            }

            if ($article['reviewer2'] == null)
            {
                $templateData['articles'][$index]['text_score2'] = "Not assigned";
                $templateData['articles'][$index]['photo_score2'] = "Not assigned";
                $templateData['articles'][$index]['location_score2'] = "Not assigned";
            }
            else if ($article['review2'] != null)
                {
                    $templateData['articles'][$index]['text_score2'] = $reviews[1]['text_points'];
                    $templateData['articles'][$index]['photo_score2'] = $reviews[1]['photo_points'];
                    $templateData['articles'][$index]['location_score2'] = $reviews[1]['location_points'];
                }
            else
            {
                $templateData['articles'][$index]['text_score2'] = "No score";
                $templateData['articles'][$index]['photo_score2'] = "No score";
                $templateData['articles'][$index]['location_score2'] = "No score";
            }

            if ($article['reviewer3'] == null)
            {
                $templateData['articles'][$index]['text_score3'] = "Not assigned";
                $templateData['articles'][$index]['photo_score3'] = "Not assigned";
                $templateData['articles'][$index]['location_score3'] = "Not assigned";
            }
            else if ($article['review3'] != null)
                {
                    $templateData['articles'][$index]['text_score3'] = $reviews[2]['text_points'];
                    $templateData['articles'][$index]['photo_score3'] = $reviews[2]['photo_points'];
                    $templateData['articles'][$index]['location_score3'] = $reviews[2]['location_points'];
                }
            else
                {
                    $templateData['articles'][$index]['text_score3'] = "No score";
                    $templateData['articles'][$index]['photo_score3'] = "No score";
                    $templateData['articles'][$index]['location_score3'] = "No score";
                }

            $index++;
        }

        ob_start();

        require_once(VIEWS_DIR."/MyArticlesPageView.php");

        $pageContents = ob_get_clean();

        return $pageContents;
    }
}