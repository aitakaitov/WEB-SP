<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebLogin.php");

$db = new DBModel();
$login = new WebLogin();

if (isset($_POST['text_score']))  // Parse score
{
    $textScore = htmlspecialchars($_POST['text_score']);

    $score = round($textScore);

    if ($textScore >= 10)
    {
        $textScore = 10;
    }
    if ($textScore <= 0)
    {
        $textScore = 0;
    }
}

if (isset($_POST['photo_score']))  // Parse score
{
    $photoScore = htmlspecialchars($_POST['photo_score']);

    $photoScore = round($photoScore);

    if ($photoScore >= 10)
    {
        $photoScore = 10;
    }
    if ($photoScore <= 0)
    {
        $photoScore = 0;
    }
}

if (isset($_POST['location_score']))  // Parse score
{
    $locationScore = htmlspecialchars($_POST['location_score']);

    $locationScore = round($locationScore);

    if ($locationScore >= 10)
    {
        $locationScore = 10;
    }
    if ($locationScore <= 0)
    {
        $locationScore = 0;
    }
}

if (isset($_POST['review_text']) && !empty($_POST['review_text']))  // Parse text
{
    $text = $_POST['review_text'];
}

if (isset($_POST['article_id_reviewer_number']) && !empty($_POST['article_id_reviewer_number']))        // Parse the articleID and reviewer number combo
{
    $strings = explode("_", $_POST['article_id_reviewer_number']);  // split them
    $articleID = $strings[0];
    $reviewerNumber = $strings[1];
}

$userID = $login -> getUserInfo()['id'];        // Get user ID

$db -> addReviewToArticle($userID, $text, $articleID, $reviewerNumber, $textScore, $photoScore, $locationScore);     // The variables are certainly not empty - otherwise the page wouldn't load

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="refresh" content="0;url=../index.php?page=reviews">
</head>
</html>
