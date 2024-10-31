<?php

//SiteMapByState(); Sitemap for States
function SiteMapByState() {
    $sitemap_folder = ABSPATH . 'sitemaps';
    $sitemap_file = $sitemap_folder . '/states-sitemap.xml';
    if (!file_exists($sitemap_folder)) {
        mkdir($sitemap_folder, 0755, true);
    }
    $file = fopen($sitemap_file, 'w');
    // XML header
    $xml_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $xml_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
    // Types to iterate
    $types = ["internet", "tv", "tv-internet", "landline"];    
    foreach ($types as $type) {
     
        $terms = get_terms(array(
            'taxonomy'   => 'zone_state',
            'hide_empty' => false,
            'posts_per_page' => -1,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $xml_content .= '<url>' . PHP_EOL;
                $xml_content .= '<loc>' . esc_url(home_url($type . '/' . $term->slug)) . '</loc>' . PHP_EOL;
                $xml_content .= '<lastmod>' . wp_date('c') . '</lastmod>' . PHP_EOL; // Using wp_date for current date in ISO 8601 format
                $xml_content .= '<priority>0.8</priority>' . PHP_EOL; // Setting priority to 0.8
                $xml_content .= '</url>' . PHP_EOL;
            }
        }
    }
    $xml_content .= '</urlset>' . PHP_EOL;
    fwrite($file, $xml_content);
    fclose($file);
}


//SiteMapByZipCity(); Sitemap for Cities

function SiteMapByZipCity() {

    set_time_limit(0);
    // Define the services and sitemap folder path
    $services = ['internet', 'tv', 'home-security', 'home-phone'];
    $sitemap_folder = ABSPATH . 'sitemaps';
    $posts_per_file = 10000;

    // Ensure the sitemap directory exists
    if (!file_exists($sitemap_folder)) {
        mkdir($sitemap_folder, 0755, true);
    }

    // Loop through each service to create separate sitemaps
    foreach ($services as $service) {
        $file_index = 1;
        $offset = 0;
        
        while (true) {
            // Define the file name for each batch of posts
            $sitemap_file = "{$sitemap_folder}/cities_{$service}-{$file_index}.xml";
            
            // Open file for writing
            $file = fopen($sitemap_file, 'w');
            
            // XML header
            $xml_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

            // WP Query arguments with pagination
            $args = array(
                'post_type'      => 'area_zone',
                'posts_per_page' => $posts_per_file,
                'offset'         => $offset,
                'order'          => 'DESC',
            );

            // Custom query to fetch posts
            $providers_query = new WP_Query($args);

            // Check if there are posts
            if (!$providers_query->have_posts()) {
                // If no posts left, break the loop
                fclose($file);
                break;
            }

            // Loop for each post in area_zone
            while ($providers_query->have_posts()) {
                $providers_query->the_post();
                
                // Get terms for zone_city and zone_state
                $zone_city_terms = get_the_terms(get_the_ID(), 'zone_city');
                $zone_state_terms = get_the_terms(get_the_ID(), 'zone_state');

                // Extract the first term slug
                $zone_city = $zone_city_terms && !is_wp_error($zone_city_terms) ? $zone_city_terms[0]->slug : '';
                $zone_state = $zone_state_terms && !is_wp_error($zone_state_terms) ? $zone_state_terms[0]->slug : '';

                // Construct the URL
                $link = home_url("/{$service}/{$zone_state}/{$zone_city}/");

                // Add URL entry to the XML content
                $xml_content .= "<url>" . PHP_EOL;
                $xml_content .= "<loc>" . esc_url($link) . "</loc>" . PHP_EOL;
                $xml_content .= "<lastmod>" . wp_date('c') . "</lastmod>" . PHP_EOL;
                $xml_content .= "<changefreq>monthly</changefreq>" . PHP_EOL;
                $xml_content .= "<priority>0.8</priority>" . PHP_EOL;
                $xml_content .= "</url>" . PHP_EOL;
            }

            // Reset post data after each query
            wp_reset_postdata();

            // Close XML structure
            $xml_content .= '</urlset>' . PHP_EOL;

            // Write XML content to the file and close it
            fwrite($file, $xml_content);
            fclose($file);

            echo 'Sitemap for ' . esc_html($service) . " generated and saved as " . esc_html($sitemap_file) . '<br>';

            // Update offset and file index for the next file
            $offset += $posts_per_file;
            $file_index++;
        }
    }
}

