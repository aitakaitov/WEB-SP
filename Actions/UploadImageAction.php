<?php
var_dump($_POST);
if ($_POST['img_up']['name']) {                                 // Check if file is there
    if (!$_FILES['img_up']['error']) {                            // If there is no error
        $name = md5(rand(100, 200));                            // Generate random name
        $ext = explode('.', $_POST['img_up']['name']);  // Check jpg/...
        $filename = $name.'.'.$ext[1];                          // Generate filename
        $destination = '/Views/img/'.$filename;
        $location = $_POST["img_up"]["tmp_name"];                // get location
        move_uploaded_file($location, $destination);            // move file
    }
    else
    {
        echo  $message = 'ERROR: '.$_FILES['img_up']['error'];    // DEBUG ERROR
    }
}