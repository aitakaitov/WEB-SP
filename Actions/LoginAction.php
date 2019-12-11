<?php
// Import classes and variables
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".SESS_DIR."/WebLogin.php");
// Create login manager
$login = new WebLogin();
// Try to login user
$login -> login($_POST['username'], $_POST['password']);        // No need to sanitize as we are just checking with the database

// Then redirect
?>
<!doctype html>
<html>
<head>
   <meta http-equiv="refresh" content="0;url=../index.php?page=mainpage">
</head>
<body></body>
</html>

<?php
?>
