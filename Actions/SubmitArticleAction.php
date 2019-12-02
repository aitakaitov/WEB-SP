<?php

require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebLogin.php");

$db = new DBModel();
$login = new WebLogin();

if (isset($_POST['article_text']) && !empty($_POST['article_text']))        // check if article text is present
{
    $articleText = $_POST['article_text'];
}

if (isset($_POST['title']) && !empty($_POST['title']))
{
    $title = $_POST['title'];
}

$images = array_filter($_FILES['images']['name']);                          // Filter out empty names
$count = count($_FILES['images']['name']);

if ($count > 5)             // Only five images
{
    $count = 5;
}

$imagesString = "";     // All the images in one string, separated by commas
$headerImage = null;    // The first valid image

for ($i = 0; $i < $count; $i++)              // Take max five images
{
    $tmpFilePath = $_FILES['images']['tmp_name'][$i];       // Get their temporary file path
    $fileName = $_FILES['images']['name'][$i];

    if ($tmpFilePath != "")
    {
        $extension = explode(".", $fileName);                // Get the extension
        $extension[1] = strtolower($extension[1]);

        if ($extension[1] != "jpg" && $extension[1] != "jpeg" && $extension[1] && "png")     // Skip invalid files
        {
            continue;
        }

        $newFilePath = "/Views/img/".sha1_file($tmpFilePath).".".$extension[1];          // Create new file name with SHA-1 hash
        $imagesString = $imagesString."/web".$newFilePath.",";                         // So that we can move the images into database

        if ($headerImage == null)                                               // The first valid image will be the header image
        {
            $headerImage = "/web".$newFilePath;
        }

        move_uploaded_file($tmpFilePath, "..".$newFilePath);
    }
}
$user = $db -> getUserByNick($login ->getUserInfo()['nick']);       // Get author ID
$db -> addArticle($articleText, $user[0]['id_user'], $imagesString, $title, $headerImage);

