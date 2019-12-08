<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebLogin.php");

$login = new WebLogin();
$db = new DBModel();

// User ID
$temp = $login -> getUserInfo();
$userID = $temp['id'];
$nick = $temp['nick'];
$userInfo;

// If the password was incorrect
if (isset($_POST['password']) && !$db -> userLoginCheck($nick, $_POST['password']))
{
    ?>
<!doctype html>
    <html>
        <head>
            <meta http-equiv="refresh" content="0;url=../index.php?page=userinfo&success=false">
        </head>
    </html>
    <?php
    exit();
    die;        // shut down the script
}

if (isset($_POST['name']))
{
    $userInfo['name'] = $_POST['name'];
}

if (isset($_POST['surname']))
{
    $userInfo['surname'] = $_POST['surname'];
}

if (isset($_POST['nick']))
{
    $userInfo['nick'] = $_POST['nick'];
}

if (isset($_POST['email']))
{
    $userInfo['email'] = $_POST['email'];
}

if (isset($_POST['new_password']))
{
    $userInfo['password'] = $_POST['new_password'];
}

$db -> updateUserInfo($userInfo, $userID);