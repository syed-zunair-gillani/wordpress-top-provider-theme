<?php



include_once('cpts.php');
include_once('rules.php');

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



