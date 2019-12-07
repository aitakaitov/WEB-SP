<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebLogin.php");

$db = new DBModel();
$login = new WebLogin();

if (isset($_POST['score']))  // Parse score
{
    $score = $_POST['score'];

    $score = round($score);

    if ($score >= 10)
    {
        $score = 10;
    }
    if ($score <= 0)
    {
        $score = 0;
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

$db -> addReviewToArticle($userID, $text, $articleID, $reviewerNumber, $score);     // The variables are certainly not empty - otherwise the page wouldn't load

?>

<!doctype html>
<html>
<head>
    <!-- <meta http-equiv="refresh" content="0;url=../index.php?page=reviews"> -->
</head>
</html>
