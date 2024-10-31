<?php
/** Template Name: Testing propose */
 get_header();
?>




<!-- ===================== *********** ======================
        Sitemap Layout for /type/state/city/zipcode 
===================== *********** ====================== -->

<?php
    // Arguments for the WP Query
    $args = array(
        'post_type'      => 'area_zone', // Custom post type name
        'posts_per_page' => 1, // Number of posts to display
        'order'          => 'DESC', // Order of the posts
    );

    // Custom query to fetch posts
    $providers_query = new WP_Query($args);
    // Set the header for XML output

        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
    ?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    // The Loop
    if ($providers_query->have_posts()) :
        $services = ['internet', 'tv', 'home-security', 'home-phone'];
        foreach ($services as $service) {
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
                $link = home_url("/{$service}/{$zone_state}/{$zone_city}/{$post_slug}");

                // Print the URL entry in the sitemap
                echo "<url>";
                echo "<loc>" . esc_url($link) . "</loc>";
                echo "<lastmod>" . get_the_modified_time('c') . "</lastmod>";
                echo "<changefreq>monthly</changefreq>";
                echo "<priority>0.8</priority>";
                echo "</url>";
                echo "<br/><hr/>";
            endwhile;
        }
    else :
        echo '<url><loc>No providers found.</loc></url>';
    endif;
    // Reset post data to avoid conflicts
    wp_reset_postdata();
?>
</urlset>





<!-- ===================== *********** ======================
        Sitemap Layout for /type/state/city/ 
===================== *********** ====================== -->

<?php
    // Arguments for the WP Query
    $args = array(
        'post_type'      => 'area_zone', // Custom post type name
        'posts_per_page' => 1, // Number of posts to display
        'order'          => 'DESC', // Order of the posts
    );

    // Custom query to fetch posts
    $providers_query = new WP_Query($args);
    // Set the header for XML output
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
    ?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    // The Loop
    if ($providers_query->have_posts()) :
        $services = ['internet', 'tv', 'home-security', 'home-phone'];
        foreach ($services as $service) {
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
                $link = home_url("/{$service}/{$zone_state}/{$zone_city}/");

                // Print the URL entry in the sitemap
                echo "<url>";
                echo "<loc>" . esc_url($link) . "</loc>";
                echo "<lastmod>" . get_the_modified_time('c') . "</lastmod>";
                echo "<changefreq>monthly</changefreq>";
                echo "<priority>0.8</priority>";
                echo "</url>";
                echo "<br/><hr/>";
            endwhile;
        }
    else :
        echo '<url><loc>No providers found.</loc></url>';
    endif;
    // Reset post data to avoid conflicts
    wp_reset_postdata();
?>
</urlset>




<!-- ===================== *********** ======================
        Sitemap Layout for /type/state/ 
===================== *********** ====================== -->

<?php
    $types = ["internet", "tv", "tv-internet", "landline"];
    foreach ($types as $type) {
        $terms = get_terms(array(
            'taxonomy'   => 'zone_state',
            'hide_empty' => false, // Set to true if you want to hide empty terms
            'posts_per_page' => -1,
        ));
        // Check if terms were found
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                echo '<loc>' . esc_url(home_url($type . '/' . esc_html($term->slug))) . '</loc>';
                echo '<lastmod>' . date('c', strtotime($term->term_modified)) . '</lastmod>'; 
                echo '<priority>0.5</priority>';
                echo "<br/><hr/>";
            }
        }
    }
?>