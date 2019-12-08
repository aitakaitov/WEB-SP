<?php
require_once("settings.php");
require_once(VIEWS_DIR."/StandardTemplates.php");

// Template data and header+footer
global $templateData;
$stdTemplates = new StandardTemplates();

// Styles and scripts
$stylesheets = array();
$scripts = array();

$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $stylesheets, $scripts);

?>
<div class="container h-75">
    <h2 class="text-center">User Information</h2>
    <p>Here you can see your user information as well as change it.</p>

    <?php
        if ($templateData['userInfo'] == null)
        {
            ?>
            <h4 class="text-center">You are not logged in. If you want to see this page, please log in or register.</h4>
            <?php
        } else
            {
                ?>
                <form method="post" class="pb-2" action="Actions/UpdateUserInfoAction.php">
                    <div class="form-group text-left">
                        <label for="input_name">Name:</label>
                        <input type="text" name="name" class="form-control" id="input_name" value="<?php echo $templateData['userInfo']['name']; ?>" required>
                    </div>
                    <div class="form-group text-left">
                        <label for="input_surname">Surname:</label>
                        <input type="text" name="surname" class="form-control" id="input_surname" value="<?php echo $templateData['userInfo']['surname']; ?>" required>
                    </div>
                    <div class="form-group text-left">
                        <label for="input_username">Username:</label>
                        <input type="text" name="username" class="form-control" id="input_username" value="<?php echo $templateData['userInfo']['nick']; ?>" required>
                    </div>
                    <div class="form-group text-left">
                        <label for="input_email">Email:</label>
                        <input type="text" name="email" class="form-control" id="input_username" value="<?php echo $templateData['userInfo']['email']; ?>" required>
                    </div>
                    <div class="form-group text-left">
                        <label for="input_new_password">New password:</label>
                        <input type="password" name="new_password" class="form-control" id="input_new_password" placeholder="New password" onkeyup="validatePassword()">
                    </div>
                    <div class="form-group text-left">
                        <label for="input_password_check">Confirm password:</label>
                        <input type="password" name="password_check" class="form-control" id="input_password_check"  placeholder="New password again" onkeyup="validatePassword()">
                    </div>
                    <div class="form-group text-left pt-3">
                        <label for="input_current_password">Password:</label>
                        <input type="password" name="current_password" class="form-control" id="input_current_password"  placeholder="Current password" required>
                    </div>
                    <button class="btn btn-info" type="submit">Save changes</button>
                </form>
                <?php
            }
    ?>
    <script>

        function validatePassword()     // ------------------------------------------ PASSWORD CHECK VALIDATION ----------------------------------------
        {
            let password = document.getElementById("input_new_password");
            let confirm_password = document.getElementById("input_password_check");

            if (password.value !== confirm_password.value)
            {
                confirm_password.setCustomValidity("Passwords don't match");
            } else
                {
                    confirm_password.setCustomValidity("");
                }
        }
    </script>

</div>

<?php
$stdTemplates -> getHTMLFooter();

?>
