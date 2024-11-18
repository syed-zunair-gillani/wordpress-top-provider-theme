<h2 class="md:text-2xl text-2xl font-semibold mb-5">Top Internet Provider Deals</h2>    
<div class="grid md:grid-cols-4 gap-5">
    <?php
        if( have_rows('top_internet_provider_deals') ) {
            while( have_rows('top_internet_provider_deals') ) {
                the_row();
                $speed = get_sub_field('speed');
                $features = get_sub_field('features');
                $price = get_sub_field('price');
                $call = get_sub_field('call');
                $provider = get_sub_field('provider');

                print_r($provider);
                

                break;
            }
        }  
    ?>
</div>












<!-- <?php
    $index = 0;
    $args = array(
        'post_type'      => 'providers',
        'posts_per_page' => 4,               
        'providers_types' => 'internet',
        'order'          => 'DESC', 
        'meta_key'       => 'services_info_internet_services_summary_speed',
        'orderby'        => 'meta_value_num'
    );

    // Custom query to fetch posts
    $providers_query = new WP_Query($args);

    // The Loop
    if ($providers_query->have_posts()) :
        while ($providers_query->have_posts()) : $providers_query->the_post();
        $index++;

        $phone = get_field( "pro_phone" );
        $logoArray = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $logoUrl = esc_url( $logoArray[0]);
        $servicesInfo = get_field('services_info');
        $type = get_query_var('type');

        // print "<pre>";
        // print_r($servicesInfo);
        // print "</pre>";

        $speed =  $servicesInfo["internet_services"]["summary_speed"];
        $features_items = explode(',', $servicesInfo["internet_services"]["features"]);
        $price = $servicesInfo["internet_services"]["price"];


    ?>

    <div class="grid  gap-7 mb-7">
        <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex flex-col">
            <div class="md:w-full min-w-fit bg-[#215690] flex justify-between items-center">
                <h2 class="text-base font-bold text-center text-white p-5"><span> <?php echo $index ?> </span>- <?php the_title()?></h2>
                <h2 class="text-base font-bold text-center text-white p-5"></h2>
            </div>
            <div class="md:w-full w-full grid grid-cols-1 dtable  flex-col">
                <div class=" border-b grid items-center justify-center p-5">
                    <a target="_blank" href="<?php the_permalink()?>">
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
                <div class="  border-b grid items-center justify-center p-5">
                    <div class="text-center">
                    
                            
                            <p class="tch">Speed from</p>
                    
                        <p class="tcd"><?php echo $speed  ?> 
                        
                                <span class="tch">Mbps</span>
                        
                        </p>
                    </div>
                </div>
                <div class="  border-b grid items-center justify-center p-5 px-3">
                    <?php                  
                    echo '<ul class="grid items-center justify-center">';                   
                    foreach ($features_items as $feature_item) {
                        echo '<li class="flex gap-2 items-center">';
                        echo '<svg class="min-w-[1rem] h-4 text-[#ef9831] font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                                </svg>';
                        echo '<span class="text-sm">' . trim($feature_item) . '</span>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
                <div class="  border-b grid items-center justify-center p-5">
                    <div>
                        <p class="tch">Pricing starts from</p>
                        <p class="tcd"><span class="font-extrabold text-[#215690] font-[Roboto] text-xl"> $<?php echo $price; ?> </span> /mo.</p>
                    </div>
                </div>
                <div class="grid gap-3 items-center justify-center p-5">
                    <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#215690] hover:bg-[#ef9831]" href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
                    <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#ef9831] hover:bg-[#215690]" href="<?php echo the_permalink() ?>">View Plans</a>
                </div>
            </div>
        </div>
    </div>

    <?php 

    endwhile;
    else :
        echo '<p>No providers found.</p>';
    endif;

    // Reset post data to avoid conflicts
    wp_reset_postdata();
?> -->