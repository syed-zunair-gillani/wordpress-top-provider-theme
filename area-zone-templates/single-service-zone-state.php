<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

 $state = get_query_var('state');
 $city = get_query_var('city');
 $type = get_query_var('type');
 
 function inject_meta_tags() {
    // Get the current page title, description, and canonical URL
    $meta_title = "High Speed Internet Providers in" . $zipcode . "," . $state . "| Cable Movers";
    $meta_description = "View all Internet service providers in {Insert Zip Code, State Abbreviation}. Compare internet plans, prices and new promotions and pick the best provider that fits within your budget.";
    $canonical_url = get_permalink();

    // Output the meta tags
    echo '<title>' . esc_html($meta_title) . '</title>' . "\n";
    echo '<meta name="description" content="' . esc_attr($meta_description) . '" />' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '" />' . "\n";
}
add_action('wp_head', 'inject_meta_tags');

    get_header();

   

    $zip_codes_to_search = get_zipcodes_by_state($state);
    $provider_ids = create_meta_query_for_zipcodes($zip_codes_to_search, $type);  
        if (!empty($provider_ids)) {    
                $query_args = array(
                        'post_type'      => 'providers',
                        'posts_per_page' => -1,
                        'post__in'       => $provider_ids, 
                        'orderby'        => 'post__in',             
                    );
                    $query = new WP_Query($query_args);
            
                } else {
                echo 'No providers match the criteria.';
            }   

    $i = 0;

    $state = strtoupper($state);


 
 ?> 
 
 
 <section class="min-h-[40vh] flex items-center bg-gray-50"> 
     <div class="container mx-auto px-4">
         <div class="flex justify-center flex-col items-center">
             <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
             <?php echo $type ?> Providers in <br /><span class="text-[#ef9831]"><?php echo $state ?></span>
             </h1>
             <p class="text-xl text-center font-[Roboto] my-5">Enter your zip so we can find the best <?php echo $type ?> Providers in your area:</p>
             <?php get_template_part('template-parts/filter', 'form'); ?>
         </div>
     </div>
 </section>
 
 <?php get_template_part( 'template-parts/types', 'routing' ); ?>
 
 <section class="my-16">
     <div class="container mx-auto px-4">
         <div class="mb-10">
             <h2 class="text-2xl font-bold capitalize leading-10"><?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $state ?> </span></h2>
         </div>
         <?php
         // Query the posts
             if ($query->have_posts()) {
                 while ($query->have_posts()) { $query->the_post(); $i++; set_query_var('provider_index', $i);     
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


 
 <?php  get_footer();
 

