<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

    get_header();
?>


<section class="relative my-8">
    <div class="container mx-auto px-4 flex md:flex-row flex-col gap-7 items-center">
        <div class="md:w-1/2 w-full py-10">
            <a href="/providers/att">
                <img
                    alt="Feature Image"
                    loading="lazy"
                    width="140"
                    height="50"
                    decoding="async"
                    data-nimg="1"
                    src="https://www.cablemovers.net/_next/image?url=https%3A%2F%2Fcblproject.cablemovers.net%2Fwp-content%2Fuploads%2F2023%2F08%2Fatt.jpg&w=256&q=75"
                    style="color: transparent;"
                />
            </a>
            <h1 class="text-3xl md:text-5xl md:leading-tight font-bold text-black"><span class="text-[#ef9831]">AT&amp;T </span>Plans and Pricing for October, 2024</h1>
            <div class="features text-black mb-5">
                <p>Get AT&amp;T Internet today and enjoy 25x faster speeds than cable. Connect all your devices and appliances for a synchronized smart home.</p>
                <ul>
                    <li>99% proven reliability</li>
                    <li>No annual contracts</li>
                    <li>Straightforward pricing</li>
                    <li>Speeds up to 5 GIGs</li>
                </ul>
            </div>
            <h5 class="text-xl font-bold text-black">Price Starting At</h5>
            <h2 class="md:text-4xl text-3xl font-extrabold text-black my-4 flex items-start">
                <span class="md:text-3xl text-base">$</span>55.00
                <span class="grid">
                    <span class="md:text-3xl text-base"><sub>/mo</sub></span>
                </span>
            </h2>
            <a class="bg-[#ef9831] rounded-3xl md:text-4xl text-base font-bold text-white w-fit px-3 py-1.5 flex items-center gap-3 mb-4" href="tel:855-205-8483">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z"
                    ></path>
                </svg>
                855-205-8483
            </a>
        </div>
        <div class="md:w-1/2 w-full md:block hidden">
            <img
                alt="Feature Image"
                loading="lazy"
                width="1200"
                height="1626"
                decoding="async"
                data-nimg="1"
                class="object-cover w-full h-full"
                src="https://www.cablemovers.net/_next/image?url=https%3A%2F%2Fcblproject.cablemovers.net%2Fwp-content%2Fuploads%2F2023%2F10%2Fatt-banner-1-scaled-e1696963990452.jpg&w=1200&q=75"
                style="color: transparent;"
            />
        </div>
    </div>
</section>

