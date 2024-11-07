<?php
/** Template Name: About Us */

get_header();
?>

<section class="py-24 bg-[#215690]">
    <div class="container mx-auto px-4">
        <h1 class="sm:text-5xl text-4xl leading-normal font-extrabold text-white text-center"><?php the_title()?></h1>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4">
    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
    </div>
</section>


<section class="py-16 bg-[#F3FAFF]">
    <div class="container mx-auto px-4 my-10 grid md:grid-cols-2 grid-cols-1 gap-5 items-center">
        <div class=""><h2 class="md:text-4xl text-2xl font-semibold leading-normal md:text-start text-center">Find Internet and TV Service Providers</h2></div>
        <div class="flex items-center md:justify-end justify-center [&amp;>div:nth-child(1)]:md:mr-0 [&amp;>div:nth-child(1)]:w-fit">
            <button class="text-[#ef9831] border hover:bg-[#ef9831] hover:text-white border-[#ef9831] p-3 px-8 rounded-lg">Change Location</button>
        </div>
    </div>
    </div>
</section>



                                            


<?php get_footer(); ?>