//SiteMapByZipCode(); Sitemap for ZipCode
function SiteMapByZipCode() {

    set_time_limit(0);
    // Define the services and sitemap folder path
    $services = ['internet', 'tv', 'home-security', 'home-phone'];
    $sitemap_folder = ABSPATH . 'sitemaps';
    $posts_per_file = 10000;

    // Ensure the sitemap directory exists
    if (!file_exists($sitemap_folder)) {
        mkdir($sitemap_folder, 0755, true);
    }

    // Loop through each service to create separate sitemaps
    foreach ($services as $service) {
        $file_index = 1;
        $offset = 0;
        
        while (true) {
            // Define the file name for each batch of posts
            $sitemap_file = "{$sitemap_folder}/zipcode_{$service}-{$file_index}.xml";
            
            // Open file for writing
            $file = fopen($sitemap_file, 'w');
            
            // XML header
            $xml_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

            // WP Query arguments with pagination
            $args = array(
                'post_type'      => 'area_zone',
                'posts_per_page' => $posts_per_file,
                'offset'         => $offset,
                'order'          => 'DESC',
            );

            // Custom query to fetch posts
            $providers_query = new WP_Query($args);

            // Check if there are posts
            if (!$providers_query->have_posts()) {
                // If no posts left, break the loop
                fclose($file);
                break;
            }

            // Loop for each post in area_zone
            while ($providers_query->have_posts()) {
                $providers_query->the_post();
                $post_slug = get_post_field('post_name', get_the_ID());
                
                // Get terms for zone_city and zone_state
                $zone_city_terms = get_the_terms(get_the_ID(), 'zone_city');
                $zone_state_terms = get_the_terms(get_the_ID(), 'zone_state');

                // Extract the first term slug
                $zone_city = $zone_city_terms && !is_wp_error($zone_city_terms) ? $zone_city_terms[0]->slug : '';
                $zone_state = $zone_state_terms && !is_wp_error($zone_state_terms) ? $zone_state_terms[0]->slug : '';

                // Construct the URL
                $link = home_url("/{$service}/{$zone_state}/{$zone_city}/{$post_slug}");

                // Add URL entry to the XML content
                $xml_content .= "<url>" . PHP_EOL;
                $xml_content .= "<loc>" . esc_url($link) . "</loc>" . PHP_EOL;
                $xml_content .= "<lastmod>" . wp_date('c') . "</lastmod>" . PHP_EOL;
                $xml_content .= "<changefreq>monthly</changefreq>" . PHP_EOL;
                $xml_content .= "<priority>0.8</priority>" . PHP_EOL;
                $xml_content .= "</url>" . PHP_EOL;
            }

            // Reset post data after each query
            wp_reset_postdata();

            // Close XML structure
            $xml_content .= '</urlset>' . PHP_EOL;

            // Write XML content to the file and close it
            fwrite($file, $xml_content);
            fclose($file);

            echo 'Sitemap for ' . esc_html($service) . " generated and saved as " . esc_html($sitemap_file) . '<br>';

            // Update offset and file index for the next file
            $offset += $posts_per_file;
            $file_index++;
        }
    }
}

add_filter('wpseo_sitemap_index', function ($sitemap_index) {
    $base_url = 'https://dev.cblproject.cablemovers.net/sitemaps/';
    $types = ["internet", "tv", "tv-internet", "landline"];
    $number_of_sitemaps = 6; // Generate 6 sitemaps for each type
    $prefixes = ['zipcode', 'cities']; // Define prefixes to loop through
    $current_date = gmdate('Y-m-d H:i +00:00');

    foreach ($prefixes as $prefix) {
        foreach ($types as $type) {
            for ($i = 1; $i <= $number_of_sitemaps; $i++) {
                $sitemap_url = $base_url . $prefix . '_' . $type . '-' . $i . '.xml';
                $sitemap_index .= '<sitemap><loc>' . esc_url($sitemap_url) . '</loc><lastmod>' . esc_html($current_date) . '</lastmod></sitemap>';
            }
        }
    }

    // Add the static sitemap with modification date
    $static_sitemap_url = $base_url . 'states-sitemap.xml';
    $sitemap_index .= '<sitemap><loc>' . esc_url($static_sitemap_url) . '</loc><lastmod>' . esc_html($current_date) . '</lastmod></sitemap>';

    return $sitemap_index;
});
