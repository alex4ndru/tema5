<link rel="stylesheet" type="text/css" href="css.css">

<div class="main">
    <div class="apiAddress"><a href="<?php echo $page->apiAddress ?>" target="_blank"><?php echo $page->apiAddress ?>"</a></div>
    <div class="contentTop">
        <?php echo $page->contentTop ?>
        <div class="clearFix"></div>
    </div>
    <div class="results" <?php echo $page->resultsFieldHidden ?> ></div>
    <div class="results extra" <?php echo $page->imgFieldHidden ?> ><?php  ?></div>
    <div class="myClear"></div>
</div>