<?php
get_header(); 

global $wp_query;
$author = $wp_query->get_queried_object();

$paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
$price    = isset($_GET['price']) ? $_GET['price'] : '0';
$brand    = isset($_GET['brand']) ? $_GET['brand'] : '0';


$args = array(
  'post_type'      => 'products',
  'posts_per_page' => 18,
  'paged' => $paged,
  'author' => $author->ID
);

$taxonomies = get_terms( array(
  'taxonomy' => 'products-brand',
  'hide_empty' => false
) );

if( $brand ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $brand,
    ),
  );
}

$posts = get_posts( $args );
$query = new WP_Query( $args );

$user_phone = get_field('user_phone', 'user_'. $author->ID);
$user_whatsapp = get_field('user_whatsapp', 'user_'. $author->ID);
$user_logo = get_field('user_logo', 'user_'. $author->ID);
$user_background = get_field('user_background', 'user_'. $author->ID);
$user_content = get_field('user_content', 'user_'. $author->ID);
$package_id = get_field('package', 'user_'. $author->ID);
$map = get_field('map_user', 'user_'. $author->ID);
$package_term = get_term_by('id', $package_id, 'realestate-package');
$image = get_field('icon_term', $package_term);
?>

<!-- Page Header Start -->
<div class="container-fluid user-information">
  <div class="row">
      <div class="useer-header col-md-6 col-12 <?= ($user_phone || $user_whatsapp || $user_content)? "":"full-width"; ?>" style="background-color:#333; background-image:url(<?= $user_background; ?>);">
      <?php if($user_logo): ?>
        <div class="logo-author"><img class="img-fluid" src="<?= $user_logo; ?>" alt="<?= the_author_meta( 'display_name', $author->ID ); ?>"></div>
      <?php endif; ?>
      </div>

      <?php if($user_phone || $user_whatsapp || $user_content): ?>
        <div class="content-user col-md-6 col-12" style="background-color:#333; background-image:url(<?= $user_background; ?>);">
          
            <h1 class="display-3 text-uppercase text-dark"><?= $author->display_name; ?></h1>
            <div class="row phones">
              <?php if($user_phone): ?>
                <b>الهاتف :</b>
                <span><i class="fa fa-phone"></i> <a href="tel:<?= $user_phone; ?> "><?= $user_phone; ?> </a></span>
              <?php endif; ?>

              <?php
                if( have_rows('user_phones', 'user_'. $author->ID) ):
                  while ( have_rows('user_phones', 'user_'. $author->ID) ) : the_row(); 
                ?>
                  <span><i class="fa fa-phone"></i> <a href="tel:<?= the_sub_field('number_phone'); ?> "><?= the_sub_field('number_phone'); ?></a></span>
                <?php 
                  endwhile;
                endif;
              ?>
            </div>
            
            <div class="row phones">
              <?php if($user_whatsapp): ?>
                <b>الواتس :</b>
                <span><i class="fa fa-whatsapp"></i> <a href="https://wa.me/<?= $user_whatsapp; ?> "><?= $user_whatsapp; ?> </a></span>
              <?php endif; ?>

              <?php
                if( have_rows('user_whatsapps', 'user_'. $author->ID) ):
                  while ( have_rows('user_whatsapps', 'user_'. $author->ID) ) : the_row(); 
                ?>
                  <span><i class="fa fa-whatsapp"></i> <a href="https://wa.me/<?= the_sub_field('number_whatsapp'); ?> "><?= the_sub_field('number_whatsapp'); ?></a></span>
                <?php 
                  endwhile;
                endif;
              ?>
            </div>

            <?php if($map): ?>
              <div class="map-user"><?= $map; ?> </div>
            <?php endif; ?>
            
            <?php if($user_content): ?>
              <div><?= $user_content; ?> </div>
            <?php endif; ?>

            <a class="btn-form" href="https://twenty.sa/%d8%a7%d9%84%d8%a7%d8%a8%d9%84%d8%a7%d8%ba-%d8%b9%d9%86-%d8%a7%d8%b3%d8%a7%d8%a6%d9%87/?author=<?= the_author_meta( 'display_name', $author->ID ); ?>">الابلاغ عن اسائه</a>
          
        </div>
        <?php endif; ?>
  </div>
</div>
<!-- Page Header Start -->

<form action="" method="get">
  <!-- Search Start -->
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 px-2">
        <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" name="price">
          <option value="0">حسب السعر</option>
          <option value="ASC" <?= ($price == 'ASC')? 'selected':'';?>>اقل سعر </option>
          <option value="DESC" <?= ($price == 'DESC')? 'selected':'';?>>اعالي سعر </option>
        </select>
      </div>
      <div class="col-lg-4 col-md-6 px-2">
        <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="brand">
          <option value="0">نوع السيارة</option>
          <?php foreach ($taxonomies as $term): ?>
            <option value="<?= $term->term_id; ?>" <?= ($term->term_id == $brand)? 'selected':'';?>><?= $term->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-lg-4 col-md-6 px-2">
          <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">بحث</button>
      </div>
    </div>
  </div>
</form>  

<div class="no-sidebar-right">
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
              <div class="row">
                <?php
                if ( $query->have_posts() ):
                  while ( $query->have_posts() ):
                    $query->the_post();
                    $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                    $author_id = get_the_author_ID();
                    $avatar = get_field('user_logo', 'user_'. $author_id);
                    $placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
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
                <?php wp_reset_postdata(); ?>

                  <div class="col-md-12 mt-5">
                    <?php echo custom_author_pagination(array(), $query); ?>
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

<style>
.user-information .useer-header {
    background-size: cover;
    background-position: center;
    position: relative;
}

.user-information .useer-header * {
    z-index: 2;
    position: relative;
}

.user-information .content-user *:not(.btn-form) {
    text-align: right !important;
    width: 100%;
}

.user-information .row {
    justify-content: stretch;
    display: flex;
    flex-flow: row;
    flex-wrap: wrap;
}

.user-information .content-user iframe {
    width: 100%;
}

.user-information .content-user .map-user {
    width: 100%;
}

.user-information .content-user p {
    font-size: 22px;
}

.useer-header.full-width {
    padding: 0 !important;
}

.user-information .content-user .btn-form {
    border: 1px solid #fff;
    margin: 30px;
    padding: 10px 20px;
    border-radius: 4px;
    background: #d97e00;
}

.phones span {
    width: auto !important;
    display: flex;
    align-items: center;
    margin: 10px 15px;
}

.phones span i {
    margin: 0 10px;
    border: 1px solid #fff;
    padding: 10px;
    border-radius: 4px;
}
</style>
<?php
get_footer();
?>
