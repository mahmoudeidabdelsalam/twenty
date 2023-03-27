<?php
/* 
  Template Name: Interior Design
*/

get_header(); 
?>

<!-- Page Header Start -->
<div class="container-fluid page-header" style="background-image: url('<?= $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>');">
    <h1 class="display-3 text-uppercase text-white mb-3"><?= the_title(); ?></h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
    </div>
</div>
<!-- Page Header Start -->

<section class="contsct-us-info with-sidebar-right mt-5 mb-5">
  <div class="container-fluid">
    <div class="row">
      
      <div class="col-md-3 col-12 pt-2 order-2">
        <div class="ads-finance">
          <a href="<?= the_field('ads_link_real', 'option'); ?>"><img src="<?= the_field('ads_images_real', 'option'); ?>" alt="ads"></a>
        </div>
      </div>

      <div class="col-md-6 col-xs-12 mb-5 order-3">
        <div class="top-image">
        <?php 
        $images = get_field('galleries');
        if( $images ): ?>
          <div class="content-carousel">
            <div class="owl-carousel owl-interior">
              <?php foreach( $images as $image ): ?>
                <div><img src="<?= $image; ?>" alt="slide"></div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <div  class="content">
          <h1 class="text-uppercase text-body m-0"><?= the_title(); ?></h1>
          <?= the_content(); ?>
        </div>
      </div>

      <?php get_sidebar('right'); ?>


    </div>
  </div>
</section>

<?php
get_footer();
?>
