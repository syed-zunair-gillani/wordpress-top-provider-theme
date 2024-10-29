<?php
/** Template Name: Testing propose */

 get_header();

?>



<?php
         // Arguments for the WP Query
$args = array(
    'post_type'      => 'area_zone', // Custom post type name
    'posts_per_page' => 10000, // Number of posts to display
    'order'          => 'DESC', // Order of the posts
);

// Custom query to fetch posts
$providers_query = new WP_Query($args);

// The Loop
if ($providers_query->have_posts()) :
    while ($providers_query->have_posts()) : $providers_query->the_post();
        // Get the terms for zone_city and zone_state
        $zone_city_terms = get_the_terms(get_the_ID(), 'zone_city');
        $zone_state_terms = get_the_terms(get_the_ID(), 'zone_state');

        // Extract the first term slug (if multiple terms exist, you can decide if you want all or just the first)
        $zone_city = $zone_city_terms && !is_wp_error($zone_city_terms) ? $zone_city_terms[0]->slug : '';
        $zone_state = $zone_state_terms && !is_wp_error($zone_state_terms) ? $zone_state_terms[0]->slug : '';

        // Get the post slug
        $post_slug = get_post_field('post_name', get_the_ID());

        // Construct the URL
        $link = home_url("/{$zone_state}/{$zone_city}/{$post_slug}");

        // Print the title as a link along with city and state
        echo  $link;
       
        echo "<hr>";
    endwhile;
else :
    echo '<p>No providers found.</p>';
endif;

// Reset post data to avoid conflicts
wp_reset_postdata();

                 get_footer();  ?>