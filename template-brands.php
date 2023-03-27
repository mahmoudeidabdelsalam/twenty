<?php
/* 
  Template Name: Brands
*/

get_header(); 

$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';

$terms = get_terms('products-brand', array('parent' => 0));

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

<section class="contsct-us-info mt-5 mb-5 showrooms" id="brands">
  <div class="container">
    <div class="row">
      <?php if(get_the_content()): ?>
        <div class="col-xs-12 text-center mb-5">
          <div  class="content">
            <?= the_content(); ?>
          </div>
        </div>
      <?php endif; ?>

      <?php 
        foreach ($terms  as $term): 
        $image = get_field('icon_term', $term);
          $term_link = get_term_link( $term );
          if ( is_wp_error( $term_link ) ) {
              continue;
          }
          if($image):
        ?>
        <div class="col-md-3 col-sm-4 col-xs-4">
          <div class="card">
            <div class="card-img-top text-center px-5 mt-3">
              <a href="<?= $term_link; ?>"><img src="<?= $image; ?>" class="img-fluid" alt="<?= $term->name; ?>"></a>
              <span class="counter"><?= $term->count; ?> <b>سيارة</b></span>
            </div>
          </div>
        </div>
      <?php 
        else:
          ?>
          <div class="col-md-3 col-sm-4 col-xs-4">
            <div class="card">
              <div class="card-img-top img-placeholder text-center px-5 mt-3">
                <a href="<?= $term_link; ?>"><span><?= $term->name; ?></span></a>
                <span class="counter"><?= $term->count; ?> <b>سيارة</b></span>
              </div>
            </div>
          </div>
          <?php
          endif;
        endforeach; 
      ?>

    </div>
  </div>
</section>
<style>
  section#brands .card .card-img-top a span {
    color: #fff;
    font-size: 22px;
  }
  #brands .card .img-placeholder a {
    min-height: 90px;
  }
  section#brands .card .card-img-top {
    margin-top: 20px;
  }
  section#brands .card .card-img-top  span.counter {
    background: #d97e00;
    position: absolute;
    top: 0;
    right: 0;
    color: #fff;
    font-size: 11px;
    padding: 2px 5px;
  }
  section#brands .card .card-img-top {
    position: relative;
    padding: 0 !important;
  }        
  section#brands .card .card-img-top img {
    max-height: 90px;
  }
  .showroom .logo-author img {
    height: 260px;
    width: 100%;
    object-fit: cover;
  }
  .car-box .overlay i {
    font-size: 30px;
    color: #fff;
    margin: auto;
  }
  span.cars-status {
    position: absolute;
    top: -240px;
    color: #fff;
    background: #d97e00;
    padding: 10px;
    pointer-events: none;
  }  
</style>
<?php
get_footer();
?>
