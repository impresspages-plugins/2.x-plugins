<div class="ipPluginSimpleSlideshowImages">
    <?php foreach ($images as $imageKey => $image) { ?>
        <div><img alt="<?php echo $this->esc($image['title']) ?>" src="<?php echo BASE_URL.IMAGE_DIR.$this->esc($image['image']) ?>" /></div>
    <?php } ?>
</div>
<div class="ipPluginSimpleSlideshowTabs">
    <?php foreach ($images as $imageKey => $image) { ?>
        <a href="#"></a>
    <?php } ?>
</div>
