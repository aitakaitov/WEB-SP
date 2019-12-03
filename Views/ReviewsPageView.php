<?php

require_once("settings.php");
require_once("StandardTemplates.php");

$styleSheets = array
(
);

$scripts = array();

global $templateData;

$stdTemplates = new StandardTemplates();

$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], null, null);
?>
<div class="container h-75">
    <h2 class="text-center">Articles to review</h2>
        <table class="table pb-3">
            <thead>
                <tr>
                    <th scope="col">
                        Title
                    </th>
                    <th scope="col">
                        Article ID
                    </th>
                    <th scope="col">
                        User ID
                    </th>
                    <th scope="col">
                        Review
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($templateData['articlesToReview'] as $a)
            {
                ?>
                <tr>
                    <td><?php echo $a['title'] ?></td>
                    <td><?php echo $a['id_article']?></td>
                    <td><?php echo $a['article_author'] ?></td>
                    <td><a href="?page=reviewarticle&id=<?php echo $a['id_article'] ?>"><button class="btn btn-info">Review</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    <hr style="margin-top: -16px"/>

</div>

<?php
$stdTemplates -> getHTMLFooter();
?>