<?php
/** Template Name: Testing propose */

get_header();
?>

<div class="mt-8 ">
                <?php
                // Arguments for the WP Query
                $args = array(
                    'post_type'      => 'providers', // Custom post type name
                    'posts_per_page' => 8, // Number of posts to display
                    'order'          => 'ASC',
                    'orderby'        => 'date' ,
                    'meta_key'       => 'pro_price', // Meta key for the price
                    'orderby'        => 'meta_value_num', 
                    'meta_query'     => array(
                        array(
                            'key'     => 'pro_price', // Ensure only posts with a price are retrieved
                            'compare' => 'EXISTS',
                        ),
                    ),
                                );

                // Custom query to fetch posts
                $providers_query = new WP_Query($args);

                // The Loop
                if ($providers_query->have_posts()) :
                    while ($providers_query->have_posts()) : $providers_query->the_post();
                    get_template_part( 'template-parts/provider', 'card' );
                    endwhile;
                else :
                    echo '<p>No providers found.</p>';
                endif;

                // Reset post data to avoid conflicts
                wp_reset_postdata();
                ?>

            </div>
        </div>


<?php
get_footer();  ?>