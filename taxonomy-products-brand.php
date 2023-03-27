<?php
get_header(); 
$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$tag    = isset($_GET['tag']) ? $_GET['tag'] : '0';


$tax = $wp_query->get_queried_object();


$args = array(
  'post_type'      => 'products',
  'posts_per_page' => 21,
  'paged' => $paged,
);

$taxonomies = get_terms( array(
  'taxonomy' => 'products-tag',
  'hide_empty' => false,
  'parent'   => 0
) );

$args['tax_query'] = array(
  'relation' => 'AND',
  array(
    'taxonomy' => 'products-brand',
    'field'    => 'term_id',
    'terms'    => $tax->term_id,
  ),
);

if( $tag ) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tag,
    ),
  );
}

$query = new WP_Query( $args );
?>

<!-- Page Header Start -->
<div class="container-fluid page-header" style="background: #000000;">
    <h1 class="display-3 text-uppercase text-white mb-3"><?= $tax->name; ?></h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0"><?= $tax->name; ?></h6>
    </div>
</div>
<!-- Page Header Start -->
<div class="with-sidebar-right">
  <div class="row">
    <div class="col-md-12 col-12">
      <section class="contsct-us-info mt-5 mb-5">

          <div class="row m-0">
          
            <div class="col-md-2 col-12 pt-2">
              <div class="ads-finance">
                <a href="<?= the_field('ads_link_real', 'option'); ?>"><img src="<?= the_field('ads_images_real', 'option'); ?>" alt="ads"></a>
              </div>
            </div>

            <div class="col-md-8 col-12">
            <form action="" method="get" class="mb-5 float-right">
                <div class="row">
                  <div class="col-lg-3 col-md-6 px-2 pull-right">
                    <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="brand">
                      <option value="0">على حسب</option>
                      <?php foreach ($taxonomies as $term): ?>
                        <option value="<?= $term->term_id; ?>" <?= ($term->term_id == $tag)? 'selected':'';?>><?= $term->name; ?></option>
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
                  <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title(); ?>"></a>
                </div>
                <div class="car-box-content">
                  <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
                  <div class="information">
                    <span class="price"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                    <span class="author">
                      <a class="logo-author" href="<?php echo get_author_posts_url($author_id); ?>"><img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
                    </span>
                  </div>
                </div>
                <div class="overlay">
                  <div class="specifications">
                    <?php 
                      $rows = get_field('specifications' );
                      if( $rows ) {
                        $first_row = $rows[0];
                        $first_text = $first_row['text_specifications'];
                        $first_icon = $first_row['icon_specifications'];
                        $two_row = $rows[1];
                        $two_text = $two_row['text_specifications'];
                        $two_icon = $two_row['icon_specifications'];
                      }
                    ?>

                    <?php if($first_row): ?>
                      <div class="spec-icon">
                        <i class="<?=  $first_icon ?> text-primary mr-1"></i>
                        <span><?=  $first_text; ?></span>
                      </div>
                    <?php endif; ?>

                    <?php if($two_row): ?>
                      <div class="spec-icon">
                        <i class="<?=  $two_icon; ?> text-primary mr-1"></i>
                        <span><?=  $two_text; ?></span>
                      </div>
                    <?php endif; ?>
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

            <div class="col-md-2 col-12 pt-2">
              <div class="ads-finance">
                <a href="<?= the_field('ads_link_real_2', 'option'); ?>"><img src="<?= the_field('ads_images_real_2', 'option'); ?>" alt="ads"></a>
              </div>
            </div>

          </div>

      </section>
    </div>
  </div>
</div>


<?php
get_footer();
?>
