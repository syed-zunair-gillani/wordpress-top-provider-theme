<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
		<title>
			<?php
				/*
				 * Print the <title> tag based on what is being viewed.
				 */
				global $page, $paged, $post;
			
				wp_title( '|', true, 'right' );
			
				// Add the blog name.
				bloginfo( 'name' );
			
				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) )
					echo " | $site_description";
			
				// Add a page number if necessary:
				if ( $paged >= 2 || $page >= 2 )
					echo ' | ' . sprintf( __( 'Page %s', 'wpv' ), max( $paged, $page ) );
            ?>
	</title>
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
   
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="h-auto shadow py-4 font-roboto">
    <nav class="container mx-auto px-4 flex flex-row-reverse sm:flex-row items-center justify-between">
        <div class="sm:hidden flex items-center">
            <button id="menu-toggle">
                <span id="menu-icon" class="hamburger">&#9776;</span>
                <span id="close-icon" class="close hidden">&times;</span>
            </button>
        </div>
        <div class="sm:pl-0 sm:w-1/3 w-full">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="Logo" class="w-20 md:w-auto" />
            </a>
        </div>
        <div id="menu-content" class="sm:w-2/3 bg-gray-100 w-full sm:bg-white shadow-xl sm:shadow-none sm:justify-end sm:static absolute left-0 sm:py-0 py-7 sm:px-0 px-5 flex items-center hidden">
            <?php
            // Display main menu
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'flex sm:flex-row flex-col sm:items-center md:gap-[3vw] gap-5',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
            <a href="tel:833-592-0098" class="items-center gap-2 text-[#ef9831] font-roboto flex justify-end">
                <span class="icon-phone"></span>
                <span class="text-base font-normal">833-592-0098</span>
            </a>
        </div>
    </nav>
</header>


213

	