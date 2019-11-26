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

$styleSheets = array
(
        "Views/Styles/registerpage_styles.css"
);

// Include header and footer
require(VIEWS_DIR."/StandardTemplates.php");
$stdTemplates = new StandardTemplates();
// Create header with menu
$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $styleSheets);

?>
    <div class="container h-100">
        <div class="h-100 justify-content-center align-items-center">
        <h2 class="text-center">Register</h2>
        <form action="Actions/RegisterAction.php" method="post">
            <div class="form-group text-left">
                <label for="input_name">Name <span class="red-text">*</span></label>
                <input type="text" name="name" class="form-control" id="input_name" placeholder="Name" required>
            </div>
            <div class="form-group text-left">
                <label for="input_surname">Surname <span class="red-text">*</span></label>
                <input type="text" name="surname" class="form-control" id="input_surname" placeholder="Surname" required>
            </div>
            <div class="form-group text-left">
                <label for="input_nick">Nickname <span class="red-text">*</span></label>
                <input type="text" name="nickname" class="form-control" id="input_nick" placeholder="Nickname" required>
            </div>
            <div class="form-group text-left">
                <label for="input_email">Email address <span class="red-text">*</span></label>
                <input type="email" name="email" class="form-control" id="input_email" placeholder="Enter email address" required>
            </div>
            <div class="form-group text-left">
                <label for="input_password">Password <span class="red-text">*</span></label>
                <input type="password" name="password" class="form-control" id="input_password" placeholder="Password" required>
            </div>
            <small class="form-text text-muted">Fields with * are required</small>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        </div>
    </div>



<?php
$stdTemplates -> getHTMLFooter();

?>