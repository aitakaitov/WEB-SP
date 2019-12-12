<?php
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
// Database access
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");

$userID = $_POST['id_user'];
$db = new DBModel();

$db -> deleteUser($userID);

?>
   <!doctype html>
    <html>
    <head>
        <meta http-equiv="refresh" content="0;url=../index.php?page=management">
    </head>
    <body></body>
    </html>
<?php
die;