<section class="bgmain px-4 py-5 shadow-sm border-y border-zinc-400/20 z-50">
    <div class="container mx-auto flex justify-center items-center md:text-4xl text-xl font-bold uppercase text-white">
        <div class="grid items-center md:justify-end justify-center">Call Now to Order</div>
        <div class="items-center justify-start flex gap-3">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="ml-5 md:text-4xl text-2xl font-normal" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"
                ></path>
            </svg>
            <a href="tel:855-205-8483"> 855-205-8483</a>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold"><?php _e('AT&T Internet Plans', 'your-theme-textdomain'); ?></h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5"><?php _e('Swipe Left to See All →', 'your-theme-textdomain'); ?></div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-4 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white"><?php _e('Package', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2"><?php _e('Speed Up To', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white"><?php _e('Price', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2"><?php _e('Order Now', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        <?php 
                        // Example of dynamic package content - Replace with your loop or data source
                        $plans = array(
                            array('name' => 'Internet 25', 'speed' => '25 Mbps', 'price' => '$60.00/mo', 'phone' => '855-205-8483'),
                            array('name' => 'Internet 50', 'speed' => '50 Mbps', 'price' => '$60.00/mo', 'phone' => '855-205-8483'),
                            // Add more plans here...
                        );
                        foreach($plans as $plan): ?>
                        <div class="w-full flex md:flex-row flex-col dtable">
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div><p class="text-center md:text-base text-xs"><?php echo esc_html($plan['name']); ?></p></div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs font-bold"><?php echo esc_html($plan['speed']); ?></p>
                                    <p class="text-center md:text-xs text-xs"><?php _e('*Speed availability vary by location', 'your-theme-textdomain'); ?></p>
                                </div>
                            </div>
                            <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs font-bold"><?php echo esc_html($plan['price']); ?></p>
                                    <p class="text-center md:text-xs text-xs"><?php _e('*w/ Autopay & Paperless Billing', 'your-theme-textdomain'); ?></p>
                                </div>
                            </div>
                            <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo esc_html($plan['phone']); ?>">
                                        <?php echo esc_html($plan['phone']); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10"><h2 class="text-2xl font-bold">Switch to AT&amp;T And Get Benefits You’ll Love</h2></div>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-7">
            <div class="block rounded-xl border border-gray-100 px-8 py-10 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] text-center block w-fit mx-auto">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            fill-rule="evenodd"
                            d="M6.97 2.47a.75.75 0 011.06 0l4.5 4.5a.75.75 0 01-1.06 1.06L8.25 4.81V16.5a.75.75 0 01-1.5 0V4.81L3.53 8.03a.75.75 0 01-1.06-1.06l4.5-4.5zm9.53 4.28a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V7.5a.75.75 0 01.75-.75z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-5 text-xl font-bold text-center">No Data Caps</h2>
                <p class="mt-5 text-base text-center">All AT&amp;T internet plans come with unlimited data so you can stream, game without paying overage or additional charges.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 px-8 py-10 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] text-center block w-fit mx-auto">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M634.91 154.88C457.74-8.99 182.19-8.93 5.09 154.88c-6.66 6.16-6.79 16.59-.35 22.98l34.24 33.97c6.14 6.1 16.02 6.23 22.4.38 145.92-133.68 371.3-133.71 517.25 0 6.38 5.85 16.26 5.71 22.4-.38l34.24-33.97c6.43-6.39 6.3-16.82-.36-22.98zM320 352c-35.35 0-64 28.65-64 64s28.65 64 64 64 64-28.65 64-64-28.65-64-64-64zm202.67-83.59c-115.26-101.93-290.21-101.82-405.34 0-6.9 6.1-7.12 16.69-.57 23.15l34.44 33.99c6 5.92 15.66 6.32 22.05.8 83.95-72.57 209.74-72.41 293.49 0 6.39 5.52 16.05 5.13 22.05-.8l34.44-33.99c6.56-6.46 6.33-17.06-.56-23.15z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-5 text-xl font-bold text-center">24/7 Internet Security</h2>
                <p class="mt-5 text-base text-center">With AT&amp;T ActiveArmor, stop data threats before they get to you even on WiFi.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 px-8 py-10 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] text-center block w-fit mx-auto">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 384 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-5 text-xl font-bold text-center">No Contracts</h2>
                <p class="mt-5 text-base text-center">AT&amp;T does not require annual contract. Cancel anytime without paying any termination or cancelation fees.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 px-8 py-10 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] text-center block w-fit mx-auto">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M634.91 154.88C457.74-8.99 182.19-8.93 5.09 154.88c-6.66 6.16-6.79 16.59-.35 22.98l34.24 33.97c6.14 6.1 16.02 6.23 22.4.38 145.92-133.68 371.3-133.71 517.25 0 6.38 5.85 16.26 5.71 22.4-.38l34.24-33.97c6.43-6.39 6.3-16.82-.36-22.98zM320 352c-35.35 0-64 28.65-64 64s28.65 64 64 64 64-28.65 64-64-28.65-64-64-64zm202.67-83.59c-115.26-101.93-290.21-101.82-405.34 0-6.9 6.1-7.12 16.69-.57 23.15l34.44 33.99c6 5.92 15.66 6.32 22.05.8 83.95-72.57 209.74-72.41 293.49 0 6.39 5.52 16.05 5.13 22.05-.8l34.44-33.99c6.56-6.46 6.33-17.06-.56-23.15z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-5 text-xl font-bold text-center">AT&amp;T Smart Home Manager</h2>
                <p class="mt-5 text-base text-center">This feature allows you to manage your Wi-Fi network, set parental controls, and monitor connected devices using a mobile app or web interface.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 px-8 py-10 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] text-center block w-fit mx-auto">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M634.91 154.88C457.74-8.99 182.19-8.93 5.09 154.88c-6.66 6.16-6.79 16.59-.35 22.98l34.24 33.97c6.14 6.1 16.02 6.23 22.4.38 145.92-133.68 371.3-133.71 517.25 0 6.38 5.85 16.26 5.71 22.4-.38l34.24-33.97c6.43-6.39 6.3-16.82-.36-22.98zM320 352c-35.35 0-64 28.65-64 64s28.65 64 64 64 64-28.65 64-64-28.65-64-64-64zm202.67-83.59c-115.26-101.93-290.21-101.82-405.34 0-6.9 6.1-7.12 16.69-.57 23.15l34.44 33.99c6 5.92 15.66 6.32 22.05.8 83.95-72.57 209.74-72.41 293.49 0 6.39 5.52 16.05 5.13 22.05-.8l34.44-33.99c6.56-6.46 6.33-17.06-.56-23.15z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-5 text-xl font-bold text-center">Nextgen WiFi</h2>
                <p class="mt-5 text-base text-center">With AT&amp;T All-Fi, get more coverage to more corners of your home.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 px-8 py-10 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <span class="text-4xl !text-[#215690] text-center block w-fit mx-auto">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M634.91 154.88C457.74-8.99 182.19-8.93 5.09 154.88c-6.66 6.16-6.79 16.59-.35 22.98l34.24 33.97c6.14 6.1 16.02 6.23 22.4.38 145.92-133.68 371.3-133.71 517.25 0 6.38 5.85 16.26 5.71 22.4-.38l34.24-33.97c6.43-6.39 6.3-16.82-.36-22.98zM320 352c-35.35 0-64 28.65-64 64s28.65 64 64 64 64-28.65 64-64-28.65-64-64-64zm202.67-83.59c-115.26-101.93-290.21-101.82-405.34 0-6.9 6.1-7.12 16.69-.57 23.15l34.44 33.99c6 5.92 15.66 6.32 22.05.8 83.95-72.57 209.74-72.41 293.49 0 6.39 5.52 16.05 5.13 22.05-.8l34.44-33.99c6.56-6.46 6.33-17.06-.56-23.15z"
                        ></path>
                    </svg>
                </span>
                <h2 class="mt-5 text-xl font-bold text-center">AT&amp;T Wi-Fi Hotspots</h2>
                <p class="mt-5 text-base text-center">Subscribers often have access to AT&amp;T's extensive network of Wi-Fi hotspots across the country, allowing for internet connectivity while on the go.</p>
            </div>
        </div>
    </div>
