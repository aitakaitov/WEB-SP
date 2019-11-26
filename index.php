<?php

// Start the app
$webApp = new WebApp();
$webApp -> start();

class WebApp
{
    /**
     * WebApp constructor.
     */
    public function __construct()
    {
        // Load defined variables
        require_once("settings.php");
        // Load controller interface
        require_once(CONTROLLERS_DIR."/IController.php");
    }

    public function start()
    {
        // Test whether the specified page actually exists
        if (isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES))
        {
            // If yes, show it
            $pageKey = $_GET["page"];
        } else
            {
                // If not, go default
                $pageKey = DEFAULT_WEB_PAGE;
            }

        // Load page info from settings.php
        $pageInfo = WEB_PAGES[$pageKey];

        // Attach controller file
        require_once(CONTROLLERS_DIR."/".$pageInfo["file_name"]);

        // Load the controller
        $ctrl = new $pageInfo["class_name"];

        // Print the returned page as string
        echo $ctrl -> show($pageInfo['title']);
    }
}
