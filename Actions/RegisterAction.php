<?php
// Import database access
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/settings.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT'])."/web/".MODELS_DIR."/DBModel.php");
$db = new DBModel();

// Take info from POST
$userInfo = [];
$userInfo['nickname'] = $_POST['nickname'];
$userInfo['name'] = $_POST['name'];
$userInfo['surname'] = $_POST['surname'];
$userInfo['email'] = $_POST['email'];
$userInfo['password'] = $_POST['password'];

// Try to create new user
if ($db -> addUser($userInfo))
{
    // If successful, redirect to "Registered" page - it's necessary to do it this way, because browser will block any header(...) as unsafe redirect
    ?>

    <!doctype html>
    <html>
        <head>
            <meta http-equiv="refresh" content="0;url=../index.php?page=register&success=true">
        </head>
    <body></body>
    </html>

    <?php
    exit();
}
else        // Else redirect back to register form
    {
        ?>
        <!doctype html>
        <html>
        <head>
            <meta http-equiv="refresh" content="0;url=../index.php?page=register&success=false">
        </head>
        <body></body>
        </html>
        <?php
        exit();
    }
?>
