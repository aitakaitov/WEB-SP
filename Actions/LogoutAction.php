<?php
// Link Login manager
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebLogin.php");

// Create login instance
$login = new WebLogin();
// If logged in -> log out
if ($login -> isUserLogged())
{
    $login -> logout();
}
// Redirect to main page
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="refresh" content="0;url=../index.php?page=mainpage">
</head>
<body></body>
</html>
<?php ?>
