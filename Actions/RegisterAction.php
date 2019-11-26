<?php
// Import database access
require_once(MODELS_DIR."/DBModel.php");
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
    // TODO Do something if successul
}
else
    {
        // TODO Do something if unsuccessful
    }
?>
