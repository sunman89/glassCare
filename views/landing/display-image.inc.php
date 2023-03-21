<div class="container-fluid pl-3 pr-3 mt-2 mb-0">
    <div class="row">
        <div class="col-12">
            <div class="widget-container p-2 mb-3">
                <a href="landing.php"><button type="button" class="btn btn-warning">Go back to landing page</button></a>
            </div>
            <div class="widget-container p-2">
                <?php if($image):?>
                    <h4 class="p-1 text-left">Image Text: <?=$image['image_text'];?></h4>
                    <div class="image-container">
                        <img src="<?=$image['image_link'];?>" style="height:auto;max-width:100%;">
                    </div>
                <?php else:?>
                    No image to display.
                <?php endif;?>
            </div>
        </div>
    </div>
</div>