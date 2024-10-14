<?php



include_once('cpts.php');
include_once('rules.php');

function check_header() {
    // Define the zip code you want to search for
	$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	// Parse the URL to get the path component
	$parsed_url = parse_url($current_url);
	// Break down the path into segments
	$path = trim($parsed_url['path'], '/');
	$segments = explode('/', $path);
	// Extract the required parts
	
	if (in_array($_SERVER['SERVER_NAME'], ['127.0.0.1', 'localhost', '::1'])) {
		$type = isset($segments[1]) ? $segments[1] : 'internet';     
		$state = isset($segments[2]) ? $segments[2] : null;     
		$city = isset($segments[3]) ? $segments[3] : null;     
		$zipcode = isset($segments[4]) ? $segments[4] : null;
	} else {
		$type = isset($segments[0]) ? $segments[0] : 'internet'; 
		$state = isset($segments[1]) ? $segments[1] : null;     
		$city = isset($segments[2]) ? $segments[2] : null;   
		$zipcode = isset($segments[3]) ? $segments[3] : null;
	}
	
	set_query_var('state', $state);
	set_query_var('city', $city);
	set_query_var('zipcode', $zipcode);
	set_query_var('type', $type);
}



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


function cbl_theme_setup() {
	
	load_theme_textdomain( 'cbl_theme', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'main' => esc_html__( 'Main', 'cbl_theme' ),
			'footer' => esc_html__( 'Footer', 'cbl_theme' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);


}
add_action( 'after_setup_theme', 'cbl_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cbl_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cbl_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'cbl_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cbl_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cbl_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cbl_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cbl_theme_widgets_init' );

function handle_search_providers_ajax() {
    // Check if the necessary parameters are provided
    if (isset($_POST['zip_code']) && isset($_POST['type'])) {
        $zip_code = sanitize_text_field($_POST['zip_code']);
        $type = sanitize_text_field($_POST['type']);

        // Your custom query to get providers based on zip code and selected option
        // Create a new query to search 'area_zone' posts by title
		$args = array(
			'post_type' => 'area_zone',
			'posts_per_page' => -1, // Get all posts
			'post_status' => 'publish', // Only published posts
			's' => $zip_code, // Search term
		);

        $query = new WP_Query($args);

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				// Get the terms for 'zone_city' and 'zone_state' taxonomies
				$zone_city_terms = wp_get_post_terms(get_the_ID(), 'zone_city', array('fields' => 'slugs'));
				$zone_state_terms = wp_get_post_terms(get_the_ID(), 'zone_state', array('fields' => 'slugs'));
			
				$zone_city = !empty($zone_city_terms) ? $zone_city_terms[0] : 'no-city';
				$zone_state = !empty($zone_state_terms) ? $zone_state_terms[0] : 'no-state';

				$custom_slug = $type .'/'.$zone_state . '/' . $zone_city. '/' . $zip_code;
				
				$response[] = array(
					'slug' => home_url($custom_slug),
				);
			}
		}  else {
			$response['message'] = 'No area zones found matching your search criteria.';
		}
		wp_send_json($response);
		// Reset the post data to the main query
		wp_reset_postdata();
    }

    // End the function
    wp_die();
}

// Register the AJAX actions for both logged-in and non-logged-in users
add_action('wp_ajax_search_providers', 'handle_search_providers_ajax');
add_action('wp_ajax_nopriv_search_providers', 'handle_search_providers_ajax');




function enqueue_custom_ajax_search_script() {
    wp_enqueue_script('ajax-search', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
    wp_localize_script('ajax-search', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_ajax_search_script');



function get_zipcodes_by_city($city) {
    $post_zipcodes = array(); 
	$posts = get_posts(array(
        'post_type' => 'area_zone',
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_city',
                'field'    => 'slug',
                'terms'    => $city, 
            ),
        ),
        'posts_per_page' => -1, 
    ));
    foreach ($posts as $post) {
        $post_zipcodes[] = $post->post_title; 
    }
    return $post_zipcodes;
}


function get_zipcodes_by_state($state) {
    $post_zipcodes = array(); 
	$posts = get_posts(array(
        'post_type' => 'area_zone',
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_state',
                'field'    => 'slug',
                'terms'    => $state, 
            ),
        ),
        'posts_per_page' => -1, 
    ));
    foreach ($posts as $post) {
        $post_zipcodes[] = $post->post_title; 
    }
    return $post_zipcodes;
}



// function create_meta_query_for_zipcodes($zip_codes_to_search) {
//     $meta_queries = array('relation' => 'OR');
// 	foreach ($zip_codes_to_search as $zip_code) {
//         $meta_queries[] = array(
//             'key'     => 'internet_services',
//             'value'   => serialize($zip_code),
//             'compare' => 'LIKE',
//         );
//     }
//     $args = array(
//         'post_type'      => 'providers', 
//         'posts_per_page' => -1,          
//         'meta_query'     => $meta_queries,
//     );
//     return $args;
// }



function create_meta_query_for_zipcodes($zip_codes_to_search, $type) {
    $meta_queries = array('relation' => 'OR');
    // Build the meta queries based on zip codes
    foreach ($zip_codes_to_search as $zip_code) {
        $meta_queries[] = array(
            'key'     => 'internet_services',
            'value'   => serialize($zip_code),
            'compare' => 'LIKE',
        );
    }

    // Build the arguments for the query
    $args = array(
        'post_type'      => 'providers', 
        'posts_per_page' => -1,
        'meta_query'     => $meta_queries,
        'tax_query' => array(
            array(
                'taxonomy' => 'providers_types',
                'field'    => 'slug',
                'terms'    => $type,
            ),
        ),
    );

    return $args;
}


function short_providers_with_price($zip_codes_to_search, $type) {
    $meta_queries = array('relation' => 'OR');

    // Build the meta queries based on zip codes
    foreach ($zip_codes_to_search as $zip_code) {
        $meta_queries[] = array(
            'key'     => 'internet_services',
            'value'   => serialize($zip_code),
            'compare' => 'LIKE',
        );
    }

    // Build the arguments for the query
    $args = array(
        'post_type'      => 'providers',
        'posts_per_page' => -1,
        'meta_query'     => $meta_queries,
        'tax_query' => array(
            array(
                'taxonomy' => 'providers_types',
                'field'    => 'slug',
                'terms'    => $type,
            ),
        ),
        'meta_key' => 'pro_price', // Specify the meta key for sorting
        'orderby'  => 'ID', // Sort by numeric value
        'order'    => 'ASC', // Order from lowest to highest
    );

    return $args;
}

