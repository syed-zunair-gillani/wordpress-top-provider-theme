<?php
/** Template Name: About Us */

get_header();
?>

<section class="py-24 bg-[#6041BB]">
    <div class="container mx-auto px-4">
        <h1 class="sm:text-5xl text-4xl leading-normal font-semibold text-white text-center">About Us</h1>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4 grid md:grid-cols-2 grid-cols-1 gap-7 items-center">
        <div>
            <img alt="diverse-team" loading="lazy" width="570" height="375" decoding="async" data-nimg="1"
                class="shadow-[0_15px_15px_rgba(0,0,0,0.05)] rounded-2xl"
                src="<?php echo get_template_directory_uri(); ?>/images/diverse-team.jpg" style="color: transparent;" />
        </div>
        <div class="py-10">
            <h2 class="md:text-3xl text-2xl font-bold">Our Mission</h2>
            <p class="text-base font-normal my-4">
                Navigating through the multitude of internet, TV, and bundle options can be daunting. We strive to
                simplify your decision-making process. At topproviders.net, we offer a streamlined solution for internet
                and TV services.
                Whether you're looking for bundle comparisons or determining the optimal speeds for your daily online
                activities, we're here to help. Our goal is to assist you in evaluating internet and TV providers in
                your area, ensuring
                that you make an informed decision before committing financially.
            </p>
        </div>
    </div>
    <div class="container mx-auto px-4 grid md:grid-cols-2 grid-cols-1 gap-7 items-center">
        <div class="py-10 md:order-1 order-2">
            <h2 class="md:text-3xl text-2xl font-bold">How We Sustain Our Platform</h2>
            <p class="text-base font-normal my-4">
                In order to maintain an ad-free experience for you, we support our platform through affiliate
                partnerships with Internet and TV providers, as well as other links featured on our website. While this
                may occasionally influence
                the providers we showcase and their placement on our site, rest assured that it does not compromise the
                impartiality of the information we provide for user comparison.
            </p>
        </div>
        <div class="md:order-2 order-1">
            <img alt="businesspeople" loading="lazy" width="570" height="375" decoding="async" data-nimg="1"
                class="shadow-[0_15px_15px_rgba(0,0,0,0.05)] rounded-2xl"
            
                src="<?php echo get_template_directory_uri(); ?>/images/businesspeople.jpg"
                style="color: transparent;" />
        </div>
    </div>
    <div class="container mx-auto px-4 grid md:grid-cols-2 grid-cols-1 gap-7 items-center">
        <div>
            <img alt="self" loading="lazy" width="570" height="375" decoding="async" data-nimg="1"
                class="shadow-[0_15px_15px_rgba(0,0,0,0.05)] rounded-2xl"
                src="<?php echo get_template_directory_uri(); ?>/images/business.webp" style="color: transparent;" />
        </div>
        <div class="py-10">
            <h2 class="md:text-3xl text-2xl font-bold">Our Provider Ranking Criteria</h2>
            <p class="text-base font-normal my-4">
                We strive to present you with a comprehensive array of choices, which is why we include all major TV
                providers on our website. Our reviews take into account factors such as availability, reliability,
                customer support, user
                feedback, and overall value for your money. We believe that these insights will empower you to make the
                optimal decision based on your specific needs.
            </p>
        </div>
    </div>
</section>







<?php get_footer(); ?>