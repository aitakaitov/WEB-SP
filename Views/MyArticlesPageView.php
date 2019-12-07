<?php

global $templateData;

require_once("settings.php");
require_once("StandardTemplates.php");

$stdTemplates = new StandardTemplates();

$stylesheets = array();
$scripts = array();

$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $stylesheets, $scripts);

?>

<div class="container h-75">
    <h2 class="text-center p-3">My Articles</h2>
    <table class="table pb-3">
        <thead>
            <tr>
                <th scope="col">Article ID</th>
                <th scope="col">Title</th>
                <th scope="col">Review 1</th>
                <th scope="col">Review 2</th>
                <th scope="col">Review 3</th>
                <th scope="col">Approved</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
