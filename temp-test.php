<?php
/** Template Name: Testing propose */
 get_header();



 $args = array(
    'post_type'      => 'area_zone',
    'posts_per_page' => 1000,
    'offset'         => 0,
    'order'          => 'DESC',
);

$providers_query = new WP_Query($args);


$unique_zones = [];

while ($providers_query->have_posts()) {
    $providers_query->the_post();
    $zone_city_terms = get_the_terms(get_the_ID(), 'zone_city');
    $zone_state_terms = get_the_terms(get_the_ID(), 'zone_state');
    $zone_city = $zone_city_terms && !is_wp_error($zone_city_terms) ? $zone_city_terms[0]->slug : '';
    $zone_state = $zone_state_terms && !is_wp_error($zone_state_terms) ? $zone_state_terms[0]->slug : '';

    // Create a unique key for each city-state combination
    $zone_key = "{$zone_state}_{$zone_city}";

    // Skip if this city-state combination has already been added
    if (empty($zone_city) || empty($zone_state) || isset($unique_zones[$zone_key])) {
        continue;
    }

    // Add the city-state combination to the unique tracking array
    $unique_zones[$zone_key] = true;

    // Generate the URL
    $link = home_url("/{$service}/{$zone_state}/{$zone_city}/");
    echo $link."<br/>";

  
}

wp_reset_postdata();


?>