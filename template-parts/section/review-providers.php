<?php
    $query = get_query_var('review_query');
    $city = get_query_var('city');
    $type = get_query_var('type');
    $state = get_query_var('state');

    function fetch_comments_by_state($state) {                
        $args = [
            'meta_query' => [
                [
                    'key'   => 'state', // The meta key to filter by
                    'value' => $state,  // The meta value to match
                    'compare' => '=',   // Comparison operator
                ],
            ],
        ];
        $comment_query = new WP_Comment_Query($args);
        $comments = $comment_query->get_comments();
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                ?>
                    <div class="">
                        <div>

                        </div>
                        <p><?php echo esc_html($comment->comment_content) ?></p>
                        <div>
                            <h6><?php echo $comment->comment_author ?></h6>
                        </div>
                    </div>
                <?php
            }
        } else {
            echo 'No comments found for the specified state.';
        }
    }

?>



<!-- Review Sections -->
<section class="px-4 mt-16 container mx-auto">
    <button id="openModalBtn"
        class="border-[#EF9831] border-[2px] text-[#EF9831] p-3 px-5 rounded-lg hover:bg-[#EF9831] hover:text-white font-medium">
        Leave a Review
    </button>
    <div class="grid gap-10"></div>
</section>

<section class="container mx-auto px-4 mb-10">
    <h2 class="text-2xl font-bold mb-2 mt-5">
        All comments for <span class="text-[#ef9831]"> <span class="capitalize"><?php echo $city ?></span></span>
    </h2>
    <div>
        <?php
            fetch_comments_by_state($state);
        ?>
    </div>
</section>

<?php get_template_part( 'template-parts/review', 'form' ); ?>
<script>
document.getElementById('openModalBtn').addEventListener('click', function() {
    document.getElementById('reviewModal').classList.remove('hidden');
});
document.getElementById('closeModalBtn').addEventListener('click', function() {
    document.getElementById('reviewModal').classList.add('hidden');
});
</script>
