<?php
/** Template Name: Blog */

get_header();
?>



<!-- Main Content Area -->
<div class="container mx-auto px-4 py-12">
    <!-- Loop through posts -->
    <?php if ( have_posts() ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ( have_posts() ) : the_post(); ?>
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
        // WordPress pagination function
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( '&larr; Previous', 'textdomain' ),
            'next_text' => __( 'Next &rarr;', 'textdomain' ),
        ) );
        ?>
    </div>
</div>

<?php get_footer(); ?>
