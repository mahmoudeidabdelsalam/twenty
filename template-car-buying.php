<?php
/* Template Name: Car buying */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#about-page
 *
*/

get_header(); 

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$price    = isset($_GET['price']) ? $_GET['price'] : '0';
$brand    = isset($_GET['brand']) ? $_GET['brand'] : '0';
$vendor   = isset($_GET['vendor']) ? $_GET['vendor'] : '0';


$args = array(
  'post_type'      => 'products',
  'posts_per_page' => 12,
  'paged' => $paged,
  'meta_key'    => 'price',
  'orderby' => 'meta_value_num',
  'order'    => $price,
  'meta_query'	=> array(
		array(
			'key'	 	=> 'products_type',
			'value'	  	=> array('finance', 'sale'),
		),
	),
);



$taxonomies = get_terms( array(
  'taxonomy' => 'products-brand',
  'hide_empty' => false
) );

$users = get_users( array( 'role__in' => array( 'vendor' ) ) );

if( $brand ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $brand,
    ),
  );
}

if( $vendor ) {
  $args['author'] = $vendor;
}

$posts = get_posts( $args );
$query = new WP_Query( $args );

?>



  <!-- Page Header Start -->
  <div class="container-fluid page-header" style="background-image:url('<?= get_the_post_thumbnail_url(get_the_ID(),'full'); ?>');">
      <h1 class="display-3 text-uppercase text-white mb-3">السيارات</h1>
      <div class="d-inline-flex text-white">
          <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
          <h6 class="text-body m-0 px-3">/</h6>
          <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
      </div>
  </div>
  <!-- Page Header Start -->


  <form action="" method="get">
    <!-- Search Start -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 px-2">
          <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" name="price">
            <option value="0">حسب السعر</option>
            <option value="ASC" <?= ($price == 'ASC')? 'selected':'';?>>اقل سعر </option>
            <option value="DESC" <?= ($price == 'DESC')? 'selected':'';?>>اعالي سعر </option>
          </select>
        </div>
        <div class="col-lg-3 col-md-6 px-2">
          <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="brand">
            <option value="0">نوع السيارة</option>
            <?php foreach ($taxonomies as $term): ?>
              <option value="<?= $term->term_id; ?>" <?= ($term->term_id == $brand)? 'selected':'';?>><?= $term->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-lg-3 col-md-6 px-2">
          <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" name="vendor">
            <option selected>المعرض</option>
            <?php foreach ($users as $user): ?>
              <option value="<?= $user->ID; ?>" <?= ($user->ID == $vendor)? 'selected':'';?>><?= $user->display_name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-lg-3 col-md-6 px-2">
            <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">بحث</button>
        </div>
      </div>
    </div>
  </form>  
  <!-- Search End -->


  <!-- Rent A Car Start -->
  <div class="container-fluid py-5">
      <div class="container pt-5 pb-3">
          <h1 class="display-4 text-uppercase text-center mb-5">البحث عن سيارة مناسبة</h1>
          <div class="row mt-5">

          <?php 
            if ( $posts ):
              foreach ( $posts as $post ):
                $img_url = get_the_post_thumbnail_url($post->ID,'full');
                $author_id = $post->post_author;
                $avatar = get_field('user_logo', 'user_'. $author_id);
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                  <div class="car-box">
                    <div class="car-box-img">
                      <a class="link-img" href="<?= get_permalink($post->ID); ?>"><img class="img-fluid" src="<?= $img_url; ?>" alt="<?= get_the_title($post->ID); ?>"></a>
                    </div>
                    <div class="car-box-content">
                      <h4 class="text-uppercase"><?= get_the_title($post->ID); ?></h4>
                      <div class="information">
                        <span class="price"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                        <span class="author">
                          <a class="logo-author" href="<?php echo get_author_posts_url($author_id); ?>"><img class="img-fluid" src="<?= $avatar; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
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
              endforeach;
            ?>

            <?php else: ?>
              <div class="alert alert-danger" role="alert">لا يوجد نتائج للبحث برجاء تغير حقول البحث</div>              
            <?php endif; ?>


          </div>
      </div>
  </div>
  <!-- Rent A Car End -->

  <div class="container">
    <?php echo custom_base_pagination(array(), $query); ?>
  </div>

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
