<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");

$db = new DBModel();

if (isset($_POST['id_article']) && !empty($_POST['id_article']))
{
    $db -> approveArticle($_POST['id_article']);
}

?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="refresh" content="0;url=../index.php?page=management">
    </head>
</html>
