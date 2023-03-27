<?php
/* 
  Template Name: Real Estate Finance
*/

get_header(); 

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$brand    = isset($_GET['brand']) ? $_GET['brand'] : '0';

$term_id_out = get_field('select_term_projects', 'option');

$args = array(
  'post_type'      => 'realestate',
  'posts_per_page' => 6,
  'paged' => $paged,
  'tax_query' => array(
    'relation' => 'AND',
    array(
        'taxonomy' => 'realestate-category',
        'field'    => 'term_id',
        'terms'    => array($term_id_out),
        'operator' => 'NOT IN',
    ),
  ),
);

$taxonomies = get_terms( array(
  'taxonomy' => 'realestate-category',
  'hide_empty' => false,
  'exclude'  => array($term_id_out),
) );

if( $brand ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'realestate-category',
      'field'    => 'term_id',
      'terms'    => $brand,
    ),
  );
}

$query = new WP_Query( $args );
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
<div class="with-sidebar-right">
  <div class="row">
    <div class="col-md-9 col-12">
      <section class="contsct-us-info mt-5 mb-5">

          <div class="row m-0">
          
            <div class="col-md-4 col-12 pt-2">
              <div class="ads-finance">
                <a href="<?= the_field('ads_link_real', 'option'); ?>"><img src="<?= the_field('ads_images_real', 'option'); ?>" alt="ads"></a>
              </div>
            </div>

            <div class="col-md-8 col-12">
              <form action="" method="get" class="mb-5 float-right">
                <div class="row">
                  <div class="col-lg-3 col-md-6 px-2 pull-right">
                    <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="brand">
                      <option value="0">على حسب التصنيف</option>
                      <?php foreach ($taxonomies as $term): ?>
                        <option value="<?= $term->term_id; ?>" <?= ($term->term_id == $brand)? 'selected':'';?>><?= $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-3 col-md-6 px-2">
                      <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">بحث</button>
                  </div>
                </div>
              </form>
          
              <div class="row">
                <?php
                if ( $query->have_posts() ):
                  while ( $query->have_posts() ):
                    $query->the_post();
                    $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                    $author_id = get_the_author_ID();
                    $avatar = get_field('user_logo', 'user_'. $author_id);
                  ?>

                  <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                    <div class="car-box">
                      <div class="car-box-img">
                        <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= $img_url; ?>" alt="<?= get_the_title(); ?>"></a>
                      </div>
                      <div class="car-box-content">
                        <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
                        <div class="information">
                          <span class="price"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                          <span class="author">
                            <a class="logo-author" href="#"><img class="img-fluid" src="<?= $avatar; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
                          </span>
                        </div>
                      </div>
                      <div class="overlay">
                        <div class="specifications">
                          <?php
                          if( have_rows('division_property') ):
                          $counter = 0;
                            while ( have_rows('division_property') ) : the_row(); 
                              $counter++;  
                              if( $counter > 3 ) {break;} 
                          ?>
                            <div class="spec-icon">
                              <b><?= the_sub_field('the_name'); ?></b>
                              <span><?= the_sub_field('the_number'); ?></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  
                  <?php
                  endwhile;
                  ?>
                  <div class="col-md-12 mt-5">
                    <?php echo custom_base_pagination(array(), $query); ?>
                  </div>
                  <?php else: ?>
                  <div class="alert alert-danger" role="alert">لا يوجد نتائج للبحث برجاء تغير حقول البحث</div>              
                <?php endif; wp_reset_postdata(); ?>
              </div>
            </div>

          </div>

      </section>
    </div>
    <?php get_sidebar('right'); ?>
    
  </div>
</div>
<?php
get_footer();
?>
