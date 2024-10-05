<?php
/** Template Name: Blog */

get_header();
?>

<section class="py-24 bg-[#215690]">
    <div class="container mx-auto px-4">
        <h1 class="sm:text-5xl text-4xl leading-normal font-extrabold text-white text-center">Blog</h1>
    </div>
</section>
<section class="py-24 ">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center mb-14 gap-y-8 lg:gap-y-0 flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between lg:gap-x-8">
            <div class="group cursor-pointer w-full max-lg:max-w-xl lg:w-1/3 border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
            <div class="flex items-center mb-6">
                <img src="https://pagedone.io/asset/uploads/1696244553.png" alt="Harsh image" class="rounded-lg w-full object-cover">
            </div>
            <div class="block">
                <h4 class="text-gray-900 font-medium leading-8 mb-9">Fintech 101: Exploring the Basics of Electronic Payments</h4>
                <div class="flex items-center justify-between  font-medium">
                    <h6 class="text-sm text-gray-500">By Harsh C.</h6>
                    <span class="text-sm text-indigo-600">2 year ago</span>
                </div>
            </div>
            </div>
            <div class="group cursor-pointer w-full max-lg:max-w-xl lg:w-1/3 border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
            <div class="flex items-center mb-6">
                <img src="https://pagedone.io/asset/uploads/1696244579.png" alt="John image" class="rounded-lg w-full object-cover">
            </div>
                        
        </div>
        <a href="javascript:;" class="cursor-pointer border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-[#215690] hover:text-white">View All</a>
    </div>
</section>
                                            



<!-- Main Content Area -->
<div class="container mx-auto px-4 py-12">

    <?php
    // Custom WP Query to get posts of a specific post type (e.g., 'post')
    $args = array(
        'post_type' => 'post', // Specify the post type
        'posts_per_page' => -1, // Number of posts to display
        'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1, // Enable pagination
    );

    $custom_query = new WP_Query( $args );
    ?>

    <!-- Loop through posts -->
    <?php if ( $custom_query->have_posts() ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                <!-- Individual Blog Post -->
                <article class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Featured Image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-48 object-cover' ) ); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="p-6">
                        <!-- Post Title -->
                        <h2 class="text-2xl font-semibold mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-blue-600">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <!-- Post Excerpt -->
                        <p class="text-gray-600 mb-4">
                            <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                        </p>

                        <!-- Read More Button -->
                        <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:text-blue-700 font-semibold">
                            Read More &rarr;
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p class="text-gray-700">Sorry, no posts were found.</p>
    <?php endif; ?>

    <!-- Pagination -->
    <div class="mt-12">
        <?php
        // WordPress pagination function for custom query
        echo paginate_links( array(
            'total' => $custom_query->max_num_pages,
            'prev_text' => __( '&larr; Previous', 'textdomain' ),
            'next_text' => __( 'Next &rarr;', 'textdomain' ),
        ) );
        ?>
    </div>


            
    


    <?php
    // Reset post data after custom query
    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
