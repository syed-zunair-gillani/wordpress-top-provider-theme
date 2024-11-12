<?php
    get_header();
    $state = get_query_var('state');
    $qcity = get_query_var('city');
    $type = get_query_var('type');

 
    $zip_codes_to_search = get_zipcodes_by_city($qcity);
    $city = FormatData($qcity);

    $provider_ids = create_meta_query_for_zipcodes($zip_codes_to_search, $type);   

    $fast_provider_details = Fast_Provider_Details($provider_ids);
    
    $total_provider = count($provider_ids);

    $total_services_type = count_service_types($provider_ids);
  

    $Recommend_Data = [
        [
            'devices' => '1-2',
            'best_use' => 'SD streaming on One device, Basic Browsing and web surfing, Emailing and downloading music',
            'recommend' => 'Up to 25 Mbps',
        ],
        [
            'devices' => '3-5',
            'best_use' => 'HD Streaming on Multiple Devices, Download large files quickly, Lag Free Multi-Player gaming',
            'recommend' => 'Up to 100 Mbps',
        ],
        [
            'devices' => '6-10',
            'best_use' => 'Ultra HD streaming on Multiple Devices, Lag Free Gaming on Multiple Console, Work from home and Video Conferencing',
            'recommend' => 'Up to 500 Mbps',
        ],
        [
            'devices' => '10-15',
            'best_use' => '4K HD streaming on Multiple Devices, Downloading and Gaming Simultaneously',
            'recommend' => 'Up to 1000 Mbps',
        ],
        [
            'devices' => 'More Than 15',
            'best_use' => 'All of the above plus 8K HD streaming on Multiple Devices. Best for Almost Anything',
            'recommend' => 'Up to 1000+ Mbps',
        ],
    ];
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
                $query = new WP_Query($query_args);
        
            } else {
            echo 'No providers match the criteria.';
        }   


        if (!empty($provider_ids)) {    
            $query_args_cheep = array(
                    'post_type'      => 'providers',
                    'posts_per_page' => -1,
                    'post__in'       => $provider_ids, 
                    'orderby'        => 'post__in', 
                    'orderby'        => 'meta_value_num', // Order by meta value as a number
                    'meta_key'       => 'pro_price',      // The meta key to sort by
                    'order'          => 'ASC',             
                );
                $query_cheep = new WP_Query($query_args_cheep);
        
            } else {
            echo 'No providers match the criteria.';
        }  

        if (!empty($provider_ids)) {    
            $query_args_fast = array(
                    'post_type'      => 'providers',
                    'posts_per_page' => -1,
                    'post__in'       => $provider_ids, 
                    'orderby'        => 'post__in', 
                    'orderby'        => 'meta_value_num', // Order by meta value as a number
                    'meta_key'       => 'services_info_internet_services_summary_speed',      // The meta key to sort by
                    'order'          => 'DESC',             
                );
                $query_fast = new WP_Query($query_args_fast);
        
            } else {
            echo 'No providers match the criteria.';
        }  

        if (!empty($provider_ids)) {    
            $query_args_compair = array(
                    'post_type'      => 'providers',
                    'posts_per_page' => 2,
                    'post__in'       => $provider_ids, 
                    'order'          => 'DESC',             
                );
                $query_compair = new WP_Query($query_args_compair);
        
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

    

    <?php if ($type === 'internet'): ?>   

        <section class="my-16">
            <div class="container mx-auto px-4">
                <div class="">
                    <h2 class="text-2xl font-bold">Best Internet Provider in  <span class="text-[#ef9831]"><?php echo $city ?> <?php echo $state ?></span></h2>
                    <p class="text-xl font-[Roboto] mt-5">
                    Cable Movers hand picks <?php echo $fast_provider_details['title']; ?> as the best internet service provider in <?php echo $city ?>. <?php echo $fast_provider_details['title']; ?> offers reliable high speed internet service with robust download speed of up to {enter max download speed} Mbps. Their monthly plans begins at {enter price} /mo making it an all-around popular choice for <?php echo $city ?> residents.
                    </p>
                <p class="text-xl font-[Roboto] mt-5">
                    Another pick for the area is {enter second listed provider name}, featuring a max download speed of up to {enter max download speed} Mbps. Starting at just {enter price} /mo and is a remarkable choice for streaming, gaming and working from home as well.
                    </p>
                </div>
            </div>
        </section>
        <section class="my-16">
            <div class="container mx-auto px-4">
                <div class="mb-10">
                    <h2 class="text-2xl font-bold capitalize leading-10">
                        Internet Facts for 
                        <span class="text-[#ef9831]">
                            <?php echo esc_html($city); ?>, <span class="uppercase"><?php echo esc_html($state); ?></span>
                        </span>
                    </h2>
                </div>
                <div class="grid md:grid-cols-4 grid-cols-1 gap-6">            
                    <div class="fact-box text-center">
                        <div class="icon"><?php echo esc_html($total_provider); ?></div>
                        <i class="fas fa-tag"></i> 
                        <h3 class="mt-4 text-lg font-bold">Available Internet Providers</h3>
                        <p class="mt-1 text-base"><?php echo esc_html($total_provider . ' total providers'); ?></p>
                    </div>
                    
                    
                    <div class="fact-box text-center">
                        <div class="icon"><?php echo $total_services_type ?></div>
                        <i class="fas fa-wrench"></i> 
                        <h3 class="mt-4 text-lg font-bold">Available Technology Types</h3>
                    <p class="mt-1 text-base">
                        <?php echo display_unique_service_types($provider_ids)?>
                        </p>
                    </div>
                    
                    <div class="fact-box text-center">
                        <div class="icon">01</div>
                        <i class="fas fa-gauge"></i> 
                        <h3 class="mt-4 text-lg font-bold">Max Download Speed</h3>
                    <p class="mt-1 text-base"><?php echo esc_html($fast_provider_details['speed'] . ' Mbps'); ?></p>
                    </div>
                    
                    <div class="fact-box text-center">
                        <div class="icon">01</div>
                        <i class="fas fa-money-check"></i> 
                        <h3 class="mt-4 text-lg font-bold">Cheapest Plan</h3>
                    <p class="mt-1 text-base"><?php echo esc_html('$ ' .$fast_provider_details['price']); ?></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-16">
            <div class="container mx-auto px-4">
                <div class="mb-10">
                    <h2 class="text-2xl font-bold capitalize leading-10">
                        How Much Speed Do I Need For My Home?
                    </h2>
                    <p class="text-xl font-[Roboto] mt-5">
                        How much internet speed is needed for my household? You may ask
                        this question to yourself whenever shopping for an Internet
                        service provider but there is no simple or direct answer. It
                        depends on several different factors such as number of connected
                        devices to the internet, how they are being used, someone using it
                        for online gaming, video conferencing, streaming on Netflix or
                        even working from home. Some households may need more speed than
                        the rest because of their use cases. That’s why Cable Movers has
                        designed a chart to help you choose the right internet speed for
                        your home for seamless online experience.
                    </p>
                </div>
                <div class="shadow-xl border">
                    <div class="grid md:grid-cols-3 grid-cols-3 gap-0 divide-x bg-[#215690]">
                        <div class="md:p-5 p-2">
                            <h3 class="md:text-base text-xs text-center text-white mb-2">
                                Number of Devices
                            </h3>
                        </div>
                        <div class="flex items-center justify-center md:p-5 p-2">
                            <h3 class="md:text-base text-xs text-center text-white mb-2">
                                Best Used For
                            </h3>
                        </div>
                        <div class="flex items-center justify-center md:p-5 p-2">
                            <h3 class="md:text-base text-xs text-center text-white mb-2">
                                Recommended Internet Speed
                            </h3>
                        </div>
                    </div>
                    <?php if (!empty($Recommend_Data)) : ?>
                        <?php foreach ($Recommend_Data as $idx => $item) : ?>
                            <?php $bestUse = explode(', ', $item['best_use']); ?>
                            <div class="grid md:grid-cols-3 grid-cols-3 gap-0 divide-x dtable">
                                <div class="flex items-center justify-center md:p-5 p-2">
                                    <p class="text-center md:text-base text-xs">
                                        <?php echo esc_html($item['devices']); ?>
                                    </p>
                                </div>
                                <div class="md:p-5 p-2">
                                    <div class="md:text-base text-xs">
                                        <ul class="grid items-center">
                                            <?php foreach ($bestUse as $featureIdx => $feature) : ?>
                                                <li class="flex gap-2" key="<?php echo esc_attr($featureIdx); ?>">
                                                    <svg class="min-w-[1rem] h-4 mt-[2px] text-[#ef9831] font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span class="text-sm">
                                                        <?php echo esc_html($feature); ?>
                                                    </span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center md:p-5 p-2">
                                    <p class="text-center md:text-base text-xs">
                                        <?php echo esc_html($item['recommend']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($type === 'tv'): ?> 
        <section class="my-16">
            <div class="container mx-auto px-4">
                <div class="">
                    <h2 class="text-2xl font-bold">Best Cable <?php echo $type ?>   Providers in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
                
                    <p class="PClass">    While Dish is present in <?php echo $city ?>, we recommend DIRECTV for you entertainment needs. DIRECTV offer a broad catalog of channels perfect for watching the latest local sports with neighbors or recording your favorite shows while you’re out grocery shopping.</p>

                    <p class="PClass">    With DISH, you can choose from multiple tiers of cable TV service packages. This ranges from $84.99 for 190 total channels and up to $144.99 per month for over 290 channels. The biggest differences are the networks you choose, like ESPN and Disney at the lower end and STARZ and Bloomberg at the higher price. In addition, DISH offers easy-to-use accessories like a free DVR for recording all the shows you want using a voice-activated remote. Anyone with kids or those who dislike typing in long show names will appreciate the voice option. All these services can be bundled, and there are free offers for certain premium channels like Showtime and introductory prices upon request.</p>

                    <p class="PClass">DirecTV offers HD-quality picture you want for stunning visuals and immersive audio. However, the pricing is a little different than dish. The regular introductory level of 165+ channels (including the Sports Package free for 3 months) runs $69.99 per month. You can find deals that knock off $10-$20 monthly for the first few months, but you must sign a two-year contract for this satellite cable service. Another aspect of DirecTV that is different is the available tiers. You can select four different packages that vary based on sports, premium networks, and top-tier providers like Max, Paramount+, and Showtime. There is a bit more price flexibility in your monthly home expenses. In addition, DirecTV has the most comprehensive regional sports networks for local channels and unlimited hours for cloud DVR storage, making it a must-have if you never want to miss a college or league game.</p>

                   



                </div>
            </div>
        </section>
    <?php endif; ?>

  

    


<section class="my-8">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Cheap <?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
               


                <?php 
                    if ($type === 'internet'): ?>
                            <p class="PClass"> 
                                    Affordability is essential when choosing your internet service provider. Cable Movers picks {insert lowest priced internet providers name} as the cheapest internet option in <?php echo $city ?>. {Insert lowest priced internet providers name} offers inexpensive and budget friendly internet plans without sacrificing performance. Their monthly plans begins at {enter price} per month making them a great choice for individuals and families looking to save on their internet bills.
                            </p>
                            <p class="PClass">
                                {Insert 2nd cheap provider name} is another cheap internet service option offering high speed internet plans as low as {enter price} per month to fit into any budget. To help you choose the right internet provider for your home we have listed all providers available in {enter city name} and sorted them by price (low to high).
                            </p>
                    <?php elseif ($type === 'tv'): ?>
                         <p class="PClass">  Affordability is essential when choosing your internet service provider. Cable Movers picks {insert lowest priced internet providers name} as the cheapest internet option in {enter city name}. {Insert lowest priced internet providers name} offers inexpensive and budget friendly internet plans without sacrificing performance. Their monthly plans begins at {enter price} per month making them a great choice for individuals and families looking to save on their internet bills.<p>
                         <p class="PClass">    {Insert 2nd cheap provider name} is another cheap internet service option offering high speed internet plans as low as {enter price} per month to fit into any budget. To help you choose the right internet provider for your home we have listed all providers available in {enter city name} and sorted them by price (low to high).</p>
              
                    <?php else: ?>
                       
                    <?php endif; ?>




        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690]">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Provider</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white mb-2">Cheap Package</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white mb-2"> 
                <?php if ($type === 'internet'): ?> Download Speed <?php else: ?> # of Channels <?php endif; ?></h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white mb-2">Contract</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white mb-2">Price</h4></div>
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
                                <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div>
                                        <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity"> <?php the_title()?> </a></p>
                                    </div>
                                </div>
                                
                                <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div><p class="text-center md:text-base text-xs"><?php echo $cheap_package ?> </p></div>
                                </div>
                                <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div><p class="text-center md:text-base text-xs"><?php echo $summary_speed ?> </p></div>
                                </div>
                                <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div><p class="text-center md:text-base text-xs"><?php echo $contract ?> </p></div>
                                </div>
                                <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                    <div><p class="text-center md:text-base text-xs">$<?php echo $price ?> </p></div>
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
            <p class="text-xl font-[Roboto] mt-5"> Whether you need high speed internet for streaming in 4K resolution or playing online multiplayer games {insert highest speed rated provider name} provides fastest internet connection in {enter city name} with download speed of up to {enter max download speed} for just {enter price} per month which is perfect for households with multiple users and heavy data consumption and can cater to the needs of heavy internet users, streamers and online gamers.</p>
            <p class="text-xl font-[Roboto] mt-5">{enter 2nd rated fast internet provider} internet is renowned for its high speed capabilities making it an excellent choice for gamers and streamers. With download speeds of up to {enter max download speed} making it one of the fastest internet service provider in {enter city name}. Price begins at {enter price} per month.</p>
            <p class="text-xl font-[Roboto] mt-5">Take a look at the fastest internet providers in your area sorted by speed (high to low). </p>

        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690] md:grid-cols-5">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Provider</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Connection </h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Fast Package</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Download Speed</h4></div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div><h4 class="md:text-base text-xs text-center text-white">Price</h4></div>
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
                                    <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"><?php the_title()?></a></p>
                                        </div>
                                    </div>
                                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center"><?php echo $connection_type ?> </div>
                                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center"><?php echo $fast_package ?></div>

                                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center"><?php echo $summary_speed ?> Mbps</div>
                                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">$<?php echo $price ?></div>
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
            <h2 class="text-2xl font-bold">Compare  <?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <p>Still can’t decide? Use our side-by-side comparison chart to make an informed decision.</p>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-row flex-row items-stretch">
                    <div class="md:w-96 min-w-[50px]  bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white">Provider</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white">Connection Type</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Max Download Speed</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Data Caps</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Contract Term</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Setup Fee</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Early Termination Fee</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Equipment Rental Fee</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Monthly Price</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs text-center text-white mb-2">Order Now</h4></div>
                        </div>
                       
                    </div>
                    <div class="flex  flex-row w-full md:overflow-hidden overflow-x-scroll">
                        
                        <?php
                            if ($query_compair->have_posts()) {
                                while ($query_compair->have_posts()) {
                                    $query_compair->the_post();
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

                                    $internet_services =  $servicesInfo["internet_services"];
                                    $home_security_services =  $servicesInfo["home_security_services"];
                                    $landline_services =  $servicesInfo["landline_services"];
                                    $tv_services =  $servicesInfo["tv_services"];
                                    $internet_tv_bundles =  $servicesInfo["internet_tv_bundles"];
            
                                  //  var_dump($internet_services);
                                   $price =  $internet_services['price'];
                                   $setup_fee =  $internet_services['setup_fee'];
                                   $connection_type =  $internet_services['connection_type'];
                                   $early_termination_fee =  $internet_services['early_termination_fee'];
                                   $equipment_rental_fee =  $internet_services['equipment_rental_fee'];
                                   $contract =  $internet_services['contract'];
                                   $data_caps =  $internet_services['data_caps'];

                                ?>
                                    <div class="min-w-[120px] md:w-full dtable">
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
                                            <div><p class="text-center md:text-base text-xs"><?php echo $connection_type ?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs"><?php echo $data_caps ?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs"><?php echo $contract ?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs"><?php echo $setup_fee?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs"><?php echo $early_termination_fee ?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs"><?php echo $equipment_rental_fee ?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs">$<?php echo $price ?></p></div>
                                        </div>
                                        <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                            <div><p class="text-center md:text-base text-xs"><a href="<?php the_permalink()?>">View Plans</a></p></div>
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

<!-- Summary Of Providers -->
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

<?php 
set_query_var('review_query', $query);
get_template_part( 'template-parts/review', 'form' ); ?>


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