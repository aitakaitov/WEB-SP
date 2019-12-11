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

var_dump($_POST);

// If the password was incorrect
if (isset($_POST['current_password']) && !$db -> userLoginCheck($nick, $_POST['current_password']))
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
    $userInfo['name'] = htmlspecialchars($_POST['name']);
}

if (isset($_POST['surname']))
{
    $userInfo['surname'] = htmlspecialchars($_POST['surname']);
}

if (isset($_POST['username']))
{
    $userInfo['nick'] = htmlspecialchars($_POST['username']);
}

if (isset($_POST['email']))
{
    $userInfo['email'] = htmlspecialchars($_POST['email']);
}

if (isset($_POST['new_password']))      // Password wont be sanitized as it will never be shown in HTML
{
    if ($_POST['new_password'] == "")       // If new password is set but is empty, we will set the new password to be same as the old one, effectively eliminating change
    {
        $userInfo['password'] = $_POST['current_password'];
    } else
        {
            $userInfo['password'] = $_POST['new_password'];
        }
}

$db -> updateUserInfo($userInfo, $userID);

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="refresh" content="0;url=../index.php?page=userinfo">
</head>
</html>
