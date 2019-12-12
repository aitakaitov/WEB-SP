<?php

global $templateData;

require_once("settings.php");
require_once("StandardTemplates.php");

$stdTemplates = new StandardTemplates();

$stylesheets = array();
$scripts = array();

$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $stylesheets, $scripts);

?>

<div class="container h-75">
    <h2 class="text-center p-3">My Articles</h2>
    <p>Here you can see all your articles with their score. "Not assigned" means that no reviewer has been assigned to that spot. "No score" means, that the review has not been done yet. In the last column you can see whether the article has been approved or not.</p>
    <p>There are 3 criteria - in the table there are 'text score' - 'photos score' - 'location score' in this order.</p>
    <div class="table-responsive">
    <table class="table pb-3">
        <thead>
            <tr>
                <th scope="col">Article ID</th>
                <th scope="col">Title</th>
                <th scope="col">Review 1</th>
                <th scope="col">Review 2</th>
                <th scope="col">Review 3</th>
                <th scope="col">Approved</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($templateData['articles'] as $article)
            {
                ?>
            <tr>
                <td><?php echo $article['id_article']; ?></td>
                <td class="text-truncate"><?php echo $article['title']; ?></td>
                <td><?php echo $article['text_score1']."/10 - ".$article['photo_score1']."/10 - ".$article['location_score1']."/10"; ?></td>
                <td><?php echo $article['text_score2']."/10 - ".$article['photo_score2']."/10 - ".$article['location_score2']."/10"; ?></td>
                <td><?php echo $article['text_score3']."/10 - ".$article['photo_score3']."/10 - ".$article['location_score3']."/10"; ?></td>
                <td><?php if ($article['approved'] == 0) {echo "Not approved";} else {echo "Approved";} ?></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    </div>
    <hr style="margin-top: -12px; padding-bottom: 10px" />
</div>
<?php
$stdTemplates -> getHTMLFooter();
?>
