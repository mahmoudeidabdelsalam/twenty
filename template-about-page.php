<?php
/* Template Name: about us */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#about-page
 *
*/

get_header(); 
?>




  <!-- Page Header Start -->
  <div class="container-fluid page-header" style="background-image: url('<?= $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>');">
      <h1 class="display-3 text-uppercase text-white mb-3">من نحن</h1>
      <div class="d-inline-flex text-white">
          <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
          <h6 class="text-body m-0 px-3">/</h6>
          <h6 class="text-uppercase text-body m-0">من نحن</h6>
      </div>
  </div>
  <!-- Page Header Start -->

  <!-- About Start -->
  <div class="container-fluid py-5">
      <div class="container pt-5 pb-3">
          <h1 class="display-4 text-uppercase text-center mb-5">مرحبا بك في <span class="text-primary"><?= the_field('headline'); ?></span></h1>
          <div class="row justify-content-center welcome">
              <div class="col-lg-12 text-center">
                  <img class="w-75 mb-4" src="<?= the_field('image_about_us'); ?>" alt="<?= the_field('headline'); ?>">
                  <?= the_field('sub_headline'); ?>
              </div>
          </div>
          <div class="row mt-3">
            <?php
            if( have_rows('values') ):
              while( have_rows('values') ) : the_row();
              ?>
                <div class="col-lg-4 mb-2 service-icons">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="<?= get_sub_field('values_icon'); ?>"></i>
                        </div>
                        <h4 class="text-uppercase m-0"><?= get_sub_field('values_headline'); ?></h4>
                    </div>
                </div>
              <?php
              endwhile;
            endif;
            ?> 
          </div>
      </div>
  </div>
  <!-- About End -->

  <!--/#hero-text-->
  <section id="services">
    <div class="container">

      <div class="section-header">
        <h2 class="section-title text-center wow fadeInDown"><?= the_field('headline_services'); ?></h2>
        <div class="text-center wow fadeInDown"><?= the_field('content_services'); ?></div>
      </div>

      <div class="row">
        <div class="features">
        <?php
            if( have_rows('steps_about_us') ):
              while( have_rows('steps_about_us') ) : the_row();
            ?>
              <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms">
                <div class="media service-box">
                  <div class="hexagon">
                    <div class="inner">
                      <i class="<?= get_sub_field('icon_step'); ?>"></i>
                    </div>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading text-center"><?= get_sub_field('headline_step'); ?></h4>
                  </div>
                </div>
              </div>
            <?php
              endwhile;
            endif;
            ?>
        </div>
      </div>
      <!--/.row-->
    </div>
    <!--/.container-->
  </section>
  <!--/#services-->

  <!-- Vendor Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <div class="owl-carousel vendor-carousel">
      <?php
        if( have_rows('logos_vendor', 'option') ):
          while( have_rows('logos_vendor', 'option') ) : the_row();
        ?>
          <div class="bg-light p-4">
            <img src="<?= the_sub_field('logo_vendor'); ?>" alt="">
          </div>
          <?php endwhile; ?>
        <?php endif; ?>              
      </div>
    </div>
  </div>
  <!-- Vendor End -->


<?php
get_footer();
?>
