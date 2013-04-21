<?php
/**
Template Page for the gallery overview

Follow variables are useable :

    $gallery     : Contain all about the gallery
    $images      : Contain all images, path, title
    $pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<div class="gallery" id="<?php echo $gallery->anchor ?>">

<?php if ($gallery->show_slideshow) { ?>
    <!-- Slideshow link -->
    <div class="slideshowlink">
        <a class="slideshowlink" href="<?php echo $gallery->slideshow_link ?>">
            <?php echo $gallery->slideshow_link_text ?>
        </a>
    </div>
<?php } ?>

<?php if ($gallery->show_piclens) { ?>
    <!-- Piclense link -->
    <div class="piclenselink">
        <a class="piclenselink" href="<?php echo $gallery->piclens_link ?>">
            <?php _e('[View with PicLens]','nggallery'); ?>
        </a>
    </div>
<?php } ?>
        <div class="row-fluid">
            <ul class="thumbnails">
    <!-- Thumbnails -->
    <?php foreach ( $images as $image ) : ?>

            <li id="ngg-image-<?php echo $image->pid ?>" class="span6" <?php echo $image->style ?>>
                    <?php
                    $thumbCode = trim($image->thumbcode);
                    if (false !== strpos($thumbCode, 'class=')) {
                        $thumbCode = str_replace('class="', 'class="thumbnail ', $thumbCode);
                    } else {
                        $thumbCode .= ' class="thumbnail';
                    }
                    ?>
                    <a href="<?php echo $image->imageURL ?>" title="<?php echo $image->description ?>" <?php echo $thumbCode ?>>
                        <?php if (!$image->hidden) { ?>
                        <img title="<?php echo $image->alttext ?>" alt="<?php echo $image->alttext ?>" src="<?php echo $image->thumbnailURL ?>" <?php echo $image->size ?> />
                        <?php } ?>

                        <span class="caption">
                            <?php echo $image->caption ?>
                        </span>
                    </a>
            </li>

     <?php endforeach; ?>
            </ul>
        </div>

    <!-- Pagination -->
     <?php echo $pagination ?>

</div>

<?php endif;
