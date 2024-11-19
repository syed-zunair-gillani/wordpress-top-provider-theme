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
 $zipcode = get_query_var('zipcode');
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


$args = array(
    'post_type' => 'providers', 
    'posts_per_page' => -1,    
    'meta_query' => array(
        array(
            'key'     => 'internet_services', 
            'value'   => $zipcode,   
            'compare' => 'LIKE'   
        ),
    ),
    'tax_query' => array(
        array(
            'taxonomy' => 'providers_types',
            'field'    => 'slug',
            'terms'    => $type,
        ),
    ),
);

$query_args_cheep = array(
    'post_type'      => 'providers',
    'posts_per_page' => -1,
    'post__in'       => $provider_ids, 
    'orderby'        => 'post__in', 
    'orderby'        => 'meta_value_num', // Order by meta value as a number
    'meta_key'       => 'pro_price',      // The meta key to sort by
    'order'          => 'ASC',  
    'meta_query' => array(
        array(
            'key'     => 'internet_services', 
            'value'   => $zipcode,   
            'compare' => 'LIKE'   
        ),
    ),
    'tax_query' => array(
        array(
            'taxonomy' => 'providers_types',
            'field'    => 'slug',
            'terms'    => $type,
        ),
    ),           
);
$query_cheep = new WP_Query($query_args_cheep);


$query_args_fast = array(
    'post_type'      => 'providers',
    'posts_per_page' => -1,
    'post__in'       => $provider_ids, 
    'orderby'        => 'post__in', 
    'orderby'        => 'meta_value_num', // Order by meta value as a number
    'meta_key'       => 'services_info_internet_services_summary_speed',      // The meta key to sort by
    'order'          => 'DESC',   
    'meta_query' => array(
        array(
            'key'     => 'internet_services', 
            'value'   => $zipcode,   
            'compare' => 'LIKE'   
        ),
    ),
    'tax_query' => array(
        array(
            'taxonomy' => 'providers_types',
            'field'    => 'slug',
            'terms'    => $type,
        ),
    ),          
);
$query_fast = new WP_Query($query_args_fast);


?>



<section class="min-h-[40vh] flex items-center bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-col items-center">
            <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
                <?php echo $type ?> Providers in <br />
                ZIP Code <span class="text-[#ef9831]"><?php echo $zipcode ?></span>
            </h1>
            <p class="text-xl text-center font-[Roboto] my-5">Enter your zip so we can find the best <?php echo $type ?>
                Providers in your area:</p>
            <?php get_template_part('template-parts/filter', 'form'); ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/types', 'routing' ); ?>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10"><?php echo $type ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $zipcode ?> </span></h2>
        </div>
        <?php
        // Query the posts
            $query = new WP_Query($args);
            $i = 0;
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
        <div>
            <p class="text-sm font-[Roboto] mt-10">*DISCLAIMER: Availability vary by service address. not all offers
                available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may
                apply.</p>
        </div>
    </div>
</section>


