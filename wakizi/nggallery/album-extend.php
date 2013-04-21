<?php
/**
Template Page for the album overview (extended)

Follow variables are useable :

    $album     	 : Contain information about the album
    $galleries   : Contain all galleries inside this album
    $pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($galleries)) : ?>

<div class="album">
    <!-- List of galleries -->
    <?php foreach ($galleries as $gallery) : ?>

    <div class="row-fluid">
        <div class="span4">
                    <a class="thumbnail" href="<?php echo $gallery->pagelink ?>"><img alt="<?php echo $gallery->title ?>" src="<?php echo $gallery->previewurl ?>"/></a>
                </div>
                <div class="span6">
                    <h2><a href="<?php echo $gallery->pagelink ?>"><?php echo $gallery->title ?></a></h2>
                <?php if (!empty($gallery->galdesc)): ?>
                    <p><?php echo $gallery->galdesc ?></p>
                <?php endif; ?>

                <?php if ($gallery->counter > 0) : ?>
                    <p><strong><?php echo $gallery->counter ?></strong> <?php _e('Photos', 'nggallery') ?></p>
                <?php endif; ?>

                </div>
    </div>

     <?php endforeach; ?>

    <!-- Pagination -->
     <?php echo $pagination ?>

</div>

<?php endif;
