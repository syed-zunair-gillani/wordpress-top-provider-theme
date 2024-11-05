<div class="">
  <a href="<?php the_permalink() ?>" class="">
    <?php if (has_post_thumbnail()) {
      ?>
       <figure style="max-width:144px; max-height:144px;">
          <?php the_post_thumbnail('full') ?>
        </figure>
      <?php
    } else { ?>
      <figure class="max-w-[144px] max-h-[144px]">
        <img src="<?php bloginfo('template_directory'); ?>/images/img5.jpg" alt="<?php the_title() ?>" class="w-[144px]" />
      </figure>
    <?php } ?>
    <h2 class="mt-4 text-lg text-center"><?php the_title() ?></h2>
  </a>
</div>