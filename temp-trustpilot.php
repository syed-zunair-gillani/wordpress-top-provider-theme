<?php
/** Template Name: Trust Reviews */

get_header();
?>

<section class="py-24 bg-[#6041BB]">
    <div class="container mx-auto px-4">
        <h1 class="sm:text-5xl text-4xl leading-normal font-semibold text-white text-center">Privacy Policy</h1>
    </div>
</section>

<section class="py-16">
<div class="container mx-auto px-4">

<div>
            <h3 class="text-3xl font-semibold mb-10">Featured Providers</h3>
            <div class="mt-8 grid grid-cols-1 sm:!grid-cols-2 gap-8 md:!grid-cols-4 text-center">
                <?php
                // Arguments for the WP Query
                $args = array(
                    'post_type'      => 'providers', // Custom post type name
                    'posts_per_page' => 4, // Number of posts to display
                    'order'          => 'DESC', // Order of the posts
                    'orderby'        => 'date' // Order by date
                );

                // Custom query to fetch posts
                $providers_query = new WP_Query($args);

                // The Loop
                if ($providers_query->have_posts()) :
                    while ($providers_query->have_posts()) : $providers_query->the_post();
                        get_template_part('template-parts/box', 'provider');
                    endwhile;
                else :
                    echo '<p>No providers found.</p>';
                endif;

                // Reset post data to avoid conflicts
                wp_reset_postdata();
                ?>

            </div>
        </div>

</div>
   
</section>





                                            


<?php get_footer(); ?>