<!-- Cheep ZIP Sections -->
<section class="my-8">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the Cheap <?php echo str_replace(['-'], ' ', $type); ?> Providers in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div class="md:w-full min-w-fit grid <?php if ($type !== 'home-security' && $type !== 'landline'): ?>grid-cols-3<?php else: ?> grid-cols-2 <?php endif; ?> bg-[#215690]">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                </div>
            </div>
            
            <?php if ($type !== 'home-security' && $type !== 'landline'): ?>
                <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white mb-2">
                            <?php if ($type === 'internet'): ?>Max Download Speed <?php else: ?> # of Channels <?php endif; ?>
                        </h4>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">Starting Price</h4>
                </div>
            </div>
        </div>
        <div class="grid">
            <?php
                if ($query_cheep->have_posts()) {
                    while ($query_cheep->have_posts()) {
                        $query_cheep->the_post();
                        $i++;
                        set_query_var('provider_index', $i);
                        $price = get_field( "pro_price" );
                        $servicesInfo = get_field('services_info');
                        if ($type == 'internet') {
                            $services = $servicesInfo["internet_services"];
                        } elseif ($type == 'tv') {
                            $services = $servicesInfo["tv_services"];
                        } elseif ($type == 'landline') {
                            $services = $servicesInfo["landline_services"];
                        } else {
                            $services = $servicesInfo["home_security_services"];
                        }
                
                    $price =  $services['price'];
                    $summary_speed =  $services['summary_speed'];
                    $connection_type =  $services['connection_type'];
                    $cheap_package =  $services['cheap_package'];
                    $contract =  $services['contract'];
            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid <?php if ($type !== 'home-security' && $type !== 'landline'): ?>grid-cols-3<?php else: ?> grid-cols-2 <?php endif; ?>">
                    <div
                        class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity">
                                    <?php the_title()?> </a></p>
                        </div>
                    </div>

                    <?php if ($type !== 'home-security' && $type !== 'landline'): ?>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><?php echo $summary_speed ?> 
                                    <?php if ($type === 'internet'): ?><sup>Mbps</sup><?php endif; ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs">$<?php echo $price ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
                    } else {
                        echo 'No providers found with the specified zip codes.';
                    }
                    
                    // Reset post data
                    wp_reset_postdata();
                ?>
        </div>
    </div>
</section>


<!-- Fast ZIP Sections -->
<?php if ($type === 'internet'): ?>
    <section class="my-16">
        <div class="container mx-auto px-4">
            <div class="mb-10">
                <?php 
                    if ($type === 'internet'): ?>
                <h2 class="text-2xl font-bold capitalize leading-10">Fastest <?php echo $type ?> Providers in <span
                        class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?></span></h2>

                <?php elseif ($type === 'tv'): ?>
                <h2 class="text-2xl font-bold capitalize leading-10">Highest Rated <?php echo $type ?> Providers in <span
                        class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span></h2>
                <p class="PClass">Below is our curated list of the cable TV providers we know that offer
                    quality service and reasonable pricing. Each one has exceptional customer service and online user
                    reviews so you can enjoy the football, latest films, and local TV stations you love. </p>
                <?php else: ?>
                <?php endif; ?>
            </div>
            <div class="md:w-full min-w-fit grid grid-cols-4 bg-[#215690] md:grid-cols-4">
                <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                    </div>
                </div>
                <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Connection </h4>
                    </div>
                </div>
            
                <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white"><?php if ($type === 'internet'): ?> Max Download Speed <?php else: ?> # of Channels <?php endif; ?></h4>
                    </div>
                </div>
                <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Upload Speed</h4>
                    </div>
                </div>
            </div>
            <div class="grid">
                <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }

                            //  var_dump($internet_services);
                            $price =  $services['price'];
                            $summary_speed =  $services['summary_speed'];
                            $connection_type =  $services['connection_type'];
                            $fast_package =  $services['fast_package'];
                            ?>
                <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                    <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                        <div class="md:w-full w-full grid grid-cols-4 md:grid-cols-4">
                            <div
                                class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank"
                                            href="/providers/earthlink"><?php the_title()?></a></p>
                                </div>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <?php echo $connection_type ?> </div>
                        
                            <div class="border-r border-b flex justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <?php echo $summary_speed ?> <sub>Mbps</sub></div>
                            <div class="border-r border-b flex justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                upload speed <sub>Mbps</sub></div>
                        </div>
                    </div>
                </div>
                <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- What are the Best ZIP Section  -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the Best <?php echo str_replace(['-'], ' ', $type); ?> Providers in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span></h2>
        </div>
        <div class="md:w-full min-w-fit grid  bg-[#215690] <?php if ($type !== 'home-security'): ?>grid-cols-3<?php else: ?> grid-cols-2 <?php endif; ?>">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                </div>
            </div>
            <?php if ($type !== 'home-security'): ?>
                <div class="grid justify-center border-r md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Connection </h4>
                    </div>
                </div>
            <?php endif; ?>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Best For:</h4>
                </div>
            </div>
        </div>
        <div class="grid">
            <?php
                    if ($query_fast->have_posts()) {
                        while ($query_fast->have_posts()) {
                            $query_fast->the_post();
                            $i++;
                            set_query_var('provider_index', $i);
                            $servicesInfo = get_field('services_info');
                            if ($type == 'internet') {
                                $services = $servicesInfo["internet_services"];
                            } elseif ($type == 'tv') {
                                $services = $servicesInfo["tv_services"];
                            } elseif ($type == 'landline') {
                                $services = $servicesInfo["landline_services"];
                            } else {
                                $services = $servicesInfo["home_security_services"];
                            }

                        //  var_dump($services);
                        $price =  $services['price'];
                        $summary_speed =  $services['summary_speed'];
                        $connection_type =  $services['connection_type'];
                        $fast_package =  $services['fast_package'];
                        ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid <?php if ($type !== 'home-security'): ?>grid-cols-3<?php else: ?> grid-cols-2 <?php endif; ?>">
                        <div
                            class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank"
                                        href="/providers/earthlink"><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <?php echo $connection_type ?> </div>
                         <div
                            class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            Best For</div>

                    </div>
                </div>
            </div>
            <?php
                        }
                    } else {
                        echo 'No providers found with the specified zip codes.';
                    }
                    
                    // Reset post data
                    wp_reset_postdata();
                ?>
        </div>
    </div>
