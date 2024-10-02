<?php
/** Template Name: Search */

get_header();
?>


<div class="custom-search-form">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/result' ) ); ?>">
        <label>
            <span class="screen-reader-text">Search for:</span>
            <input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>"
                name="zipcode">
        </label>
        <input type="submit" class="search-submit" value="Search Result"></input>
    </form>
</div>



<?php
get_footer();  ?>