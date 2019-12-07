<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");

$db = new DBModel();
$db -> deleteArticle($_POST['id_article']);
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="refresh" content="0;url=../index.php?page=management">
</head>
</html>
