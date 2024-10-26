<?php
    get_header();

    $state = get_query_var('state');
    $city = get_query_var('city');
    $type = get_query_var('type');
    $zip_codes_to_search = get_zipcodes_by_city($city);

 

   // print_r($zip_codes_to_search);

  
    
    $provider_ids = create_meta_query_for_zipcodes($zip_codes_to_search, $type);









    
//    print "<pre>";
//     print_r($provider_ids);
//     print "</pre>";


    // Check if there are any provider IDs
    if (!empty($provider_ids)) {
    
        $query_args = array(
            'post_type'      => 'providers',
            'posts_per_page' => -1,
            'post__in'       => $provider_ids, 
            'orderby'        => 'post__in', 
            
        );

        // Create a new query using the provider IDs
        $query = new WP_Query($query_args);

    
    } else {
        echo 'No providers match the criteria.';
    }

   

    ?>




<section class="min-h-[40vh] flex items-center bg-gray-50"> 
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-col items-center">
            <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
                <?php echo $type ?> Providers in<br />
                <?php echo $state?> <span class="text-[#ef9831]"><?php echo $city?></span>
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
            <h2 class="text-2xl font-bold capitalize leading-10"><?php echo $type ?> Providers in <?php echo $state?> <span class="text-[#ef9831]"><?php echo $city?> </span></h2>
        </div>
        
        <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $i++;
                    set_query_var('provider_index', $i);     
                    get_template_part( 'template-parts/provider', 'card' );
                }
            } else {
                echo 'No providers found with the specified zip codes.';
            }
            
            // Reset post data
            wp_reset_postdata();
        ?>

        <div><p class="text-sm font-[Roboto] mt-10">*DISCLAIMER: Availability vary by service address. not all offers available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may apply.</p></div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="">
            <h2 class="text-2xl font-bold">Overview of <?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <p class="text-xl font-[Roboto] mt-5">
                As of the time this page was written, <?php echo $city ?> has 5 <?php echo $type ?>  Providers offering Various types of <?php echo $type ?>  plans and deals to its residents. You'll likely have Options from<span> <span>Satellite</span> , </span>
                <span> <span>DSL</span> , </span><span> <span>Fiber</span> , </span><span> <span>Cable</span> </span> <?php echo $type ?> Providers. <span> HughesNet </span> is the best Internet Provider in <?php echo $city ?>
            </p>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Cheap <?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <p class="text-xl font-[Roboto] mt-5">
                Affordability is essential when choosing your <?php echo $type ?> Provider; in an age where staying connected is more crucial than ever, we bring you budget-friendly Internet options that don't compromise on quality. Below are the
                cheap <?php echo $type ?> Providers in <?php echo $city ?>.
            </p>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-2 bg-[#215690]">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Provider</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white mb-2">Pricing starts from</h4></div>
            </div>
        </div>
        <div class="grid">
            
            <?php
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $i++;
                        set_query_var('provider_index', $i);
                        $price = get_field( "pro_price" );
                        ?>
                        <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                            <div class="md:w-full w-full grid grid-cols-2">
                                <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div>
                                        <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity"> <?php the_title()?> </a></p>
                                    </div>
                                </div>
                                <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div><p class="text-center md:text-base text-xs">$<?php echo $price ?> /mo.</p></div>
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
            <h2 class="text-2xl font-bold capitalize leading-10">Fastest <?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <p class="text-xl font-[Roboto] mt-5">
                If speed is your top priority consider the following Internet Providers in <?php echo $city ?>. These providers offer impressive download speeds that cater to the needs of heavy internet users, streamers, and online gamers.
            </p>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-2 bg-[#215690] md:grid-cols-2">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Provider</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Max Download Speed</h4></div>
            </div>
        </div>
        <div class="grid">
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
                        }else{
                            $speed =  $servicesInfo["internet_services"]["summary_speed"];
                        }
                    ?>
                        <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                            <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                                <div class="md:w-full w-full grid grid-cols-2 md:grid-cols-2">
                                    <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"><?php the_title()?></a></p>
                                        </div>
                                    </div>
                                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center"><?php echo $speed ?> Mbps</div>
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
            <h2 class="text-2xl font-bold">Summary of <?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-[50px] grid md:grid-cols-7 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white">Provider</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white">Connection Type</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Max Download Speed</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto md:col-span-3 h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Features</h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Pricing starts from</h4></div>
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
                                        <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div>
                                                <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/hughesnet"> <?php the_title()?> </a></p>
                                            </div>
                                        </div>
                                        <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs">Satellite</p></div>
                                        </div>
                                        <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs"><?php echo $speed ?> Mbps</p></div>
                                        </div>
                                        <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center md:col-span-3">
                                            <div><p class="text-center md:text-base text-xs"><?php echo $feature ?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs">$<?php echo $price ?>/mo</p></div>
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

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-2">
                Types of <?php echo $type ?> Technologies Available in <span class="text-[#ef9831]"><?php echo $city?>, <span class="uppercase"><?php echo $state?></span></span>
            </h2>
            <p class="text-base">
            <?php echo $city?>, <?php echo $state?> is well-connected with a diverse range of Internet connection types to its residents, each with with its own advantages and considerations. These connection types include <?php display_unique_service_types($provider_ids); ?>. Understanding these options can help you make an informed decision based on your needs and location.
            </p>
        </div>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <?php display_service_types_details($provider_ids); ?>
        </div>
    </div>
</section>

<section class="px-4 my-16 container mx-auto">
    <button id="openModalBtn" class="border-[#EF9831] border-[2px] text-[#EF9831] p-3 px-5 rounded-lg hover:bg-[#EF9831] hover:text-white font-medium">
        Leave a Review
    </button>
    <div class="grid gap-10"></div>
</section>

<?php get_template_part( 'template-parts/review', 'form' ); ?>


<script>
    document.getElementById('openModalBtn').addEventListener('click', function () {
        document.getElementById('reviewModal').classList.remove('hidden');
    });
    document.getElementById('closeModalBtn').addEventListener('click', function () {
        document.getElementById('reviewModal').classList.add('hidden');
    });
</script>

<?php

get_footer();