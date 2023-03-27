<?php
/** 
 * The single post.<br>
 * This file works as display full post content page and its comments.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();

?> 
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 col-12 site-main m-auto" role="main">
      <?php
      if (have_posts()) {
          while (have_posts()) {
              the_post();
              get_template_part('template-parts/content', get_post_format());
          }// endwhile;

      } else {
          get_template_part('template-parts/section', 'no-results');
      }// endif;
      ?> 
    </div>
  </div>
</div>
<?php

get_footer();