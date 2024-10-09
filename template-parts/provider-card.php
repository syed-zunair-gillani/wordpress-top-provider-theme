<?php

$phone = get_field( "pro_phone" );
$logoArray = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$logoUrl = esc_url( $logoArray[0]);
$servicesInfo = get_field('services_info');

?>


<div class="grid gap-7 mb-7">
    <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex flex-col">
        <div class="md:w-full min-w-fit bg-[#215690] flex justify-between items-center">
            <h2 class="text-base font-bold text-center text-white p-5"><span> 1 </span>- <?php the_title()?></h2>
            <h2 class="text-base font-bold text-center text-white p-5"></h2>
        </div>
        <div class="md:w-full w-full grid grid-cols-1 dtable md:grid-cols-5 flex-col">
            <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                <a target="_blank" href="/providers/xfinity">
                    <img
                        alt="Feature Image"
                        loading="lazy"
                        width="140"
                        height="50"
                        decoding="async"
                        data-nimg="1"
                        src="<?php echo $logoUrl ?>"
                        style="color: transparent;"
                    />
                </a>
            </div>
            <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                <div class="text-center">
                    <p class="tch">Speeds from</p>
                    <p class="tcd"><?php print_r($servicesInfo["internet_services"]["speed"]) ?> Mbps</p>
                </div>
            </div>
            <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5 px-3">
                <?php
                   $items = explode(',', $servicesInfo["internet_services"]["features"]);
                   echo '<ul class="grid items-center justify-center">';                   
                   foreach ($items as $item) {
                       echo '<li class="flex gap-2 items-center">';
                       echo '<svg class="min-w-[1rem] h-4 text-[#ef9831] font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                             </svg>';
                       echo '<span class="text-sm">' . trim($item) . '</span>';
                       echo '</li>';
                   }
                   echo '</ul>';
                ?>
            </div>
            <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                <div>
                    <p class="tch">Pricing starts from</p>
                    <p class="tcd"><span class="font-extrabold text-[#215690] font-[Roboto] text-xl"> $<?php print_r($servicesInfo["internet_services"]["price"]) ?> </span> /mo.</p>
                </div>
            </div>
            <div class="grid gap-3 items-center justify-center p-5">
                <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#215690] hover:bg-[#ef9831]" href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
                <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#ef9831] hover:bg-[#215690]" href="<?php echo the_permalink() ?>">View Plans</a>
            </div>
        </div>
    </div>
</div>