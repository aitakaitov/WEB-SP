<?php

// Variables file
require_once("settings.php");
// Controller interface file
require_once(CONTROLLERS_DIR."/IController.php");

/**
 * Class MainPageController
 * Controller for main page
 * Loads data for template to database
 */
class MainPageController implements IController
{
    // Database
    private $db;

    /**
     * MainPageController constructor.
     * Creates database access
     */
    public function __construct()
    {
        // Database model file
        require_once(MODELS_DIR."/DBModel.php");
        // Init db
        $this->db = new DBModel();
    }

    public function show($title):string
    {
        global $templateData;

        $templateData = [];

        //$templateData['articles'] = null;    // TODO
        $templateData['articles'] = $this -> db ->getAllApprovedArticles();

        // Start the output buffer
        ob_start();

        // Get the template HTML
        require(VIEWS_DIR."/MainPageView.php");

        // Get output buffer contents and clean buffer
        $pageContents = ob_get_clean();

        // return page contents
        return $pageContents;
    }
}