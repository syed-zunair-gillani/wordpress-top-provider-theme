<?php

function custom_sitemap() {
    // Check if the request is for the sitemap index
    if (isset($_GET['sitemap']) && $_GET['sitemap'] === 'index') {
        sitemap_index();
        exit;
    }
    
    // Handle individual sitemap requests
    if (strpos($_SERVER['REQUEST_URI'], '/sitemap-posts.xml') !== false) {
        sitemap_posts();
        exit;
    }
    
    if (strpos($_SERVER['REQUEST_URI'], '/sitemap-zone-state.xml') !== false) {
        sitemap_zone_state();
        exit;
    }

    // Redirect to sitemap index if /sitemap.xml is accessed
    if (strpos($_SERVER['REQUEST_URI'], '/sitemap.xml') !== false) {
        header("Location: " . home_url('/?sitemap=index'), true, 302);
        exit;
    }
}

// Generate the sitemap for posts
function sitemap_posts() {
    header("Content-Type: application/xml; charset=utf-8");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap-image/1.1">';

    // Fetch the latest 10 posts
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => 10,
        'post_status' => 'publish'
    );
    $posts = get_posts($args);

    foreach ($posts as $post) {
        setup_postdata($post);
        echo '<url>';
        echo '<loc>' . esc_url(get_permalink($post)) . '</loc>';
        echo '<lastmod>' . get_the_modified_time('c', $post) . '</lastmod>';
        echo '<changefreq>weekly</changefreq>';
        echo '<priority>0.5</priority>';
        echo '</url>';
    }

    wp_reset_postdata();
    echo '</urlset>';
}

// Generate the sitemap for zone states
function sitemap_zone_state() {
    header("Content-Type: application/xml; charset=utf-8");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap-image/1.1">';

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
                echo '<url>';
                echo '<loc>' . esc_url(home_url($type . '/' . esc_html($term->slug))) . '</loc>';
                echo '<lastmod>' . date('c', strtotime($term->term_modified)) . '</lastmod>'; // Use term_modified for actual modified date
                echo '<changefreq>weekly</changefreq>';
                echo '<priority>0.5</priority>';
                echo '</url>';
            }
        }
    }

    echo '</urlset>';
}

// Generate the sitemap index
function sitemap_index() {
    header("Content-Type: application/xml; charset=utf-8");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap-image/1.1">';
    
    // Add links to the individual sitemap files
    echo '<sitemap>';
    echo '<loc>' . esc_url(home_url('/sitemap-posts.xml')) . '</loc>';
    echo '<lastmod>' . date('c') . '</lastmod>'; // Last modified date
    echo '</sitemap>';

    echo '<sitemap>';
    echo '<loc>' . esc_url(home_url('/sitemap-zone-state.xml')) . '</loc>';
    echo '<lastmod>' . date('c') . '</lastmod>'; // Last modified date
    echo '</sitemap>';

    echo '</sitemapindex>';
}

// Hook into WordPress
add_action('init', 'custom_sitemap');