<?php

// Global variables //

// Server
define("DB_SERVER", "localhost");
// Database name
define("DB_NAME", "conference_db");
// Database user (for testing purposes)
define("DB_USER", "root");
// Database pass (for testing purposes)
define("DB_PASS", "");


// Table with articles
define("TABLE_ARTICLES", "articles");
// Table with users
define("TABLE_USERS", "users");
// Table with article reviews
define("TABLE_REVIEWS", "reviews");

// Controllers dir
const CONTROLLERS_DIR = "Controllers";
// Models dir
const MODELS_DIR = "Models";
// Views dir
const VIEWS_DIR = "Views";
// Session dir
const SESS_DIR = "Session";


// Web pages info
const WEB_PAGES = array
(
    "mainpage" => array
    (
        "file_name" => "MainPageController.php",
        "class_name" => "MainPageController",
        "title" => "Main page",
        "key" => "mainpage",    // Key for referencing the page in <a href...>
        "access" => "all"       // Everyone can access the page     all - everyone, logged - logged in users, unlogged - unlogged users, admin - admin users, except - not in navbar
    ),

    "register" => array
    (
        "file_name" => "RegisterPageController.php",
        "class_name" => "RegisterPageController",
        "title" => "Register",
        "key" => "register",
        "access" => "unlogged"
    ),

    "article" => array
    (
        "file_name" => "ArticlePageController.php",
        "class_name" => "ArticlePageController",
        "title" => "placeholder",   // Is resolved in controller
        "key" => "article",
        "access" => "except"        // Because it will not be shown in navbar, but can be accessed by anyone
    ),

    "management" => array
    (
        "file_name" => "ManagementPageController.php",
        "class_name" => "ManagementPageController",
        "title" => "Management",
        "key" => "management",
        "access" => "admin"
    ),

    "newarticle" => array
    (
        "file_name" => "NewArticlePageController.php",
        "class_name" => "NewArticlePageController",
        "title" => "New Article",
        "key" => "newarticle",
        "access" => "logged"
    ),

    "reviews" => array
    (
        "file_name" => "ReviewsPageController.php",
        "class_name" => "ReviewsPageController",
        "title" => "Reviews",
        "key" => "reviews",
        "access" => "logged"
    ),

    "reviewarticle" => array
    (
        "file_name" => "ArticleReviewPageController.php",
        "class_name" => "ArticleReviewPageController",
        "title" => "Article Review",
        "key" => "articlereview",
        "access" => "except"
    ),

    "myarticles" => array
    (
        "file_name" => "MyArticlesPageController.php",
        "class_name" => "MyArticlesPageController",
        "title" => "My Articles",
        "key" => "myarticles",
        "access" => "logged"
    )
);

// Default web page
const DEFAULT_WEB_PAGE = "mainpage";

?>
