<?php

require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");

$db = new DBModel();

if (isset($_POST['article_text']) && !empty($_POST['article_text']))        // check if article text is present
{
    $articleText = $_POST['article_text'];
}

$images = array_filter($_FILES['images']['name']);

for ($i = 0; $i < 5; $i++)              // Take five images
{
    $tmpFilePath = $_FILES['images']['tmp_name'][$i];       // Get their temporary file path

    if ($tmpFilePath != "")
    {
        $extension = explode(".", $tmpFilePath);                // Get the extension

        if ($extension[1] != ".jpg" && $extension[1] != ".jpeg" && $extension[1] && ".png")     // Skip invalid files
        {
            continue;
        }

        $newFilePath = "./img/".sha1_file($tmpFilePath).$extension[1];          // Create new file name with SHA-1 hash

        move_uploaded_file($tmpFilePath, $newFilePath);


    }
}
