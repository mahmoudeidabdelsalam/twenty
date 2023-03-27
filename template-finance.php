<?php
/* 
  Template Name: Finance
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

<section class="contsct-us-info mt-5 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center mb-5">
        <h2><?= the_field('headline_finance'); ?></h2>
        <h4><?= the_field('sub_headline_finance'); ?></h4>
        <div  class="content">
          <?= the_content(); ?>
        </div>
      </div>

      <div class="col-md-4 col-12 pt-2">
        <div class="ads-finance">
          <a href="<?= the_field('ads_link'); ?>"><img src="<?= the_field('ads_images'); ?>" alt="ads"></a>
        </div>
      </div>

      <div class="col-md-8 col-12">
        <?php if(get_field('id_form_finance')): ?>
          <h2><?php _e('البيانات', 'numbertwenty20'); ?></h2>
          <?=  do_shortcode( '[gravityform id="'.get_field('id_form_finance').'" title="false" description="false" ajax="true"]' ); ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>


<?php
get_footer();
?>
