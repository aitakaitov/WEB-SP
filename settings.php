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
        "access" => "all"       // Everyone can access the page     all - everyone, logged - logged in users, unlogged - unlogged users, admin - admin users
    ),

    "register" => array
    (
        "file_name" => "RegisterPageController.php",
        "class_name" => "RegisterPageController",
        "title" => "Register",
        "key" => "register",
        "access" => "unlogged"
    ),

    "about" => array
    (
        "file_name" => "AboutPageController.php",
        "class_name" => "AboutPageController",
        "title" => "About",
        "key" => "about",
        "access" => "all"
    ),

    "article" => array
    (
        "file_name" => "ArticlePageController.php",
        "class_name" => "ArticlePageController",
        "title" => "placeholder",   // Is resolved in controller
        "key" => "article",
        "access" => "except"        // Because it will not be shown in navbar, but can be accessed by anyone
    )
);

// Default web page
const DEFAULT_WEB_PAGE = "mainpage";

?>
