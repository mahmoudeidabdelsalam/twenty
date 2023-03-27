<?php
/* Template Name: Contact US */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#about-page
 *
*/

get_header(); 
?>

<!-- Page Header Start -->
<div class="container-fluid page-header" style="background-image: url('<?= $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>');">
    <h1 class="display-3 text-uppercase text-white mb-3">اتصل بنا</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">اتصل بنا</h6>
    </div>
</div>
<!-- Page Header Start -->

<section class="contsct-us-info mt-5 mb-5">
  <div class="container">
    <div class="row">
      <?php
      if( have_rows('contact_info') ):
        while( have_rows('contact_info') ) : the_row();
      ?>
        <div class="col-md-4 col-12 text-center information-contact">
          <img src="<?= get_sub_field('contact_image'); ?>" alt="<?= get_sub_field('contact_headline'); ?>">
          <h3><?= get_sub_field('contact_headline'); ?></h3>
          <p><?= get_sub_field('contact_text'); ?></p>
        </div>
      <?php
        endwhile;
      endif;
      ?>   
    </div>
  </div>
</section>

<section class="contsct-us-info mt-5 mb-5">
  <div class="container">
    <div class="row">
        <div class="col-md-6 col-12">
          <h2><?= the_field('headline'); ?></h2>
          <?=  do_shortcode( '[gravityform id="'.get_field('id_form').'" title="false" description="false" ajax="true"]' ); ?>
        </div>
        <div class="col-md-6 col-12 pt-2">
          <div class="map-contact-us">
            <?= the_field('map_embed'); ?>
          </div>
        </div>
    </div>
  </div>
</section>


<?php
get_footer();
?>
