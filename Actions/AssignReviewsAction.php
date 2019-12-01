<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
// Database
$db = new DBModel();
// Parse data from POST for more convenience
$reviewer1_id = $_POST['reviewer1'];
$reviewer2_id = $_POST['reviewer2'];
$reviewer3_id = $_POST['reviewer3'];
$article_id = $_POST['id_article'];

// If they were left empty for some reason
if ($reviewer1_id == "")
{
    $reviewer1_id = "NULL";
}
if ($reviewer2_id == "")
{
    $reviewer2_id = "NULL";
}
if ($reviewer3_id == "")
{
    $reviewer3_id = "NULL";
}

// If two of them are the same for some reason
if ($reviewer1_id == $reviewer3_id)
{
    $reviewer3_id = "NULL";
}
if ($reviewer1_id == $reviewer2_id)
{
    $reviewer3_id = "NULL";
}
if ($reviewer2_id == $reviewer3_id)
{
    $reviewer3_id = "NULL";
}

// Call the DB function
$db -> setArticleReviewers($reviewer1_id, $reviewer2_id, $reviewer3_id, $article_id);

// Go back to management page
?>
<!doctype html>
<html>
    <head>
       <meta http-equiv="refresh" content="0;url=../index.php?page=management">
    </head>
    <body></body>
</html>
<?php ?>