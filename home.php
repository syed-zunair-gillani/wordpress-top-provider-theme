<?php /** Template Name: Home */ get_header();

?>




<?php query_posts(array(
    'post_type' => 'providers',
    'posts_per_page' => -1,
    'order' => 'asc'

));
if (have_posts()):
    while (have_posts()):
        the_post();

        $price = get_post_meta(get_the_ID(), 'services_info_tv_services_price', true);
        ?>
        <h2> <?php the_title() ?></h2>

        <p> <?php

        echo $price;

        ?></p>

    <?php endwhile;
    wp_reset_query();
else: ?>
    <h2><?php _e('Nothing Found', 'lbt_translate'); ?></h2>
<?php endif; ?>





<?php get_footer() ?>