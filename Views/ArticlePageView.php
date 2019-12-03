<?php

// Data for template
global $templateData;
// Header and footer
require_once("StandardTemplates.php");
$stdTemplates = new StandardTemplates();

$styleSheets = array
(
    "Views/Styles/articlepage_styles.css"
);

if ($templateData['article'] != null)
{
    $article = $templateData['article'];
    $article = $article[0];
    $stdTemplates -> getHTMLHeader($article['title'], $templateData['pages'], $templateData['currentPageKey'], $styleSheets, null);

    $templateData['author'] = $templateData['author'][0];
}
else
    {
        $article = null;
        $stdTemplates -> getHTMLHeader("Article not found", $templateData['pages'], $templateData['currentPageKey'], null, null);
    }

if (is_null($article))
{
    ?>
    <h2 class="text-center">Article not found</h2>
    <?php
} else {
    ?>
    <div class="container">
        <h2 class="text-center p-3"><?php echo $article['title']; ?></h2>
        <h4 class="text-center text-muted pb-2"><?php echo $templateData['author']['name']." ".$templateData['author']['surname']." (".$templateData['author']['nick'].")" ?></h4>
        <div class="text-justify h-75">
            <?php echo $article['text']; ?> <!-- Text formatting should be included in text -->
            <h3 class="text-center p-3">Images</h3>
            <div class="text-center">
                <?php
                $images = explode(",", $article['images']);     // Get all image paths
                if (!is_null($images))  // If there are any
                {
                    foreach ($images as $i) {
                        if ($i == "")
                        {
                            continue;
                        }
                        ?>
                        <a href="<?php echo $i; ?>">
                            <img src="<?php echo $i; ?>" class="img-fluid p-3" alt="Image"/>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
            <h3 class="text-center p-3">Reviews</h3>
            <?php
            if (!is_null($templateData['reviews']))                 // If there are any reviews
            {
                $authors = $templateData['reviewAuthors'];          // We get the authors
                $reviews = $templateData['reviews'];
                $index = 0;

                for ($index = 0; $index < 3; $index++) {
                    $review = $reviews[$index];
                    $author = $authors[$index];                     // We load the corresponding author (they were added in the same cycle, so indexing it like this will work)
                    $author = $author[0];                           // Because in $authors[$index] there's actually a 1-element array in which another array with the data we want is stored
                    ?>
                    <div class="d-flex flex-column">
                        <div>
                            <h5 class="text-left"><?php echo $author['surname']." ".$author['name']." (".$author['nick'].")"; ?></h5>
                        </div>
                        <div>
                            <p class="text-left"><?php echo $review['text']; ?></p>
                        </div>
                        <div>
                            <p class="text-muted">Rating: <?php echo $review['points']; ?>/10</p>
                        </div>
                    </div>
                    <hr/>
                    <?php
                }
            }

            ?>

        </div>
    </div>
    <?php
}
$stdTemplates -> getHTMLFooter();
?>
