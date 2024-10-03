<?php
/**
 * CBL_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CBL_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cbl_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on CBL_Theme, use a find and replace
		* to change 'cbl_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'cbl_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'cbl_theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'cbl_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
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


function cptui_register_my_cpts() {

	/**
	 * Post Type: Zones.
	 */

	$labels = [
		"name" => esc_html__( "Zones", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Zone", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Zones", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "area_zone", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => true,
		"graphql_single_name" => "Zone",
		"graphql_plural_name" => "Zones",
	];

	register_post_type( "area_zone", $args );

	/**
	 * Post Type: Providers.
	 */

	$labels = [
		"name" => esc_html__( "Providers", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Provider", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Providers", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "providers", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => true,
		"graphql_single_name" => "SingleProvider",
		"graphql_plural_name" => "AllProviders",
	];

	register_post_type( "providers", $args );
}


function cptui_register_my_taxes_providers_types() {

	/**
	 * Taxonomy: Types.
	 */

	$labels = [
		"name" => esc_html__( "Types", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Type", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Types", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'providers_types', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "providers_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => true,
		"graphql_single_name" => "ProviderType",
		"graphql_plural_name" => "ProviderTypes",
	];
	register_taxonomy( "providers_types", [ "providers" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_providers_types' );


function cptui_register_my_taxes_providers_service_types() {

	/**
	 * Taxonomy: Services Type.
	 */

	$labels = [
		"name" => esc_html__( "Services", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Service", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Services", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'providers_service_types', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "providers_service_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => true,
		"graphql_single_name" => "ServiceType",
		"graphql_plural_name" => "ServiceTypes",
	];
	register_taxonomy( "providers_service_types", [ "providers" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_providers_service_types' );

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_cpts_area_zone() {

	/**
	 * Post Type: Zones.
	 */

	$labels = [
		"name" => esc_html__( "Zones", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Zone", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Zones", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "area_zone", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => true,
		"graphql_single_name" => "Zone",
		"graphql_plural_name" => "Zones",
	];

	register_post_type( "area_zone", $args );
}

add_action( 'init', 'cptui_register_my_cpts_area_zone' );


function cptui_register_my_taxes() {

	/**
	 * Taxonomy: City.
	 */

	$labels = [
		"name" => esc_html__( "City", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "City", "custom-post-type-ui" ),
	];	
	$args = [
		"label" => esc_html__( "City", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'zone_city', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "zone_city",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => true,
		"graphql_single_name" => "City",
		"graphql_plural_name" => "Cities",
	];
	register_taxonomy( "zone_city", [ "area_zone" ], $args );	

	/**
	 * Taxonomy: State.
	 */

	$labels = [
		"name" => esc_html__( "States Code", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "State Code", "custom-post-type-ui" ),
	];
	
	$args = [
		"label" => esc_html__( "State", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'zone_state', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "zone_state",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => true,
		"graphql_single_name" => "State",
		"graphql_plural_name" => "States",
	];
	register_taxonomy( "zone_state", [ "area_zone" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );

function cptui_register_my_taxes_zone_name() {

	/**
	 * Taxonomy: States.
	 */

	$labels = [
		"name" => esc_html__( "State Names", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "State Name", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "States", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'zone_name', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "zone_name",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => true,
		"graphql_single_name" => "StateName",
		"graphql_plural_name" => "StatesNames",
	];
	register_taxonomy( "zone_name", [ "area_zone" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_zone_name' );
/**
	 * Taxonomy: County.
	 */

	 $labels = [
		"name" => esc_html__( "County", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "County", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "County", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'zone_county', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "zone_county",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => true,
		"graphql_single_name" => "County",
		"graphql_plural_name" => "Counties",
	];
	register_taxonomy( "zone_county", [ "area_zone" ], $args );


	// API 



	function custom_rest_endpoint_init() {
		register_rest_route('custom/v1', '/providers', array(
			'methods' => 'POST',
			'callback' => 'custom_rest_endpoint_callback',
		));
	}
	add_action('rest_api_init', 'custom_rest_endpoint_init');

		function custom_rest_endpoint_callback($request) {
		$params = $request->get_params();
		$response = array();
		if (!empty($params['internet_services'])) {
			$values = explode(',', $params['internet_services']);
			$values = array_map('trim', $values);
			$meta_query = array(
				'relation' => 'OR',
			);
			foreach ($values as $value) {
				$meta_query[] = array(
					'key'     => 'internet_services',
					'value'   => $value,
					'compare' => 'LIKE',
				);
			}
			$query_args = array(
				'post_type' => 'providers',
				'meta_query' => $meta_query,
				'posts_per_page' => -1
			);
			$providers = get_posts($query_args);
		
			
			$response['providers'] = array();
			foreach ($providers as $provider) {
				$provider_data = array(
					'id' => $provider->ID,
					'title' => $provider->post_title,			
					'pro_price' => get_post_meta($provider->ID, 'pro_price', true),
					'pro_speed' => get_post_meta($provider->ID, 'pro_speed', true),
					'pro_phone' => get_post_meta($provider->ID, 'pro_phone', true),
					'features' => get_post_meta($provider->ID, 'features', true),
					'slug' => basename(get_permalink($provider->ID)),				
					'services_info' => get_post_meta($provider->ID, 'services_info', true),
					'featured_image' => get_the_post_thumbnail_url($provider->ID),
					'providers_service_types' => get_the_terms($provider->ID, 'providers_service_types'),	
					'providers_types' => wp_get_post_terms($provider->ID, 'providers_types', array('fields' => 'slugs')),	
					'pro_offer' => get_post_meta($provider->ID, 'pro_offer', true),	
					
					'services_info_internet_services_phone' =>  get_post_meta($provider->ID, 'services_info_internet_services_phone', true),
					'services_info_internet_services_view_more' =>  get_post_meta($provider->ID, 'services_info_internet_services_view_more', true),
					
					'services_info_landline_services_phone' =>  get_post_meta($provider->ID, 'services_info_landline_services_phone', true),
					'services_info_landline_services_view_more' =>  get_post_meta($provider->ID, 'services_info_landline_services_view_more', true),
					
					'services_info_tv_services_phone' =>  get_post_meta($provider->ID, 'services_info_tv_services_phone', true),
					'services_info_tv_services_view_more' =>  get_post_meta($provider->ID, 'services_info_tv_services_view_more', true),
					
					'services_info_internet_tv_bundles_phone' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_phone', true),
					'services_info_internet_tv_bundles_view_more' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_view_more', true),
					
					'services_info_internet_services_features' =>  get_post_meta($provider->ID, 'services_info_internet_services_features', true),
					'services_info_internet_services_speed' =>  get_post_meta($provider->ID, 'services_info_internet_services_speed', true),
					'services_info_internet_services_price' =>  get_post_meta($provider->ID, 'services_info_internet_services_price', true),
					'services_info_internet_services_summary_features' =>  get_post_meta($provider->ID, 'services_info_internet_services_summary_features', true),
					'services_info_internet_services_summary_speed' =>  get_post_meta($provider->ID, 'services_info_internet_services_summary_speed', true),
					
					'services_info_landline_services_features' =>  get_post_meta($provider->ID, 'services_info_landline_services_features', true),
					'services_info_landline_services_speed' =>  get_post_meta($provider->ID, 'services_info_landline_services_speed', true),
					'services_info_landline_services_price' =>  get_post_meta($provider->ID, 'services_info_landline_services_price', true),
					'services_info_landline_services_summary_features' =>  get_post_meta($provider->ID, 'services_info_landline_services_summary_features', true),
					'services_info_landline_services_summary_speed' =>  get_post_meta($provider->ID, 'services_info_landline_services_summary_speed', true),

					'services_info_tv_services_features' =>  get_post_meta($provider->ID, 'services_info_tv_services_features', true),
					'services_info_tv_services_speed' =>  get_post_meta($provider->ID, 'services_info_tv_services_speed', true),
					'services_info_tv_services_price' =>  get_post_meta($provider->ID, 'services_info_tv_services_price', true),				
					'services_info_tv_services_summary_features' =>  get_post_meta($provider->ID, 'services_info_tv_services_summary_features', true),
					'services_info_tv_services_summary_speed' =>  get_post_meta($provider->ID, 'services_info_tv_services_summary_speed', true),

					'services_info_internet_tv_bundles_channels' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_channels', true),
					'services_info_internet_tv_bundles_features' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_features', true),
					'services_info_internet_tv_bundles_speed' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_speed', true),
					'services_info_internet_tv_bundles_price' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_price', true),
					'services_info_internet_tv_bundles_summary_channel' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_summary_channel', true),
					'services_info_internet_tv_bundles_summary_features' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_summary_features', true),
					'services_info_internet_tv_bundles_summary_speed' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_summary_speed', true),
					'home_security_services_installation_type' =>  get_post_meta($provider->ID, 'services_info_home_security_services_installation_type', true),
					'home_security_services_home_automation' =>  get_post_meta($provider->ID, 'services_info_home_security_services_home_automation', true),
					'home_security_services_mobile_app' =>  get_post_meta($provider->ID, 'services_info_home_security_services_mobile_app', true),
					'home_security_services_contract_term' =>  get_post_meta($provider->ID, 'services_info_home_security_services_contract_term', true),
					'home_security_services_setup_fee' =>  get_post_meta($provider->ID, 'services_info_home_security_services_setup_fee', true),
					'home_security_services_early_termination_fee' =>  get_post_meta($provider->ID, 'services_info_home_security_services_early_termination_fee', true),
					'home_security_services_type_of_monitoring' =>  get_post_meta($provider->ID, 'services_info_home_security_services_type_of_monitoring', true),
					'home_security_services_cheap_packaging' =>  get_post_meta($provider->ID, 'services_info_home_security_services_cheap_packaging', true),
					 
				
				);
				$response['providers'][] = $provider_data;
			}	
			
			
		}
		return rest_ensure_response($response);
	}




function theme_register_nav_menu() {
    register_nav_menu('primary', __('Primary Menu', 'theme-textdomain'));
}

add_action('after_setup_theme', 'theme_register_nav_menu');


function my_theme_enqueue_styles() {
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/dist/style.css', array(), null);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');





// http://localhost/clients/cbl/wp-json/custom/v1/providers?internet_services=20001,20005

// https://cblproject.cablemovers.net/wp-json/custom/v1/providers?internet_services=20001,20005


function custom_area_zone_endpoint( $request ) {
	$params = $request->get_params();
	$state = isset( $params['state'] ) ? $params['state'] : 'ae';
    $args = array(
        'post_type' => 'area_zone',
        'posts_per_page' => -1, // Retrieve all posts
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_state',
                'field' => 'slug',
                'terms' => $state, // California
            ),
        ),
    );

    $area_zones = new WP_Query( $args );

    if ( $area_zones->have_posts() ) {
        $data = array();

        while ( $area_zones->have_posts() ) {
            $area_zones->the_post();
            $data[] = array(
              
                'title' => get_the_title()
             
            );
        }

        return rest_ensure_response( $data );
    } else {
        return new WP_Error( 'no_area_zones', 'No area zones found in California.', array( 'status' => 404 ) );
    }
}

function register_custom_area_zone_endpoint() {
    register_rest_route( 'custom/v1', '/area-zones', array(
        'methods'  => 'GET',
        'callback' => 'custom_area_zone_endpoint',
    ) );
}

add_action( 'rest_api_init', 'register_custom_area_zone_endpoint' );




function city_area_zone_endpoint( $request ) {
	$params = $request->get_params();
	$state = isset( $params['state'] ) ? $params['state'] : 'ae';
    $args = array(
        'post_type' => 'area_zone',
        'posts_per_page' => -1, // Retrieve all posts
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_city',
                'field' => 'slug',
                'terms' => $state, // California
            ),
        ),
    );

    $area_zones = new WP_Query( $args );

    if ( $area_zones->have_posts() ) {
        $data = array();

        while ( $area_zones->have_posts() ) {
            $area_zones->the_post();
            $data[] = array(
              
                'title' => get_the_title()
             
            );
        }

        return rest_ensure_response( $data );
    } else {
        return new WP_Error( 'no_area_zones', 'No area zones found in California.', array( 'status' => 404 ) );
    }
}

function register_city_area_zone_endpoint() {
    register_rest_route( 'custom/v1', '/area-zones-city', array(
        'methods'  => 'GET',
        'callback' => 'city_area_zone_endpoint',
    ) );
}

add_action( 'rest_api_init', 'register_city_area_zone_endpoint' );


//custom/v1/area-zones

// http://localhost/clients/cbl/wp-json/custom/v1/area-zones
// https://cblproject.cablemovers.net/wp-json/custom/v1/area-zones?state=ca


function get_states_and_cities_data($request) {
  $args = array(
      'post_type' => 'area_zone',
      'posts_per_page' => $request['posts_per_page'],
  'offset' => $request['offset'],
  );

  $query = new WP_Query($args);
  $states_and_cities = array();

  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
          $state_terms = get_the_terms(get_the_ID(), 'zone_state');
          $city_terms = get_the_terms(get_the_ID(), 'zone_city');

          if ($state_terms && $city_terms) {
              foreach ($state_terms as $state_term) {
                  $state_name = $state_term->slug;

                  if (!isset($states_and_cities[$state_name])) {
                      $states_and_cities[$state_name] = array();
                  }
        foreach ($city_terms as $city_term) {
                      $city_name = $city_term->slug;

                      // Check if the city is not already in the array for the current state
                      if (!in_array($city_name, $states_and_cities[$state_name])) {
                          $states_and_cities[$state_name][] = $city_name;
                      }
                  }
              }
          }
      }

      wp_reset_postdata();
  }

  return $states_and_cities;
}

// Register the custom REST API endpoint
function register_states_and_cities_endpoint() {
  register_rest_route('custom/v1', '/states-cities', array(
      'methods' => 'GET',
      'callback' => 'get_states_and_cities_data',
  ));
}

add_action('rest_api_init', 'register_states_and_cities_endpoint');

add_filter( 'rest_allow_anonymous_comments', '__return_true' );


add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/insert-comment', array(
        'methods' => 'POST',
        'callback' => 'insert_comment_with_meta',
        'permission_callback' => '__return_true', // Adjust permissions as needed
    ));
});
function insert_comment_with_meta(WP_REST_Request $request) {
    // Get parameters from the request
    $post_id = $request->get_param('post_id');
	$providertype = $request->get_param('providertype');
    $author = $request->get_param('author');
    $author_email = $request->get_param('author_email');
    $content = $request->get_param('content');
    $city = $request->get_param('city');
	$comment_city = $request->get_param('comment_city');	
	$star = $request->get_param('star');
    $state = $request->get_param('state');
    $zipcode = $request->get_param('zipcode');
    $streetAddress = $request->get_param('street_address');
    
    // Validate required parameters
    if (!$post_id || !$author || !$streetAddress || !$author_email || !$content || !$city || !$state || !$zipcode) {
        return new WP_Error('missing_parameter', 'Missing required parameter', array('status' => 400));
    }
    
    // Data for the new comment
    $commentdata = array(
        'comment_post_ID' => $post_id,
        'comment_author' => $author,
        'comment_author_email' => $author_email,
        'comment_content' => $content,
        'comment_approved' => 1,
    );
    
    // Insert the comment and get the comment ID
    $comment_id = wp_insert_comment($commentdata);
    
    if ($comment_id) {
        // Add meta values to the comment
        add_comment_meta($comment_id, 'provider_type', $providertype, true);
		add_comment_meta($comment_id, 'city', $city, true);
        add_comment_meta($comment_id, 'star', $star, true);
		add_comment_meta($comment_id, 'comment_city', $comment_city, true);
        add_comment_meta($comment_id, 'state', $state, true);
        add_comment_meta($comment_id, 'zipcode', $zipcode, true);
        add_comment_meta($comment_id, 'commnt_street_address', $streetAddress, true);
        return new WP_REST_Response(array('comment_id' => $comment_id, 'message' => 'Comment added successfully with meta values'), 200);
    } else {
        return new WP_Error('comment_insert_failed', 'Failed to insert comment', array('status' => 500));
    }
}