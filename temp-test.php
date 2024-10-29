<?php
/** Template Name: Testing propose */

// get_header();





// Fetch terms from the 'zone_state' taxonomy
$types = ["internet", "tv", "tv-internet", "landline"];
foreach ($types as $type) {
    $terms = get_terms(array(
        'taxonomy'   => 'zone_state',
        'hide_empty' => false, // Set to true if you want to hide empty terms
        'posts_per_page' => -1,
    ));
    echo "<pre>";
    // Check if terms were found
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $term_details = get_term($term->term_id, 'zone_state');
            // Get the modified date as a Unix timestamp
            $modified_date = $term_details->term_modified;

            // Convert the modified date to ISO 8601 format
            $modified_date_iso = date('Y-m-d\TH:i:sP', strtotime($modified_date)); // 'Y-m-d\TH:i:sP' gives ISO 8601 format with timezone

            // Output the term name and modified date
            echo '<p>' . esc_html($term->name) . ' (ID: ' . esc_html($term->term_id) . ') - Modified on: ' . esc_html($modified_date_iso) . '</p>';
        }
    } else {
        echo '<p>No terms found for this taxonomy.</p>';
    }
}












// get_footer();  ?>