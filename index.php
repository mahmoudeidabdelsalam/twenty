<?php
/**
 * The main template file.
 * 
 * To override home page (for listing latest post) add home.php into the theme.<br>
 * If front page displays is set to static, the index.php file will be use.<br>
 * If front-page.php exists, it will be override any home page file such as home.php, index.php.<br>
 * To learn more please go to https://developer.wordpress.org/themes/basics/template-hierarchy/ .
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();
?> 
<main id="main" class="site-main" role="main">
  <div class="container">
    <div class="row">
      <?php
      if (have_posts()) {
          while (have_posts()) {
              the_post();
              get_template_part('template-parts/content', get_post_format());
          }// endwhile;

          $Bsb4Design = new \BootstrapBasic4\Bsb4Design();
          $Bsb4Design->pagination();
          unset($Bsb4Design);
      } else {
          get_template_part('template-parts/section', 'no-results');
      }// endif;
      ?> 
    </div>
  </div>  
</main>
<?php
get_footer();