</section>

<section class="mt-16">
    <div class="container mx-auto px-4">
        <div class="">
            <div>
                <h2 class="block_heading">Current AT&amp;T Internet Deals</h2>
                <div class="block_content">
                    <p>AT&amp;T is a DSL and Fiber Internet service provider. AT&amp;T is offering the following incentives to its new customers.</p>
                    <ul>
                        <li>No annual contracts or data caps</li>
                        <li>Free self-install option available</li>
                        <li>Free equipment included on all plans.</li>
                        <li><strong>$250 Visa Reward card</strong> when you sign up with AT&amp;T Fiber 300Mbps or higher plan.</li>
                    </ul>
                </div>
            </div>
            <div>
                <h2 class="block_heading">AT&amp;T Equipment fees, contracts, data caps &amp; ETF's.</h2>
                <div class="block_content">
                    <p>AT&amp;T customers are required to pay some fees on top of their plans base pricing. Here’s what you can expect to pay;</p>
                    <ul>
                        <li><strong>Equipment Fee:</strong> AT&amp;T doesn’t charge for equipment as all DSL and fiber plans include equipment free of charge.</li>
                        <li>
                            <strong>Install Fee:</strong> You have to pay a onetime installation fee of $99 when you choose professional install on any DSL order. To avoid this fee, request for a self-install option. Currently, All AT&amp;T
                            fiber plans have no install fee.
                        </li>
                        <li>
                            <strong>Early Termination Fee:</strong> AT&amp;T offer plans without contracts, providing month-to-month flexibility. With no-contract plan, you can typically cancel your service without incurring early
                            termination fee.
                        </li>
                        <li><strong>Data Caps:</strong> AT&amp;T internet plans come with unlimited data so you won’t have to worry about limiting your internet usage.</li>
                    </ul>
                </div>
            </div>
            <div>
                <h2 class="block_heading">Why Choose AT&amp;T Internet?</h2>
                <div class="block_content">
                    <p>
                        AT&amp;T is a DSL and Fiber internet service provider, providing fast and reliable internet services in 21 states. Like any service, AT&amp;T has its advantages and disadvantages. Here are some of the pros and cons
                        of AT&amp;T Internet.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-8">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 grid-cols-1">
            <div class="bg-gray-200 p-8 pros">
                <h2 class="text-2xl font-bold mb-4">Pros</h2>
                <ul>
                    <li>Unlimited data</li>
                    <li>No annual contracts</li>
                    <li>No equipment fees</li>
                    <li>Wide Availability</li>
                </ul>
            </div>
            <div class="bg-gray-100 p-8 cons">
                <h2 class="text-2xl font-bold mb-4">Cons</h2>
                <ul>
                    <li>Limited fiber availability</li>
                    <li>No Bundle discounts</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">AT&amp;T FAQ’s</h2>
        </div>
        <div class="grid gap-10">
            <div class="faq-item w-full h-fit border border-[#F0F0F0] rounded-[10px] p-[30px] shadow-[0_15px_15px_rgba(0,0,0,0.05)]">
                <div class="faq-question flex justify-between cursor-pointer">
                    <p class="text-lg font-semibold">What types of internet technology does AT&amp;T offer?</p>
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
                            <defs></defs>
                            <path d="M474 152m8 0l60 0q8 0 8 8l0 704q0 8-8 8l-60 0q-8 0-8-8l0-704q0-8 8-8Z"></path>
                            <path d="M168 474m8 0l672 0q8 0 8 8l0 60q0 8-8 8l-672 0q-8 0-8-8l0-60q0-8 8-8Z"></path>
                        </svg>
                    </span>
                </div>
                <div class="faq-answer hidden mt-5">
                    <p class="text-base font-medium">AT&amp;T offers both DSL and fiber-optic internet technologies, with fiber-optic providing higher speeds and reliability.</p>
                </div>
            </div>

            <div class="faq-item w-full h-fit border border-[#F0F0F0] rounded-[10px] p-[30px] shadow-[0_15px_15px_rgba(0,0,0,0.05)]">
                <div class="faq-question flex justify-between cursor-pointer">
                    <p class="text-lg font-semibold">What internet speeds are available with AT&amp;T?</p>
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
                            <defs></defs>
                            <path d="M474 152m8 0l60 0q8 0 8 8l0 704q0 8-8 8l-60 0q-8 0-8-8l0-704q0-8 8-8Z"></path>
                            <path d="M168 474m8 0l672 0q8 0 8 8l0 60q0 8-8 8l-672 0q-8 0-8-8l0-60q0-8 8-8Z"></path>
                        </svg>
                    </span>
                </div>
                <div class="faq-answer hidden mt-5">
                    <p class="text-base font-medium">AT&amp;T offers a range of internet plans with varying speeds from 25 Mbps to 5000 Mbps, depending on your location and the technology available in your area.</p>
                </div>
            </div>

            <!-- Add more FAQ items as needed -->
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


<?php
get_footer();
