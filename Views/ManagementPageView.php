<?php
// Header and footer
require(VIEWS_DIR."/StandardTemplates.php");
// Global data
global $templateData;
// Stylesheets
$styleSheets = array
(
    ""
);
// Check for admin privileges
require_once(SESS_DIR."/WebLogin.php");
$login = new WebLogin();

if ($login -> getUserPrivileges() != "admin") // If the user has nothing to do here
{
    ?>
        <!doctype html>
        <head>
    <meta http-equiv="refresh" content="0;url=?page=mainpage">
        </head>
    <?php
    die;
} else {                                                // Otherwise render the HTML
    $stdTemplates = new StandardTemplates();
    $stdTemplates->getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $styleSheets, null);


    ?>
    <div class="container h-75">
        <h2 class="text-center p-3">User Management</h2>
        <table class="table pb-3">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Email</th>
                <th scope="col">Privilege</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($templateData['users'] as $user)       // ---------------- FOR EACH USER ONE ROW -------------------- //
            {
                ?>
                <tr>
                    <td><?php echo $user['id_user']; ?></td>
                    <td><?php echo $user['nick']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['surname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['privilege']; ?></td>
                    <td>
                        <form method="post" action="Actions/DeleteUserAction.php"><input type="hidden" name="id_user"
                                                                                         value="<?php echo $user['id_user']; ?>">
                            <button type="submit" class="btn btn-danger" name="action" value="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
        if (count($templateData['users']) == 0)             // -------------------------------- IF THERE ARE NO USERS TO DISPLAY -------------------------------------- //
        {
            ?>
            <h4 class="text-center pb-3">No users to display</h4>
            <?php
        }
        ?>
        <hr style="margin-top: -18px"/>

        <!-- ------------------------------------------------------------------------------- REVIEW MANAGEMENT----------------------------------------------------------------------------------------- -->

        <h2 class="text-center p-3">Article Reviews Management</h2>
        <table class="table p-3">
            <thead>
            <tr>
                <th scope="col">Article ID</th>
                <th scope="col">Author ID</th>
                <th scope="col">Reviewer 1</th>
                <th scope="col">Reviewer 2</th>
                <th scope="col">Reviewer 3</th>
                <th scope="col">Save</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
                <?php

                foreach ($templateData['articles'] as $article)
                {
                    ?>
                <tr>
                    <td><?php echo $article['id_article']; ?></td>
                    <td><?php echo $article['article_author']; ?></td>
                    <form action="Actions/AssignReviewsAction.php" method="post">
                        <td>
                            <select class="browser-default custom-select" name="reviewer1">
                                <?php
                                    $userSelected = false;
                                    foreach ($templateData['users'] as $user)       // For each user
                                    {
                                            if ($article['reviewer1'] == $user['id_user'] && $article['article_author'] != $user['id_user'])  // If user was already selected before
                                            {
                                                echo "<option value='" . $user['id_user'] . "' selected>" . $user['nick'] . "</option>";        // Use him as default for this cell
                                                $userSelected = true;
                                            } else if ($article['article_author'] != $user['id_user'])
                                                {
                                                    echo "<option value='" . $user['id_user'] . "'>" . $user['nick'] . "</option>";     // Echo all the others
                                                }
                                    }
                                    if ($userSelected == false)
                                    {
                                        echo "<option selected>Select user</option>";
                                    }
                            ?>
                            </select>
                        </td>
                        <td>
                            <select class="browser-default custom-select" name="reviewer2">
                                <?php
                                $userSelected = false;
                                foreach ($templateData['users'] as $user)       // For each user
                                {
                                        if ($article['reviewer2'] == $user['id_user'] && $article['article_author'] != $user['id_user'])  // If user was already selected before
                                        {
                                            echo "<option value='" . $user['id_user'] . "' selected>" . $user['nick'] . "</option>";        // Use him as default for this cell
                                            $userSelected = true;
                                        } else if ($article['article_author'] != $user['id_user'])
                                        {
                                            echo "<option value='" . $user['id_user'] . "'>" . $user['nick'] . "</option>";     // Echo all the others
                                        }
                                }
                                if ($userSelected == false)
                                {
                                    echo "<option selected>Select user</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select class="browser-default custom-select" name="reviewer3">
                                <?php
                                $userSelected = false;
                                foreach ($templateData['users'] as $user)       // For each user
                                {
                                        if ($article['reviewer3'] == $user['id_user'] && $article['article_author'] != $user['id_user'])  // If user was already selected before
                                        {
                                            echo "<option value='" . $user['id_user'] . "' selected>" . $user['nick'] . "</option>";        // Use him as default for this cell
                                            $userSelected = true;
                                        } else if ($article['article_author'] != $user['id_user'])
                                        {
                                            echo "<option value='" . $user['id_user'] . "'>" . $user['nick'] . "</option>";     // Echo all the others
                                        }
                                }
                                if ($userSelected == false)
                                {
                                    echo "<option selected>Select user</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-info" type="submit" name="id_article" value="<?php echo $article['id_article']; ?>">Save</button>
                        </td>
                    </form>
                    <form action="Actions/DeleteArticleAction.php" method="post">
                        <td>
                            <button class="btn btn-danger" type="submit" name="id_article" value="<?php echo $article['id_article']; ?>">Delete</button>
                        </td>
                    </form>
                <tr>
                    <?php
                }

                ?>
            </tbody>
        </table>
        <hr style="margin-top: -18px"/>
        <small class="text-muted mb-4">Please do not assign the same user to more than one slot in an article, only one assignment will be made.</small>

    </div>

    <?php
    $stdTemplates->getHTMLFooter();
}
?>