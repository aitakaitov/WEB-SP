<?php
require_once(VIEWS_DIR."/StandardTemplates.php");

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

if (isset($_GET['success']) && !empty($_GET['success']) && $_GET['success'] == "true")
{
    ?>
    <div class="container h-75">
        <h3 class="text-center">Article has been submitted for review.</h3>
        <p class="text-center pb-3">The article will have reviewers assigned and when the process is done, it will be visible on the main page.</p>
    </div>
    <?php
}
else
    {
?>

<div class="container h-75">
    <h3 class="text-center p-3">New Article</h3>
    <form method="POST" id="articleform" action="Actions/SubmitArticleAction.php" enctype="multipart/form-data">
        <div class="form-group">
            <div class="w-50">
                <label for="title">Title:</label>
                <input type="text" name="title" maxlength="49" id="title" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <textarea id="summernote" form="articleform" name="article_text" required>
                Text here...
            </textarea>
        </div>
        <div class="d-flex flex-column">
            <div class="mb-1">
                <input type="file" name="images[]" form="articleform" class="form-control-file" multiple>
            </div>
            <div class="mb-2">
                <small class="text-muted">Upload a maximum of 5 images. Rest of the images will be discarded. The first image will be used as article header. Allowed extensions are JPG, JPEG and PNG. Invalid files will be skipped.</small>
                <br><small class="text-muted">The article cannot be edited after submission, so please double check everything.</small>
            </div>
            <div class="mb-2">
                <button class="btn btn-info" type="submit" form="articleform">Submit for review</button>
            </div>
        </div>
    </form>


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
                callbacks:                                  // Function to stop characters at a given number
                    {
                        callbacks:                                  // Function to stop characters at a given number from https://42coders.com/characters-count-in-summernote-wysiwyg stripped of character counter //
                            {                                       // Which did not work unfortunately
                                onkeydown:function(e)
                                {
                                    var charLimit = 2500;
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
                                    var charLimit = 2500;
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
                                    var charLimit = 2500;
                                    var t = e.currentTarget.innerText;
                                    $('#summernote').text(charLimit - t.trim().length);
                                }
                            }
                    }
            });
        });
    </script>
</div>


<?php
    }
$stdTemplates -> getHTMLFooter();
?>
