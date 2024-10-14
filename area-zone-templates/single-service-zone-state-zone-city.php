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
    $type = get_query_var('type');
    $zip_codes_to_search = get_zipcodes_by_city($city);
    
    $query_args = create_meta_query_for_zipcodes($zip_codes_to_search, $type);
    // $query_args = short_providers_with_price($zip_codes_to_search, $type);

    $query = new WP_Query($query_args);
    $i = 0;



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
            <h2 class="text-2xl font-bold">Overview of <?php echo $type ?> Providers in <span class="text-[#ef9831]">20002 </span></h2>
            <p class="text-xl font-[Roboto] mt-5">
                As of the time this page was written, 20002 has 5 Internet Providers offering Various types of Internet plans and deals to its residents. You'll likely have Options from<span> <span>Satellite</span> , </span>
                <span> <span>DSL</span> , </span><span> <span>Fiber</span> , </span><span> <span>Cable</span> </span> Internet Providers. <span> HughesNet </span> is the best Internet Provider in 20002
            </p>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Cheap <?php echo $type ?> Providers in <span class="text-[#ef9831]">20002 </span></h2>
            <p class="text-xl font-[Roboto] mt-5">
                Affordability is essential when choosing your Internet Provider; in an age where staying connected is more crucial than ever, we bring you budget-friendly Internet options that don't compromise on quality. Below are the
                cheap Internet Providers in 20002.
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
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid grid-cols-2">
                    <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity"> Xfinity </a></p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div><p class="text-center md:text-base text-xs">$19.99 /mo.</p></div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid grid-cols-2">
                    <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/astound-broadband"> Astound Broadband </a></p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div><p class="text-center md:text-base text-xs">$25.00 /mo.</p></div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid grid-cols-2">
                    <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"> EarthLink </a></p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div><p class="text-center md:text-base text-xs">$49.95 /mo.</p></div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid grid-cols-2">
                    <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/viasat"> Viasat </a></p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div><p class="text-center md:text-base text-xs">$49.99 /mo.</p></div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid grid-cols-2">
                    <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/hughesnet"> HughesNet </a></p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div><p class="text-center md:text-base text-xs">$49.99 /mo.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Fastest <?php echo $type ?> Providers in <span class="text-[#ef9831]">20002 </span></h2>
            <p class="text-xl font-[Roboto] mt-5">
                If speed is your top priority consider the following Internet Providers in 20002. These providers offer impressive download speeds that cater to the needs of heavy internet users, streamers, and online gamers.
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
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-2 md:grid-cols-2">
                        <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"> EarthLink</a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">5000 Mbps</div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-2 md:grid-cols-2">
                        <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/astound-broadband"> Astound Broadband</a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">1500 Mbps</div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-2 md:grid-cols-2">
                        <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity"> Xfinity</a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">1200 Mbps</div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-2 md:grid-cols-2">
                        <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/viasat"> Viasat</a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">150 Mbps</div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-2 md:grid-cols-2">
                        <div class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div>
                                <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/hughesnet"> HughesNet</a></p>
                            </div>
                        </div>
                        <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">50 Mbps</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">Summary of <?php echo $type ?> Providers in <span class="text-[#ef9831]">20002 </span></h2>
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
                        <div class="min-w-[120px] md:w-full grid md:grid-cols-7 dtable">
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/hughesnet"> HughesNet </a></p>
                                </div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">Satellite</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">50 Mbps</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center md:col-span-3">
                                <div><p class="text-center md:text-base text-xs">Fast Speeds, More Data, Built-in WiFi</p></div>
                            </div>
                            <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">$49.99/mo</p></div>
                            </div>
                        </div>
                        <div class="min-w-[120px] md:w-full grid md:grid-cols-7 dtable">
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/viasat"> Viasat </a></p>
                                </div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">Satellite</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">150 Mbps</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center md:col-span-3">
                                <div><p class="text-center md:text-base text-xs">Access high-speed satellite internet no matter your location</p></div>
                            </div>
                            <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">$49.99/mo</p></div>
                            </div>
                        </div>
                        <div class="min-w-[120px] md:w-full grid md:grid-cols-7 dtable">
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/earthlink"> EarthLink </a></p>
                                </div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs">DSL</p>
                                    <p class="text-center md:text-base text-xs">Fiber</p>
                                </div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">5000 Mbps</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center md:col-span-3">
                                <div><p class="text-center md:text-base text-xs">Blazing-fast speeds paired with enhanced security measures</p></div>
                            </div>
                            <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">$49.95/mo</p></div>
                            </div>
                        </div>
                        <div class="min-w-[120px] md:w-full grid md:grid-cols-7 dtable">
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity"> Xfinity </a></p>
                                </div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">Cable</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">1200 Mbps</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center md:col-span-3">
                                <div><p class="text-center md:text-base text-xs">Connect to and access over 20 million secure hotspots</p></div>
                            </div>
                            <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">$19.99/mo</p></div>
                            </div>
                        </div>
                        <div class="min-w-[120px] md:w-full grid md:grid-cols-7 dtable">
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/astound-broadband"> Astound Broadband </a></p>
                                </div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">Cable</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">1500 Mbps</p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center md:col-span-3">
                                <div><p class="text-center md:text-base text-xs">Smartest WiFi on the Block</p></div>
                            </div>
                            <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs">$25.00/mo</p></div>
                            </div>
                        </div>
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
                Types of <?php echo $type ?> Technologies Available in <span class="text-[#ef9831]">Los Angeles, <span class="uppercase">ca</span></span>
            </h2>
            <p class="text-base">
                Los Angeles, CA is well-connected with a diverse range of Internet connection types to its residents, each with with its own advantages and considerations. These connection types include <span> <span>Cable</span> , </span>
                <span> <span>DSL</span> , </span><span> <span>Fiber</span> , </span><span> <span>Satellite</span> , </span>. Understanding these options can help you make an informed decision based on your needs and location.
            </p>
        </div>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] block w-fit">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                        <path
                            d="M20 5V4c0-.55-.45-1-1-1h-2c-.55 0-1 .45-1 1v1h-1v4c0 .55.45 1 1 1h1v7c0 1.1-.9 2-2 2s-2-.9-2-2V7c0-2.21-1.79-4-4-4S5 4.79 5 7v7H4c-.55 0-1 .45-1 1v4h1v1c0 .55.45 1 1 1h2c.55 0 1-.45 1-1v-1h1v-4c0-.55-.45-1-1-1H7V7c0-1.1.9-2 2-2s2 .9 2 2v10c0 2.21 1.79 4 4 4s4-1.79 4-4v-7h1c.55 0 1-.45 1-1V5h-1z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-4 text-xl font-bold"><span>Cable</span></h2>
                <p class="mt-1 text-base">
                    Cable Internet and TV uses the coaxial cable infrastructure to provide high-speed internet access and television signals to your home. It offers relatively fast &amp;amp; stable internet connection, a wide range of
                    channels and is widely available.
                </p>
            </div>
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] block w-fit">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.5 1.5A1.5 1.5 0 0 1 7 0h2a1.5 1.5 0 0 1 1.5 1.5v11a1.5 1.5 0 0 1-1.404 1.497c.35.305.872.678 1.628 1.056A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.224-.947c.756-.378 1.277-.75 1.628-1.056A1.5 1.5 0 0 1 5.5 12.5v-11ZM7 1a.5.5 0 0 0-.5.5v11a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-11A.5.5 0 0 0 9 1H7Z"
                        ></path>
                        <path d="M8.5 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"></path>
                    </svg>
                </span>
                <h2 class="mt-4 text-xl font-bold"><span>DSL</span></h2>
                <p class="mt-1 text-base">
                    DSL Internet uses telephone lines to deliver internet access. It provides a more stable connection than dial-up and can offer speeds up to 115 Mbps depending on the distance from the provider's central office.
                </p>
            </div>
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] block w-fit">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M169.8 21.95c-43.8 0-83.33 3.58-111.42 9.2-14.05 2.81-25.26 6.19-32.21 9.5-3.48 1.64-5.84 3.29-6.88 4.31 1.04 1.02 3.4 2.67 6.88 4.31 6.95 3.29 18.16 6.67 32.21 9.48 28.09 5.62 67.62 9.2 111.42 9.2 43.7 0 83.3-3.58 111.3-9.22 14-2.81 25.2-6.19 32.2-9.48 3.5-1.64 5.8-3.29 6.9-4.31-1.1-1.02-3.4-2.67-6.9-4.31-7-3.29-18.2-6.67-32.2-9.48-28.1-5.62-67.6-9.2-111.3-9.2zM405 24.38c-3 0-6.2.1-9.2.26-19 1.13-39.4 5.84-59.3 12.14 1.3 2.4 2.3 5.15 2.3 8.16 0 4.58-2.2 8.57-4.8 11.61 21.6-7.31 43.8-12.81 62.8-13.95 21.8-1.3 38.7 2.92 48.5 14.31 15.7 18.1 15.8 36.34 7.3 59.19-8.5 22.8-26.5 48.6-46.3 75.3-19.7 26.8-41.1 54.6-55.8 82.9-14.9 28.4-23.4 58.1-14.9 87.4 9.9 34.8 48.2 63.6 82.9 85.6 34.9 22.1 67.5 36.4 67.5 36.4l7.2-16.4s-31.5-14-65.1-35.2c-33.5-21.2-68.1-50.5-75.1-75.4h-.2c-6.6-23-.2-47.7 13.7-74 13.6-26.4 34.5-53.6 54.3-80.6 19.9-26.9 38.9-53.4 48.7-79.7 9.8-26.47 9.3-54.21-10.6-77.26-13.1-15.14-32.7-20.62-54-20.77zm-235.2 8.57a64 8 0 0 1 64 8 64 8 0 0 1-64 8 64 8 0 0 1-64.1-8 64 8 0 0 1 64.1-8zM50.75 75.54v17.95c33.14.18 66.05-3.01 95.65-7.88-35.4-1.01-67.02-4.3-91.55-9.21-1.4-.28-2.75-.57-4.1-.86zm238.05 0c-1.4.29-2.7.58-4.2.86-15.5 3.1-33.8 5.55-54.1 7.19v.1C189.6 97.95 121.2 111.9 50.75 111.5v11.3c83.35 2.5 162.65-12.1 238.05-32.61zm0 33.36c-74.9 20-154.3 34.5-238.05 32v13.3c81.65 1.3 161.25-4.6 238.05-23.5zm0 40.3c-77.4 18.6-156.9 24.3-238.05 23v11.5c88.35 6.1 171.25 7 238.05-6.8zm0 46.1c-68.8 13.6-151.1 12.4-238.05 6.4v12c73.05 17.6 154.55 24.6 238.05 29.4v-15.7l-65.7-3.3 65.7-9.2zM50.75 232.2v24.1c90.05 22.1 163.05 26 238.05 26.2v-21.3c-82.5-4.8-164-11.6-238.05-29zm0 42.6v22.8l83.15 11.6-83.15 4.2v14.8c84.25 1.4 166.15-.3 238.05-17.3v-10.4c-74.4-.1-148.2-4-238.05-25.7zm238.05 54.6c-73.4 16.7-155.1 18.2-238.05 16.8v23.6c104.95 7.4 189.75-6 238.05-20.9zm0 38.2c-51.4 15.2-135 27.5-238.05 20.3v25.5c89.35 1.1 176.05-2.2 238.05-29.8zm0 35.6c-65.6 26.8-150 29.3-235.89 28.3 30.05 10.5 73.29 16 116.89 15.9 44.4-.1 88.8-6.1 119-16.8zM32.75 442.5c-2.06 1-3.92 2.1-5.53 3.1-6.84 4.5-8.47 8-8.47 9.6 0 1.6 1.63 5.1 8.47 9.6 6.84 4.4 17.86 9 31.78 12.8 27.82 7.6 67.2 12.5 110.8 12.5 43.5 0 82.9-4.9 110.8-12.5 13.9-3.8 24.9-8.4 31.7-12.8 6.8-4.5 8.5-8 8.5-9.6 0-1.6-1.7-5.1-8.5-9.6-1.7-1-3.5-2.1-5.5-3.1v.6l-5.7 2.3c-33.9 13.4-82.5 19.9-131.3 20-48.8.1-97.49-6.1-131.47-20.1l-5.58-2.3z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-4 text-xl font-bold"><span>Fiber</span></h2>
                <p class="mt-1 text-base">Fiber-optic Internet uses thin strands of glass to transmit data as pulses of light. It is known for its incredible speed and reliability, providing symmetrical upload and download speeds.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] block w-fit">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M305.44954,462.59c7.39157,7.29792,6.18829,20.09661-3.00038,25.00356-77.713,41.80281-176.72559,29.9105-242.34331-35.7082C-5.49624,386.28227-17.404,287.362,24.41381,209.554c4.89125-9.095,17.68975-10.29834,25.00318-3.00043L166.22872,323.36708l27.39411-27.39452c-.68759-2.60974-1.594-5.00071-1.594-7.81361a32.00407,32.00407,0,1,1,32.00407,32.00455c-2.79723,0-5.20378-.89075-7.79786-1.594l-27.40974,27.41015ZM511.9758,303.06732a16.10336,16.10336,0,0,1-16.002,17.00242H463.86031a15.96956,15.96956,0,0,1-15.89265-15.00213C440.46671,175.5492,336.45348,70.53427,207.03078,63.53328a15.84486,15.84486,0,0,1-15.00191-15.90852V16.02652A16.09389,16.09389,0,0,1,209.031.02425C372.25491,8.61922,503.47472,139.841,511.9758,303.06732Zm-96.01221-.29692a16.21093,16.21093,0,0,1-16.11142,17.29934H367.645a16.06862,16.06862,0,0,1-15.89265-14.70522c-6.90712-77.01094-68.118-138.91037-144.92467-145.22376a15.94,15.94,0,0,1-14.79876-15.89289V112.13393a16.134,16.134,0,0,1,17.29908-16.096C319.45132,104.5391,407.55627,192.64538,415.96359,302.7704Z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-4 text-xl font-bold"><span>Satellite</span></h2>
                <p class="mt-1 text-base">Satellite Internet and TV is delivered via satellites orbiting the earth. It is widely available in all parts of the US where other types of internet and TV infrastructure are limited.</p>
            </div>
        </div>
    </div>
</section>

<section class="px-4 my-16 container mx-auto">
    <button class="border-[#EF9831] border-[2px] text-[#EF9831] p-3 px-5 rounded-lg hover:bg-[#EF9831] hover:text-white font-medium">Leave a Review</button>
    <div class="grid gap-10"></div>
</section>


<?php

get_footer();