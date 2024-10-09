<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

get_header();
// Define the zip code you want to search for
$target_zipcode = '90001';
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// Parse the URL to get the path component
$parsed_url = parse_url($current_url);
// Break down the path into segments
$path = trim($parsed_url['path'], '/');
$segments = explode('/', $path);
// Extract the required parts
$type = isset($segments[1]) ? $segments[1] : null; 
$state = isset($segments[2]) ? $segments[2] : null;   
$city = isset($segments[3]) ? $segments[3] : null;    
$zipcode = isset($segments[4]) ? $segments[4] : null;

$args = array(
    'post_type' => 'providers', // Custom post type slug
    'posts_per_page' => -1,     // Get all matching posts
    'meta_query' => array(
        array(
            'key'     => 'internet_services', // Meta key for the custom field
            'value'   => $zipcode,     // Target zip code to search for
            'compare' => 'LIKE'               // Use LIKE to search within serialized arrays
        ),
    ),
);

?>




<section class="min-h-[40vh] flex items-center bg-gray-50"> 
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-col items-center">
            <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
                Internet Providers in <br />
                ZIP Code <span class="text-[#ef9831]"><?php echo $zipcode ?></span>
            </h1>
            <p class="text-xl text-center font-[Roboto] my-5">Enter your zip so we can find the best Internet Providers in your area:</p>
            <?php get_template_part('template-parts/filter', 'form'); ?>
        </div>
    </div>
</section>

<section class="bg-[#215690] py-4 shadow-sm border-y border-zinc-400/20 sticky top-0">
    <div class="container mx-auto px-4">
        <div>
            <ul class="flex md:gap-3 gap-1.5 items-center">
                <li>
                    <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/internet/zip-20001">Internet Providers</a>
                </li>
                <li><a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/tv/zip-20001">TV Providers</a></li>
                <li>
                    <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/internet-tv/zip-20001">
                        Internet and TV Providers
                    </a>
                </li>
                <li>
                    <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/landline/zip-20001">Landline Providers</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Internet Providers in <span class="text-[#ef9831]"><?php echo $zipcode ?> </span></h2>
        </div>
        <?php
        // Query the posts
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();        
                    get_template_part( 'template-parts/provider', 'card' );
                }
            } else {
                echo 'No providers found with the specified zip code.';
            }
            // Reset post data
            wp_reset_postdata();
        ?>
        <div><p class="text-sm font-[Roboto] mt-10">*DISCLAIMER: Availability vary by service address. not all offers available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may apply.</p></div>
    </div>
</section>



<?php

get_footer();
