<?php
// Data for template
$templateData['currentPageKey'] = "register";
$templateData['title'] = "Register Page TEST";
$templateData['pages'] = array
(
    "mainpage",
    "register",
    "about"
);

// Include header and footer
require(VIEWS_DIR."/StandardTemplates.php");
$stdTemplates = new StandardTemplates();
// Create header with menu
$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $styleSheets);

?>

<div class="text-center">
    <form action="Actions/registerAction.php" method="post">
        <div class="form-group">
            <label for="input_nick">Email address <span class="red-text">*</span></label>
            <input type="text" name="nickname" class="form-control" id="input_nick" placeholder="Nickname">
        </div>
        <div class="form-group">
            <label for="input_email">Email address <span class="red-text">*</span></label>
            <input type="email" name="email" class="form-control" id="input_email" aria-describedby="emailHelp" placeholder="Enter email address">
            <small id="emailHelp" class="form-text text-muted">Enter a valid email address</small>
        </div>
        <div class="form-group">
            <label for="input_password">Email address <span class="red-text">*</span></label>
            <input type="password" name="password" class="form-control" id="input_password" aria-describedby="passwordHelp" placeholder="Password">
            <small id="passwordHelp" class="form-text text-muted">Stronger password if possible</small>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>



<?php
$stdTemplates -> getHTMLFooter();

?>