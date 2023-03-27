<?php
/* 
  Template Name: Users Cars
*/

get_header(); 

$users = get_users( array( 'role__in' => array( 'vendor' ) ) );


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

<section class="contsct-us-info mt-5 mb-5 showrooms">
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
        foreach ($users as $user): 
          $background = get_field('user_background', 'user_'. $user->ID);
          $user_address = get_field('user_address', 'user_'. $user->ID);
          $cars_status = get_field('vendor_cars_status', 'user_'. $user->ID);
          $query = new WP_Query( array( 'author' => $user->ID, 'post_type' => 'products' ) );
          $placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
        ?>
        <div class="col-md-4 col-12 mb-3">
          <div class="showroom car-box">
            <a class="logo-author" href="<?php echo get_author_posts_url($user->ID); ?>"><img class="img-fluid" src="<?= ($background)? $background:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $user->ID ); ?>"></a>
            <div class="meta-user car-box-content">
              <h4 class="text-uppercase"><?= the_author_meta( 'display_name', $user->ID ); ?></h4>
              <div class="information">
                <span><?= $user_address; ?></span>
                <span class="cars-status">
                  <?php 
                  if($cars_status == "new" || $cars_status == ""):
                      echo _e('سيارات جديدة', 'textdomain');
                    elseif($cars_status == "used"):
                      echo _e('سيارات مستعملة', 'textdomain');
                    elseif($cars_status == "new_used"):
                      echo _e('سيارات جديدة أو مستعملة', 'textdomain');
                  endif; 
                  ?>
                </span>
                <span><?php printf( __( 'عدد السيارات: %s', 'textdomain' ), $query->found_posts ); ?></span>
              </div>
            </div>
            <div class="overlay">
              <i class="fa fa-arrow-circle-left"></i>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<style>
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
