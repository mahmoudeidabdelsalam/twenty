<?php
/* 
  Template Name: Users Cars new
*/

get_header(); 

$city    = isset($_GET['city']) ? $_GET['city'] : '0';
$package    = isset($_GET['package']) ? $_GET['package'] : '0';
$search    = isset($_GET['search']) ? $_GET['search'] : '0';

$taxonomies_cities = get_terms( array(
  'taxonomy' => 'realestate-cities',
  'hide_empty' => false
) );

$taxonomies_package = get_terms( array(
  'taxonomy' => 'realestate-package',
  'hide_empty' => false,
  'parent'   => 0
) );

// WP_User_Query arguments
$args = array (
  'role' => 'vendor',
  'meta_query' => array(
    'relation' => 'OR',
    array(
        'key'     => 'vendor_cars_status',
        'value'   => "new",
        'compare' => 'LIKE'
    ),
    array(
      'key' => 'vendor_cars_status',
      'compare' => 'NOT EXISTS',
    ),
  )
);

if ($search) {
  $args = array (
    'fields' => 'all',
    'search'         => '*'.esc_attr( $search ).'*',
    'search_columns' => array( 'display_name' ),
    'role' => 'vendor',
    'order' => 'ASC',
    'orderby' => 'display_name',
    'meta_query' => array(
      'relation' => 'OR',
      array(
          'key'     => 'vendor_cars_status',
          'value'   => "new",
          'compare' => 'LIKE'
      ),
      array(
        'key' => 'vendor_cars_status',
        'compare' => 'NOT EXISTS',
      ),
    )
  );
}


if( $city && $package == 0) {
  $args['meta_query'] = array(
    'relation' => 'AND',
    array(
      'key' => 'cities',
      'value'    => $city,
      'compare'    => 'LIKE',
    ),
  );
}

if( $package && $city == 0 ) {
  $args['meta_query'] = array(
    'relation' => 'AND',
    array(
      'key' => 'package',
      'value'    => $package,
      'compare'    => 'LIKE',
    ),
  );
}


if( $city != 0 && $package != 0 ) {
  $args['meta_query'] = array(
    'relation' => 'AND',
    array(
      'key' => 'package',
      'value'    => $package,
      'compare'    => 'LIKE',
    ),
    array(
      'key' => 'cities',
      'value'    => $city,
      'compare'    => 'LIKE',
    ),    
  );
}


// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);

// Get the results
$users = $wp_user_query->get_results();
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

      <div class="col-12">
        <form action="" method="get" class="mb-5 float-right">
          <div class="row">
            <div class="col-lg-3 col-md-6 px-2">
              <input class="form-control px-4 mb-3" type="search" placeholder="اكتب اسم المعرض او الايميل" style="height: 50px; width: 100%;"  name="search">
            </div>
            <div class="col-lg-3 col-md-6 px-2">
              <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="city">
                <option value="0">على حسب المدينة</option>
                <?php foreach ($taxonomies_cities as $term_cities): ?>
                  <option value="<?= $term_cities->term_id; ?>" <?= ($term_cities->term_id == $city)? 'selected':'';?>><?= $term_cities->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>                  
            <div class="col-lg-3 col-md-6 px-2 pull-right">
              <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="package">
                <option value="0">على حسب التصنيف</option>
                <?php foreach ($taxonomies_package as $term_package): ?>
                  <option value="<?= $term_package->term_id; ?>" <?= ($term_package->term_id == $package)? 'selected':'';?>><?= $term_package->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>                  
            <div class="col-lg-3 col-md-6 px-2">
                <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">بحث</button>
            </div>
          </div>
        </form>
      </div>
      <?php 
      if($users):
        foreach ($users as $user): 
          $background = get_field('user_background', 'user_'. $user->ID);
          $package_id = get_field('package', 'user_'. $user->ID);
          $cities_id = get_field('cities', 'user_'. $user->ID);
          
          $package_term = get_term_by('id', $package_id, 'realestate-package');
          $cities_term = get_term_by('id', $cities_id, 'realestate-cities');

          $image = get_field('icon_term', $package_term);

          $user_address = get_field('user_address', 'user_'. $user->ID);
          $cars_status = get_field('vendor_cars_status', 'user_'. $user->ID);
          $query = new WP_Query( array( 'author' => $user->ID, 'post_type' => 'products' ) );
          $placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
        ?>
        <div class="col-md-4 col-12 mb-3" style="order: -<?= $query->found_posts; ?>">
          <div class="showroom car-box">
            <a class="logo-author" href="<?php echo get_author_posts_url($user->ID); ?>"><img class="img-fluid" src="<?= ($background)? $background:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $user->ID ); ?>"></a>
            <div class="meta-user car-box-content">
              <h4 class="text-uppercase"><?= the_author_meta( 'display_name', $user->ID ); ?></h4>
              <div class="information">
                <span><?= $user_address; ?></span>
                <span class="cars-status">
                  <?= $package_term->name; ?> <?php if($image): ?><img src="<?= $image; ?>" alt="<?= the_author_meta( 'display_name', $user->ID ); ?>"><?php endif; ?>
                </span>
                <span><?php printf( __( 'عدد السيارات: %s', 'textdomain' ), $query->found_posts ); ?></span>
              </div>
            </div>
            <div class="overlay">
              <i class="fa fa-arrow-circle-left"></i>
            </div>
          </div>
        </div>
      <?php 
        endforeach; 
      else: 
        echo 'لا يوجد معارض';
      endif;
        ?>

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

  .showrooms .row {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
  }
  
  .showrooms .col-12 {
    width: 100%;
  }

  .showrooms .col-md-4 {
      width: 33.333%;
  }
</style>
<?php
get_footer();
?>
