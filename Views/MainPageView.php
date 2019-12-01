<?php

// Stylesheets to be linked specific to this page
$styleSheets = array
(
    "Views/Styles/mainpage_styles.css"
);

// We need templateData global
global $templateData;

// Include header and footer
require(VIEWS_DIR."/StandardTemplates.php");
$stdTemplates = new StandardTemplates();
// Create header with menu
$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $styleSheets, null); //TODO

?>

    <div class="text-center">
        <h1>Articles</h1>
    </div>

    <?php
        // If there are no articles to display
        if (empty($templateData['articles']))
        {
            echo "<div class=\"text-center\"><h3>No articles available.</h3></div>";      // echo no articles message
        } else
            {
                foreach ($templateData['articles'] as $article)
                {
                    echo "<div class=\"text-center\">
                            <div class=\"hvrbox\">
                                  <img src=\"".$article['introduction_image']."\" alt=\"".$article['title']."\" class=\"hvrbox-layer_bottom\"/>
                                <div class=\"hvrbox-layer_top\">
                                    <div class=\"hvrbox-text\" id='hoverbox-ref'><a style='text-decoration: none;font-size: xx-large;color: white' href='?page=article&id=".$article['id_article']."'>".$article['title']."</a></div>
                                </div>                                              <!-- Stop-gap measure, CSS not cooperating as much as I'd like -->
                            </div>
                          </div>";
                }
            }


    ?>



<?php

$stdTemplates -> getHTMLFooter();

?>
