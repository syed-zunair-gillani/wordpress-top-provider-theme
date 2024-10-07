<?php

// Check if the current URL matches the required pattern
if (get_query_var('service') && get_query_var('zone_state') && get_query_var('zone_city') && get_query_var('p')) {
    // Display content for the full URL structure /internet/zone_state/zone_city/zipcode/
    $service = get_query_var('service');
    $zone_state = get_query_var('zone_state');
    $zone_city = get_query_var('zone_city');
    $zipcode = get_query_var('p');

    echo "<h1>Service: $service</h1>";
    echo "<h2>Zone State: $zone_state</h2>";
    echo "<h3>Zone City: $zone_city</h3>";
    echo "<h4>Zipcode: $zipcode</h4>";

    

    // Display custom content based on the query variables
} else {
    echo "<p>No matching template found.</p>";
}

get_footer(); // Load the footer
