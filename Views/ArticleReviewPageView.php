<?php
require_once("settings.php");
require_once("StandardTemplates.php");
global $templateData;

$stdTemplates = new StandardTemplates();

$styleSheets = array
(
    "summernote/summernote-bs4.css"
);
$scripts = array
(
    "summernote/summernote-bs4.js"
);

$stdTemplates -> getHTMLHeader($templateData['title'], $templateData['pages'], $templateData['currentPageKey'], $styleSheets, $scripts);

if ($templateData['error'] == "notfound")       // --------------------------------------------------------- ARTICLE DOES NOT EXIST --------------------------------------------------
{
    ?>
        <div class="container h-75">
            <h2 class="text-center p-4">Article not found</h2>
            <p class="text-center pb-5">There is no article with such ID. Please do not mess with URLs.</p>
        </div>
    <?php
}
else if ($templateData['error'] == "notallowed") // --------------------------------------------------------------- USER NOT ALLOWED TO REVIEW ------------------------------------------------
{
    ?>
    <div class="container h-75">
        <h2 class="text-center p-4">You are not allowed to review this article</h2>
        <p class="text-center pb-5">You have not been assigned as the article reviewer. Please do not mess with URLs.</p>
    </div>
    <?php
}
else if (is_null($templateData['error']))       // ------------------------------------------------------------------ USER ALLOWED TO REVIEW -----------------------------------------------------
{
    $article = $templateData['article'][0];
    ?>
    <div class="container w-75">
        <h2 class="text-center p-3">Article to review</h2>
        <h4 class="text-center pb-2"><?php echo $article['title']; ?></h4>
        <?php echo $article['text']; ?>
        <h4 class="text-center p-3">Images</h4>
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
        <h2 class="text-center pt-2 pb-1">Review to write</h2>
        <div>
            <form method="POST" id="reviewform" action="Actions/SubmitReviewAction.php">
                <div class="form-group">
                    <textarea id="summernote" form="reviewform" name="review_text" required>
                        Text here...
                    </textarea>
                    <small class="text-muted">The character limit is 50 characters, please be brief.</small>
                </div>
                <div class="form-group">
                    <label for="text_score">Text score</label>
                    <input type="number" max="10" min="0" name="text_score" class="form-control w-25" id="text_score" required>
                </div>
                <div class="form-group">
                    <label for="photo_score">Photos score</label>
                    <input type="number" max="10" min="0" name="photo_score" class="form-control w-25" id="photo_score" required>
                </div>
                <div class="form-group">
                    <label for="location_score">Location score</label>
                    <input type="number" max="10" min="0" name="location_score" class="form-control w-25" id="location_score" required>
                </div>
                <small class="text-muted">Score the article as <0, 10>. Any other score will be trimmed to fit this range.</small>
                <div class="form-group">
                    <button type="submit" class="btn btn-info" name="article_id_reviewer_number" value="<?php echo $_GET['id']."_".$templateData['reviewer_number'] ?>">Submit review</button>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function()                // -------------- Script to initialize the text editor --------------------------- //
            {
                $('#summernote').summernote({
                    height: 400,
                    minHeight: 400,
                    maxHeight: null,
                    focus: true,
                    toolbar: [
                        ['style', ['style']],                                    // The default toolbar without video, pictures and DnDrop
                        ['font', ['bold', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ],
                    fontNames: ['Helvetica', 'Arial'],
                    disableDragAndDrop: true,
                    codeviewFilter: true,           // XSS filtering
                    codeviewIframeFilter: true,
                    codeviewIframeWhitelistSrcBase: [],     // allow no iframes
                    callbacks:                                  // Function to stop characters at a given number from https://42coders.com/characters-count-in-summernote-wysiwyg stripped of character counter //
                        {                                       // which did not work unfortunately
                            onkeydown:function(e)
                            {
                                var charLimit = 50;
                                var t = e.currentTarget.innerText;
                                if (t.trim().length >= charLimit)
                                {
                                    if (e.key !== 8 && !(e.key >= 37 && e.key <= 40) && e.key !== 46 && !(e.key === 88 && e.ctrlKey) && !(e.key === 67 && e.ctrlKey))
                                    {
                                        e.preventDefault();
                                    }
                                }
                            },
                            onPaste: function(e)
                            {
                                var charLimit = 50;
                                var t = e.currentTarget.innerText;
                                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                                e.preventDefault();
                                var maxPaste = bufferText.length;
                                if (t.length + bufferText.length > charLimit)
                                {
                                    maxPaste = charLimit - t.length;
                                }
                                if (maxPaste > 0)
                                {
                                    document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                                }
                                $('#summernote').text(charLimit - t.length);
                            },
                            onKeyup: function(e)
                            {
                                var charLimit = 50;
		                        var t = e.currentTarget.innerText;
		                        $('#summernote').text(charLimit - t.trim().length);
	                        }
                        }
                });
            });
        </script>
    </div>
    <?php
}
?>



<?php
$stdTemplates -> getHTMLFooter();
?>