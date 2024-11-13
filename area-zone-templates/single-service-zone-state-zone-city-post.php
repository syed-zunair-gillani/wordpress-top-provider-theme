<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

get_header();

$state = get_query_var('state');
$city = get_query_var('city');
$zipcode = get_query_var('zipcode');
$type = get_query_var('type');



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



<section class="my-8">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the Cheap <?php echo $type ?> Providers in
                <span class="text-[#ef9831]"><?php echo $zipcode ?> </span></h2>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690]">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">Cheap Package</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">
                        <?php if ($type === 'internet'): ?> Download Speed <?php else: ?> # of Channels <?php endif; ?>
                    </h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">Contract</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">Price</h4>
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
                            

                        //    print "<pre>";
                        //    print_r($services);
                        //    print "</pre>";
                        $price =  $services['price'];
                        $summary_speed =  $services['summary_speed'];
                        $connection_type =  $services['connection_type'];
                        $cheap_package =  $services['cheap_package'];
                        $contract =  $services['contract'];
                            
                            
                            
                            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid grid-cols-5">
                    <div
                        class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity">
                                    <?php the_title()?> </a></p>
                        </div>
                    </div>

                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><?php echo $cheap_package ?> </p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><?php echo $summary_speed ?> </p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><?php echo $contract ?> </p>
                        </div>
                    </div>
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

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <?php 
                 if ($type === 'internet'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">Fastest <?php echo $type ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?> </span></h2>

            <?php elseif ($type === 'tv'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">Highest Rated <?php echo $type ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <p class="PClass">Below is our curated list of the cable TV providers we know that offer
                quality service and reasonable pricing. Each one has exceptional customer service and online user
                reviews so you can enjoy the football, latest films, and local TV stations you love. </p>
            <?php else: ?>
            <?php endif; ?>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690] md:grid-cols-5">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Connection </h4>
                </div>
            </div>
            <?php if ($type === 'internet'): ?>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Fast Package</h4>
                </div>
            </div>
            <?php endif; ?>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white"><?php if ($type === 'internet'): ?> Download
                        Speed <?php else: ?> # of Channels <?php endif; ?></h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Price</h4>
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
                    <div class="md:w-full w-full grid grid-cols-5 md:grid-cols-5">
                        <div
                            class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank"
                                        href="/providers/earthlink"><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <?php echo $connection_type ?> </div>
                        <?php if ($type === 'internet'): ?> <div
                            class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <?php echo $fast_package ?></div> <?php endif; ?>

                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <?php echo $summary_speed ?></div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            $<?php echo $price ?></div>
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


<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <?php 
                 if ($type === 'internet'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">What are the Best <?php echo $type ?> Providers in
                <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>

            <?php elseif ($type === 'tv'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">Highest Rated <?php echo $type ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <p class="PClass">Below is our curated list of the cable TV providers we know that offer
                quality service and reasonable pricing. Each one has exceptional customer service and online user
                reviews so you can enjoy the football, latest films, and local TV stations you love. </p>
            <?php else: ?>
            <?php endif; ?>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690] md:grid-cols-5">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Connection </h4>
                </div>
            </div>
            <?php if ($type === 'internet'): ?>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Fast Package</h4>
                </div>
            </div>
            <?php endif; ?>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white"><?php if ($type === 'internet'): ?> Download
                        Speed <?php else: ?> # of Channels <?php endif; ?></h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Price</h4>
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
                    <div class="md:w-full w-full grid grid-cols-5 md:grid-cols-5">
                        <div
                            class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank"
                                        href="/providers/earthlink"><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <?php echo $connection_type ?> </div>
                        <?php if ($type === 'internet'): ?> <div
                            class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <?php echo $fast_package ?></div> <?php endif; ?>

                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <?php echo $summary_speed ?></div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            $<?php echo $price ?></div>
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

<?php if ($type === "internet") : ?>
    <!-- What are the Internet Fees in (Enter Zip code, State Abbreviation) -->
    <section class="my-16">
        <div class="container mx-auto px-4">
            <div class="mb-10">
                <h2 class="text-2xl font-bold capitalize leading-10">What are the <?php echo $type ?> Fees in
                    <span class="text-[#ef9831]"><?php echo $city ?> </span>
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
            <!-- <div class="grid">
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
                        <div class="md:w-full w-full grid grid-cols-5 md:grid-cols-5">
                            <div
                                class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank"
                                            href="/providers/earthlink"><?php the_title()?></a></p>
                                </div>
                            </div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <?php echo $connection_type ?> </div>
                            <?php if ($type === 'internet'): ?> <div
                                class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <?php echo $fast_package ?></div> <?php endif; ?>

                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <?php echo $summary_speed ?></div>
                            <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                $<?php echo $price ?></div>
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
            </div> -->
        </div>
    </section>
<?php endif; ?>


<!-- Summary Of Providers -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">Summary of <?php echo $type ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?> </span></h2>

            <?php if ( $type === 'internet'): ?>
            <p class="PClass"> When it comes to finding Internet service provider, (Insert city name, state
                abbreviation) is served by a robust selection of home phone service providers each with its own
                strengths. Whether you prioritize speed, affordability, or reliability, you can find internet providers
                in (Insert city name, state abbreviation) that suit your specific needs. Compare the available options,
                consider your budget, and choose the one that fits your requirements for a seamless online experience.
            <p>

                <?php elseif ( $type === 'landline'): ?>
            <p class="PClass"> The next time you’re moving to the area or need to set up a dedicated landline service
                for your side hustle, rely on our list of the top landline home service providers in the area. We do the
                hard work for you so you can quickly get a landline and move on with your day.
            <p>
            <p class="PClass"> Whatever landline home service providers you choose, be sure to ask about bundled
                services. That is where our trained agents at CableMovers can help. Call us today, and we’ll compare all
                the available telephone service providers in your area, finding the best deal and assisting with the
                setup process.</p>
            <?php elseif ($type === 'home-security'): ?>
            <p class="PClass"> As household names in the industry, these home security service providers in {insert city
                name} provide a range of products that are affordable and effective in protecting your home. With
                flexible plans and low-cost monitoring subscriptions, your wallet won’t hurt too much. What’s more, you
                can add more accessories to your security system over time.</p>
            <p class="PClass"> Remember that affordable doesn’t always mean low quality. Some of the companies we have
                mentioned are extremely economical, offer excellent customer support, and protect your home at a price
                that fits your budget. We have done the hard work. Now it’s up to you to choose a home security company
                in {insert city name} that delivers peace of mind without straining your finances.</p>
            <?php else: ?>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
            <?php endif; ?>

        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
                <div
                    class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-[50px] grid md:grid-cols-7 grid-cols-1 bg-[#215690]">
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white">Connection Type</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Max Download Speed</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto md:col-span-3 h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Features</h4>
                            </div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Pricing starts from</h4>
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
                        <div class="min-w-[120px] md:w-full grid md:grid-cols-7 dtable">
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank"
                                            href="/providers/hughesnet"> <?php the_title()?> </a></p>
                                </div>
                            </div>
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs">Satellite</p>
                                </div>
                            </div>
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $speed ?> Mbps</p>
                                </div>
                            </div>
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center md:col-span-3">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $feature ?></p>
                                </div>
                            </div>
                            <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs">$<?php echo $price ?>/mo</p>
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



<?php

get_footer();