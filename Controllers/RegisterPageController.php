<?php

// Variables
require_once("settings.php");
// Controller interface
require_once(CONTROLLERS_DIR."IController.php");

/**
 * Class RegisterPageController
 */
class RegisterPageController
{
    public function __construct()
    {
    }

    public function show($title)
    {
        ob_start();

        require(VIEWS_DIR."/RegisterPageView.php");

        $output = ob_get_clean();

        return $output;
    }
}