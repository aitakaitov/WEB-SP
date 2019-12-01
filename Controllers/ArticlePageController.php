<?php
// Variables
require_once("settings.php");
// Interface
require_once("IController.php");
// Menu pages
require_once("FunctionsMenuPages.php");

/**
 * Class ArticlePageController
 */
class ArticlePageController Implements IController
{
    // Database access
    private $db;

    // Login manager
    private $login;

    /**
     * ArticlePageController constructor.
     * Initializes DB
     */
    public function __construct()
    {
        require_once(MODELS_DIR."/DBModel.php");
        $this -> db = new DBModel();
        require_once(SESS_DIR."/WebLogin.php");
        $this -> login = new WebLogin();
    }

    public function show($title):string
    {
        // Init global for template
        global $templateData;

        // If there is ID in GET
        if (isset($_GET['id']) && !empty($_GET['id']))                                      // ------------------------------- GET THE CORRECT ARTICLE OR GO TO "NOT FOUND" ----------------------------
        {
            // Get the article
            $templateData['article'] = $this -> db -> getArticleByID($_GET['id']);
            // Get article reviews
            $templateData['reviews'] = $this -> db -> getArticleReviews($_GET['id']);
            // Get review authors
            $templateData['reviewAuthors'] = array();
            foreach ($templateData['reviews'] as $review)
            {
                $author = $this -> db -> getUserByID($review['review_author']);
                array_push($templateData['reviewAuthors'], $author);
            }
            $temp = $templateData['article'][0];
            $templateData['author'] = $this -> db -> getUserByID($temp['article_author']);
        }
        else
            {
                $templateData['author'] = null;
                $templateData['article'] = null;
                $templateData['reviews'] = null;
            }

        $templateData['currentPageKey'] = "article";

        $pages = array();                                                                               // ------------------------------------- MANAGE PAGES IN NAVBAR BASED ON LOGIN AND PRIVILEGES --------
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

        ob_start();                                                             // ---------------------------- START OUTPUT ----------------------

        require_once(VIEWS_DIR."/ArticlePageView.php");

        $page_contents = ob_get_clean();

        return $page_contents;
    }
}