</section>


 <!-- Fee Sections -->
 <?php if ($type === 'internet'): ?>
    <section class="my-16">
        <div class="container mx-auto px-4">
            <div class="mb-10">
                <h2 class="text-2xl font-bold capitalize leading-10">What are the <?php echo $type ?> Fees in
                    <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
                </h2>
            </div>
            <div class="md:w-full min-w-fit grid grid-cols-4 bg-[#215690] md:grid-cols-4">
                <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                    </div>
                </div>
                <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Equipment Rental Fee</h4>
                    </div>
                </div>
                <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Setup Fee</h4>
                    </div>
                </div>
                <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Early Termination Fee</h4>
                    </div>
                </div>
            </div>
            <div class="grid">
                <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }



                            // var_dump($services);
                            $price =  $services['price'];
                            $early_termination_fee =  $services['early_termination_fee'];
                            $setup_fee =  $services['setup_fee'];
                            $equipment_rental_fee =  $services['equipment_rental_fee'];
                            ?>
                <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                    <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                        <div class="md:w-full w-full grid grid-cols-4 md:grid-cols-4">
                            <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"><?php the_title()?></a></p>
                                </div>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $equipment_rental_fee ?>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $setup_fee ?>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $early_termination_fee ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($type === 'tv'): ?>
    <section class="my-16">
        <div class="container mx-auto px-4">
            <div class="mb-10">
                <h2 class="text-2xl font-bold capitalize leading-10">What are the Cable TV Fees in
                    <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
                </h2>
            </div>
            <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690] md:grid-cols-5">
                <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                    </div>
                </div>
                <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Setup Fee</h4>
                    </div>
                </div>
                <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Equipment Rental Fee</h4>
                    </div>
                </div>
                <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Early Termination Fee</h4>
                    </div>
                </div>
                <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Broadcast Fee</h4>
                    </div>
                </div>
            </div>
            <div class="grid">
                <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }



                            // var_dump($services);
                            $price =  $services['price'];
                            $early_termination_fee =  $services['early_termination_fee'];
                            $setup_fee =  $services['setup_fee'];
                            $equipment_rental_fee =  $services['equipment_rental_fee'];
                            $broadcast_tv_fee =  $services['broadcast_tv_fee'];
                            ?>
                <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                    <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                        <div class="md:w-full w-full grid grid-cols-5 md:grid-cols-5">
                            <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"><?php the_title()?></a></p>
                                </div>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $setup_fee ?>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $equipment_rental_fee ?>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $early_termination_fee ?>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $broadcast_tv_fee ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($type === 'home-security' || $type === 'landline'): ?>
    <section class="my-16">
        <div class="container mx-auto px-4">
            <div class="mb-10">
                <h2 class="text-2xl font-bold capitalize leading-10">What are the 
                    <?php if ($type === 'landline'): ?>Landline Home Phone <?php endif; ?>
                    <?php if ($type === 'home-security'): ?>Home Security Systems<?php endif; ?>
                    Fees in
                    <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
                </h2>
            </div>
            <div class="md:w-full min-w-fit grid grid-cols-3 bg-[#215690] md:grid-cols-3">
                <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                    </div>
                </div>
                <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Setup Fee</h4>
                    </div>
                </div>
                <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                    <div>
                        <h4 class="md:text-base text-xs text-center text-white">Early Termination Fee</h4>
                    </div>
                </div>
            </div>
            <div class="grid">
                <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }



                            // var_dump($services);
                            $price =  $services['price'];
                            $early_termination_fee =  $services['early_termination_fee'];
                            $setup_fee =  $services['setup_fee'];
                            $equipment_rental_fee =  $services['equipment_rental_fee'];
                            ?>
                <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                    <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                        <div class="md:w-full w-full grid grid-cols-3 md:grid-cols-3">
                            <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"><?php the_title()?></a></p>
                                </div>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $setup_fee ?>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $early_termination_fee ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- Summary Of Providers -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">Summary of <?php echo str_replace(['-'], ' ', $type); ?> Providers in 
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
                <div
                    class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-[50px] grid md:grid-cols-5 grid-cols-1 bg-[#215690]">
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                            </div>
                        </div>

                        <!-- $type !== 'home-security' -->
                        <?php if ($type !== 'home-security' && $type !== 'landline'): ?>
                            <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <h4 class="md:text-base text-xs text-center text-white">Connection Type</h4>
                                </div>
                            </div>
                            <div
                                class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <h4 class="md:text-base text-xs text-center text-white mb-2">
                                        <?php if ($type === 'internet'): ?>Max Download Speed<?php endif; ?>
                                        <?php if ($type === 'tv'): ?>Channels<?php endif; ?>
                                    </h4>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- $type === 'home-security' -->
                        <?php if ($type === 'home-security' || $type === 'landline'): ?>
                            <div class="md:border-r border-r-0 md:border-b-0 col-span-2 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <h4 class="md:text-base text-xs text-center text-white">
                                        <?php if ($type === 'home-security'): ?>Features<?php endif; ?>
                                        <?php if ($type === 'landline'): ?>Connection<?php endif; ?>
                                    </h4>
                                </div>
                            </div>
                        <?php endif; ?>

                        
                        <div class="grid justify-center border-r md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Starting Price</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Contact</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">

                        <?php
                            
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $i++;
                                        set_query_var('provider_index', $i);
                                        $servicesInfo = get_field('services_info');
                                        $type = get_query_var('type');
                                        $isSpeed = $type === "tv";
                                        $phone = get_field( "pro_phone" );
                                        if($isSpeed){
                                            $speed =  $servicesInfo["tv_services"]["summary_speed"];
                                            $feature =  $servicesInfo["tv_services"]["summary_features"];
                                            $price =  $servicesInfo["tv_services"]["price"];
                                        }else{
                                            $speed =  $servicesInfo["internet_services"]["summary_speed"];
                                            $feature =  $servicesInfo["internet_services"]["summary_features"];
                                            $price =  $servicesInfo["internet_services"]["price"];
                                        }
                                    ?>
                        <div class="min-w-[120px] md:w-full grid md:grid-cols-5 dtable">
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/hughesnet"> <?php the_title()?> </a> </p>
                                </div>
                            </div>

                            <?php if ($type !== 'home-security' && $type !== 'landline'): ?>
                                <div
                                    class="w-full md:border-r border-r md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div>
                                        <p class="text-center md:text-base text-xs">Satellite</p>
                                    </div>
                                </div>
                                <div
                                    class="w-full md:border-r border-r md:border-b border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div>
                                        <p class="text-center md:text-base text-xs"><?php echo $speed ?> 
                                            <?php if ($type === 'internet'): ?>Mbps<?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($type === 'home-security' || $type === 'landline'): ?>
                                <div class="w-full md:border-r col-span-2 border-r md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div>
                                        <p class="text-center md:text-base text-xs">
                                            <?php if ($type === 'home-security'): ?><?php echo $feature ?><?php endif; ?>
                                            <?php if ($type === 'landline'): ?><?php echo $type ?><?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            

                            <div class="w-full grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs">$<?php echo $price ?>/mo</p>
                                </div>
                            </div>

                            <div
                                class="w-full md:border-r border-r md:border-b border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <a href="tel:<?php echo $phone ?>" class="text-center md:text-base text-xs"><?php echo $phone ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                                    }
                                } else {
                                    echo 'No providers found with the specified zip codes.';
                                }
                                
                                // Reset post data
                                wp_reset_postdata();
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FAQ’s -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">FAQs</h2>
        </div>
        <div class="grid gap-10">
            <?php
                // Define an array of FAQs
                $total_providers_count = $query_fast->found_posts;
                $first_provider = $query_fast->posts[0];
                $first_provider_title = get_the_title($first_provider->ID);
                
                $faqs;
                $internet_faqs = [
                    [
                        "question" => "1. Who is the Best Internet Service Provider in $zipcode",
                        "answer" => "$total_providers_count Internet service providers are available in $zipcode Based on the availability $first_provider_title is the best internet service provider in  $zipcode"
                    ],
                    [
                        "question" => "2. Who is the fastest Internet service provider in  $zipcode?",
                        "answer" => "$first_provider_title is the fastest internet service provider in {$zipcode} and offers max download speeds up to {summery_speed}Mbps in select areas."
                    ],
                    [
                        "question" => "3. Who is the cheapest Internet service provider in $zipcode?",
                        "answer" => "$first_provider_title is the cheapest internet service provider in {$zipcode} with price starting from {price}"
                    ],
                    [
                        "question" => "4. What is the typical internet speed options offered in $zipcode?",
                        "answer" => "In {$zipcode} internet speed options can vary among internet service providers but most plans include speeds from 25 mbps to 5000 mbps."
                    ],
                    [
                        "question" => "5. How do I check the availability of Internet service providers in $zipcode?",
                        "answer" => "To check Internet service providers availability, Enter your zip code to find the best internet options available to you."
                    ]
                ];
                $tv_faqs = [
                    [
                        "question" => "1. How do I check the availability of TV service providers in $zipcode",
                        "answer" => "To check TV service providers availability, Enter your zip code to find the best TV options available to you."
                    ],
                    [
                        "question" => "2. How do I setup TV service in my new home in $zipcode",
                        "answer" => " To setup TV service in your new home, contact the above listed service providers, inquire about their plans and select the plan that works for you."
                    ],
                    [
                        "question" => "3. Can I get TV service without any contract in $zipcode",
                        "answer" => "Yes. A few TV service providers in {$zipcode} offer no contract or month to month services. Call the providers to know more."
                    ],
                    [
                        "question" => "4. Who is the Best TV Service Provider in $zipcode",
                        "answer" => "{$total_providers_count} TV service providers are available in {$zipcode} Based on the availability and pricing {$first_provider_title} is the best TV service provider in {$zipcode}."
                    ],
                    [
                        "question" => "5.	Who is the cheapest TV service provider in $zipcode",
                        "answer" => "{$first_provider_title} is the cheapest TV service provider in {$zipcode} with price starting from {Price}"
                    ],
                ];
                $landline_faqs = [
                    [
                        "question" => "1.	What is a Landline?",
                        "answer" => "A landline is a type of home phone service that transmits audio data over a wire (typically copper, cable or fiber) and comes with features like Caller ID, Call Forwarding, Call Blocking and Three-way calling."
                    ],
                    [
                        "question" => "2.	Who is the Best Landline Phone Service Provider in $zipcode",
                        "answer" => "$total_providers_count landline service providers are available in Zip Code {$zipcode}. Based on the availability {$first_provider_title}  is the best landline phone service provider in $zipcode"
                    ],
                    [
                        "question" => "3.	Can I get Landline Phone Service without Internet in $zipcode",
                        "answer" => "Yes. You can get a landline home phone service without internet in Zip Code $zipcode as many providers offer traditional landline phone service options which requires a separate line and don’t require an internet connection."
                    ],
                    [
                        "question" => "4.	Who is the cheapest Internet service provider in $zipcode",
                        "answer" => "{$total_providers_count} is the cheapest landline home phone service provider in Zip Code {$zipcode} with price starting from {Price}."
                    ],
                    [
                        "question" => "5.	How do I check the availability of Landline Phone service providers in $zipcode",
                        "answer" => "To check Landline Phone service providers availability, Enter your zip code to find the best Landline options available to you."
                    ],
                ];
                $home_security_faqs = [
                    [
                        "question" => "home_security_faqs",
                        "answer" => "home_security_faqs"
                    ] 
                ];
 
                if ($type === 'tv'):
                    $faqs = $tv_faqs;
                elseif ($type === 'internet'):
                    $faqs = $internet_faqs;
                elseif ($type === 'landline'):
                    $faqs = $landline_faqs;
                else:
                    $faqs = $home_security_faqs;
                endif;

                // Loop through the FAQs array
                foreach ($faqs as $faq) {
                    $question = $faq['question'];
                    $answer = $faq['answer'];
            ?>
                    <div class="faq-item w-full h-fit border border-[#F0F0F0] rounded-[10px] p-[30px] shadow-[0_15px_15px_rgba(0,0,0,0.05)]">
                        <div class="faq-question flex justify-between cursor-pointer">
                            <p class="text-lg font-semibold"><?php echo $question; ?></p>
                            <span class="faq-icon text-lightBlue">
                                <svg
                                    stroke="currentColor"
                                    fill="currentColor"
                                    stroke-width="0"
                                    viewBox="0 0 1024 1024"
                                    class="faq-arrow transform transition duration-200 rotate-0"
                                    height="24"
                                    width="24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path d="M474 152m8 0l60 0q8 0 8 8l0 704q0 8-8 8l-60 0q-8 0-8-8l0-704q0-8 8-8Z"></path>
                                    <path d="M168 474m8 0l672 0q8 0 8 8l0 60q0 8-8 8l-672 0q-8 0-8-8l0-60q0-8 8-8Z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="faq-answer hidden mt-5">
                            <p class="text-base font-medium"><?php echo $answer; ?></p>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>


<script>

    document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach((item) => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            const arrow = item.querySelector('.faq-arrow');

            question.addEventListener('click', () => {
                // Close all other open FAQ items
                faqItems.forEach((otherItem) => {
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    const otherArrow = otherItem.querySelector('.faq-arrow');
                    if (otherItem !== item) {
                        otherAnswer.classList.add('hidden');
                        otherArrow.classList.remove('rotate-45');
                    }
                });

                // Toggle the clicked item
                answer.classList.toggle('hidden');
                arrow.classList.toggle('rotate-45');
            });
        });
    });

</script>

<?php get_footer();