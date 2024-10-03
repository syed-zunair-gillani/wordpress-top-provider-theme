<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CBL_Theme
 */

?>

<footer class="bg-[#000] pt-16 pb-4">
  <div class="container mx-auto px-4 grid md:grid-cols-5 grid-cols-1 gap-5">
    <!-- Footer Logo and Description -->
    <div class="col-span-2">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="Cable Movers footer logo" height="56" width="254" />
      </a>
      <p class="text-sm font-normal text-white/75 mt-5">
        All names, logos, trademarks displayed are the sole property of their respective owners; cablemovers.net employs these trademarks solely for the purpose of describing the products and services provided by each respective trademark holder. We offer information for comparative purposes and do not directly provide internet and TV services, nor do we endorse one service provider over another. We are financially supported by compensation from our internet and TV partners.
      </p>
      <ul class="flex gap-5 mt-5">
        <li>
          <a href="https://www.facebook.com/cablemovers.net" class="text-white/75 hover:text-white text-2xl">
            <i class="bi bi-facebook"></i> <!-- Replace with BiLogoFacebookCircle -->
          </a>
        </li>
        <li>
          <a href="https://twitter.com/cablemovers" class="text-white/75 hover:text-white text-2xl">
            <i class="bi bi-twitter"></i> <!-- Replace with BiLogoTwitter -->
          </a>
        </li>
        <li>
          <a href="https://www.linkedin.com/company/cablemovers-net" class="text-white/75 hover:text-white text-2xl">
            <i class="bi bi-linkedin"></i> <!-- Replace with BiLogoLinkedinSquare -->
          </a>
        </li>
      </ul>
    </div>
    <!-- Providers Section -->
    <div class="col-span-2">
      <h6 class="text-lg font-normal text-white mb-5">
        PROVIDERS
      </h6>
      <ul class="grid md:grid-cols-3 grid-cols-1 gap-1">
        <?php
          // Dynamic Providers Data Loop
          $providers_data = array(
            array('name' => 'Provider 1', 'link' => '#'),
            array('name' => 'Provider 2', 'link' => '#'),
            array('name' => 'Provider 3', 'link' => '#'),
          );
          foreach ($providers_data as $provider) {
            echo '<li><a href="' . esc_url($provider['link']) . '" class="text-sm font-medium capitalize text-white/75 hover:text-white">' . esc_html($provider['name']) . '</a></li>';
          }
        ?>
      </ul>
    </div>
    <!-- Company Section -->
    <div>
      <h6 class="text-lg font-normal text-white mb-5">
        COMPANY
      </h6>
      <ul class="grid gap-3">
        <?php
          // Dynamic Navigation Links Loop
          $nav_links = array(
            array('name' => 'About Us', 'link' => '#'),
            array('name' => 'Contact', 'link' => '#'),
            array('name' => 'Privacy Policy', 'link' => '#'),
          );
          foreach ($nav_links as $nav_item) {
            echo '<li><a href="' . esc_url($nav_item['link']) . '" class="text-sm font-medium capitalize text-white/75 hover:text-white">' . esc_html($nav_item['name']) . '</a></li>';
          }
        ?>
      </ul>
    </div>
  </div>
  <!-- Footer Bottom Section -->
  <div class="container mx-auto px-4 mt-12 pt-4 border-t border-white/20">
    <p class="text-sm font-normal text-white/75">
      Copyright © 2024 CableMovers.net. All rights reserved.
    </p>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>