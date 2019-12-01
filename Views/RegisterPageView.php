<?php
// include templatedata
global $templateData;

$styleSheets = array
(
        "Views/Styles/registerpage_styles.css"
);

// Include header and footer
require(VIEWS_DIR."/StandardTemplates.php");
$stdTemplates = new StandardTemplates();
// Create header with menu
$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $styleSheets, null);

// If registration was successful
if (isset($_GET['success']) && $_GET['success'] == "true")  // If the user was registered
{
    ?>
    <div class="text-center">
        <h2>Registration successful!</h2>
        <p>You can now log in!<br>When you are logged in, you can write articles and after they are peer reviewed, they will appear on the main page!</p>
    </div>
    <?php
}
else if (isset($_GET['success']) && $_GET['success'] == "false")    // If the username was not OK
{
    ?>
    <div class="container h-100">
        <div class="h-100 justify-content-center align-items-center">
            <h2 class="text-center">Register</h2>
            <form action="Actions/RegisterAction.php" method="POST">
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
                <small class="form-text text-danger">Nickname is already in use, please choose another one</small>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>

    <?php
}
else if (!isset($_GET['success']) && empty($_GET['success']))   // If we have vanilla register page
{
    ?>
    <div class="container h-100">
        <div class="h-100 justify-content-center align-items-center">
            <h2 class="text-center">Register</h2>
            <form action="Actions/RegisterAction.php" method="POST">
                <div class="form-group text-left">
                    <label for="input_name">Name <span class="red-text">*</span></label>
                    <input type="text" name="name" class="form-control" id="input_name" placeholder="Name" required>
                </div>
                <div class="form-group text-left">
                    <label for="input_surname">Surname <span class="red-text">*</span></label>
                    <input type="text" name="surname" class="form-control" id="input_surname" placeholder="Surname"
                           required>
                </div>
                <div class="form-group text-left">
                    <label for="input_nick">Nickname <span class="red-text">*</span></label>    <!-- In case we have to modifz the page due to unsiutable nickname -->
                    <input type="text" name="nickname" class="form-control <?php if ((isset($_GET['success']) && $_GET['success'] == "false")) {echo "bg-danger";} ?>" id="input_nick" placeholder="Nickname"
                           required>
                    <?php if ((isset($_GET['success']) && $_GET['success'] == "false")) { echo "<small class='form-text text-danger'>Please choose another nickname</small>";} ?>
                </div>          <!-- Same reason as above -->
                <div class="form-group text-left">
                    <label for="input_email">Email address <span class="red-text">*</span></label>
                    <input type="email" name="email" class="form-control" id="input_email"
                           placeholder="Enter email address" required>
                </div>
                <div class="form-group text-left">
                    <label for="input_password">Password <span class="red-text">*</span></label>
                    <input type="password" name="password" class="form-control" id="input_password"
                           placeholder="Password" required>
                </div>
                <small class="form-text text-muted">Fields with * are required</small>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>


    <?php
}
$stdTemplates -> getHTMLFooter();

?>