
  
        <div class="slide-item">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full'); ?>
                <?php endif; ?>
                <h2 class="mt-4 text-lg text-center"><?php the_title(); ?></h2>
            </a>
        </div>
 
