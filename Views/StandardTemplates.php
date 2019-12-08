<?php

/**
 * Class StandardTemplates
 * Creates basic template sections like headers and footers, which are not unique in terms of pages
 */
class StandardTemplates
{
    private $login;

    /**
     * StandardTemplates constructor.
     */
    public function __construct()
    {
        require_once(SESS_DIR."/WebLogin.php");
        $this -> login = new WebLogin();
    }

    /**
     * Returns a header, universal to all pages
     * Header contains small header text and navigation bar
     * @param title page title
     * @param pages should contain all pages that the user should be able to see, so that admin controls wont be shown to non-admin users etc.
     * @param currentPageKey pageKey of page being displayed
     * @param styleSheets CSS to be linked apart from Bootstrap
     * @param scripts JS files to be linked
     */
    public function getHTMLHeader($title, $pages, $currentPageKey, $styleSheets, $scripts)
    {
        ?>

        <!doctype html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                <meta name="author" content="Vojtech Barticka">

                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

                <?php   // If we need any JS
                if (!is_null($scripts))
                {
                    foreach ($scripts as $s)
                    {
                        echo "<script src='".$s."'></script>";
                    }
                }
                ?>


                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <?php   // --------------------------------------------------------------------------------- DYNAMICALLY INCLUDE STYLESHEETS ----------------------------------------------------------------------

                if (!is_null($styleSheets)) // If stylesheets are necessary
                {
                    foreach ($styleSheets as $sheet)    // Link styles
                    {
                        echo "<link rel='stylesheet' href=" . $sheet . ">";
                    }
                }
                ?>
                <link rel="stylesheet" href="Views/Styles/universal_styles.css">    <!-- CSS for navbar padding -->
                <title><?php echo $title;?></title>
            </head>
            <body>
                <!-- NAVBAR -->
                 <nav class="navbar navbar-expand-sm navbar-light bg-light shadow fixed-top">
                     <div class="container">
                         <a class="navbar-brand" href="?page=mainpage">Urbex Conference</a>
                         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="navbar-toggler-icon"></span>
                         </button>
                         <div class="collapse navbar-collapse" id="navbarSupportedContent">
                             <ul class="navbar-nav nav ml-auto">

                                 <?php  //------------------------------------------------------------------------ PRINT OUT PAGES INTO MENU -----------------------------------------------------------------

                                 // Print out all pages that we should print out (different for admins, logged, visitors)
                                    foreach ($pages as $p)
                                    {
                                        if ($p == $currentPageKey)
                                        {
                                            echo "<li class='nav-item'><a class='nav-link' href='index.php?page=".$p."'><strong>".WEB_PAGES[$p]['title']."</strong></a></li>";

                                        }
                                            else
                                            {
                                                echo "<li class='nav-item'><a class='nav-link' href='index.php?page=".$p."'>".WEB_PAGES[$p]['title']."</a></li>";
                                            }
                                    }
                                 ?>

                             <?php
                                    // -------------------------------------------------------- USER NOT LOGGED IN -> LOGIN FORM IN NAVBAR -------------------------------------------------------------------------------

                                if (!$this -> login -> isUserLogged())   // If user is not logged in -> include login form in navbar
                                {
                             ?>
                             </ul>
                             <ul class="navbar-nav nav navbar-right">
                                 <li class="dropdown">
                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <span class="sparet"> </span></a>
                                     <ul id="login-dp" class="dropdown-menu">
                                         <li>
                                             <div class="row h-100 justify-content-center align-items-center">
                                                 <div class="col-md-12">
                                                     <form class="form" role="form" method="post" action="Actions/LoginAction.php" id="login-nav">
                                                         <div class="form-group">
                                                             <label class="sr-only" for="input_nickname">Nickname</label>
                                                             <input type="text" name="username" class="form-control" id="input_nickname" placeholder="Nickname" required>
                                                         </div>
                                                         <div class="form-group">
                                                             <label class="sr-only" for="input_password">Password</label>
                                                             <input type="password" name="password" class="form-control" id="input_password" placeholder="Password" required>
                                                         </div>
                                                         <div class="form-group">
                                                             <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                                         </div>
                                                     </form>
                                                 </div>
                                             </div>
                                         </li>
                                     </ul>
                                 </li>
                             </ul>
                         </div>
                        <?php           // -------------------------------------------------------- END OF => USER NOT LOGGED IN -> LOGIN FORM IN NAVBAR -------------------------------------------------------------------------------
                                } else  // -------------------------------------------------------- USER LOGGED IN -> LOGOUT BUTTON IN NAVBAR ----------------------------------------------------------------------//
                                    {
                                        ?>
                             <li class="nav-item navbar-right">
                                 <a class="nav-link" href="Actions/LogoutAction.php">Logout</a>
                             </li>
                             <li class="nav-item">
                                 <span class="font-weight-bold"><a class="nav-link ml-3" href="?page=userinfo"><?php echo $_SESSION['name']." (".$_SESSION['privileges'].")"; ?></a></span>
                             </li>
                         </ul>
                                        <?php
                                    }
                        ?>

                     </div>
                 </nav>
        <?php
    }

    /**
     * Creates simple HTML footer
     */
    public function getHTMLFooter()
    {
        ?>
        <!-- Footer -->
                <div class="navbar navbar-default bg-light navbar-fixed-bottom">
                    <div class="container">
                        <p class="navbar-text pull-left">© 2019 - Vojtech Barticka for KIV/WEB pusposes.</p>
                        <p class="navbar-text pull-right">For more urbex visit my <a href="https://instagram.com/vojta_barticka" target="_blank">Instagram</a></p>
                    </div>
                </div>
            </body>
        </html>
        <?php
    }
}
?>