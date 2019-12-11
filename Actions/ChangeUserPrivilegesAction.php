<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebLogin.php");

$db = new DBModel();

if (isset($_POST['privilege']))
{
    $privilege = $_POST['privilege'];
}

if (isset($_POST['id_user']))
{
    $userID = $_POST['id_user'];
}

$db -> setUserPrivilege($userID, $privilege);

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="refresh" content="0;url=../index.php?page=management">
</head>
</html>

