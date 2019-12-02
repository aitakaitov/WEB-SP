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
                disableDragAndDrop: true
            });
        });
    </script>
</div>


<?php
$stdTemplates -> getHTMLFooter();
?>
