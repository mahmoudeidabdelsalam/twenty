<?php
get_header(); 
$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$brand    = isset($_GET['brand']) ? $_GET['brand'] : '0';
$parent    = isset($_GET['parent']) ? $_GET['parent'] : '0';
$model    = isset($_GET['model']) ? $_GET['model'] : '0';
$group    = isset($_GET['group']) ? $_GET['group'] : '0';
$price    = isset($_GET['price']) ? $_GET['price'] : '0';

$tax = $wp_query->get_queried_object();

$args = array(
  'post_type'        => array( 'cars', 'products' ),
  'posts_per_page' => 21,
  'paged' => $paged,
);

if($price != '0') {
  $args['meta_key'] = 'price';
  $args['orderby'] = 'meta_value_num';
  $args['order'] = $price;
}

$taxonomies = get_terms( array(
  'taxonomy' => 'products-brand',
  'hide_empty' => false
) );

$taxonomies_model = get_terms( array(
  'taxonomy' => 'products-model',
  'hide_empty' => false,
  'parent'   => 0
) );

$taxonomies_group = get_terms( array(
  'taxonomy' => 'products-group',
  'hide_empty' => false,
  'parent'   => 0
) );


$args['tax_query'] = array(
  'relation' => 'AND',
  array(
    'taxonomy' => 'products-tag',
    'field'    => 'term_id',
    'terms'    => $tax->term_id,
  ),
);

if( $brand &&  $model == 0) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $brand,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),
  );
}

if( $group ) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-group',
      'field'    => 'term_id',
      'terms'    => $group,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),
  );
}

if( $parent &&  $brand == 0) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $parent,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),
  );
}

if( $model && $brand != 0 ) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-model',
      'field'    => 'term_id',
      'terms'    => $model,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),    
  );
}


if( $model != 0 && $brand != 0 ) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-model',
      'field'    => 'term_id',
      'terms'    => $model,
    ),
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $brand,
    ),  
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),    
  );
}

$query = new WP_Query( $args );

$image = get_field('icon_term', $tax);
?>

<!-- Page Header Start -->
<div class="container-fluid page-header-tags">
  <img src="<?= $image; ?>" alt="banner">
  <h1 class="display-3 text-uppercase text-white mb-3"><?= $tax->name; ?></h1>
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
                  <div class="col-lg-2 col-md-6 px-2 pull-right">
                    <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="parent_brand" name="parent">
                      <option value="0">على حسب العلامة تجاريه</option>
                      <?php 
                        foreach ($taxonomies as $term): 
                          if( $term->parent == 0 ):
                        ?>
                        <option value="<?= $term->term_id; ?>" <?= ($term->term_id == $parent)? 'selected':'';?>><?= $term->name; ?></option>
                      <?php 
                          endif;
                        endforeach; 
                        ?>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-6 px-2 pull-right">
                    <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="child_brand"  name="brand">
                      <option value="0">على حسب الماركة</option>
                      <?php 
                        $categories=  get_categories('child_of='.$parent.'&hide_empty=1&taxonomy=products-brand');
                        foreach ($categories as $term): 
                        ?>
                        <option value="<?= $term->term_id; ?>" <?= ($term->term_id == $brand)? 'selected':'';?>><?= $term->name; ?></option>
                      <?php 
                        endforeach; 
                        ?>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-6 px-2">
                    <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" name="price">
                      <option value="0">حسب السعر</option>
                      <option value="ASC" <?= ($price == 'ASC')? 'selected':'';?>>اقل سعر </option>
                      <option value="DESC" <?= ($price == 'DESC')? 'selected':'';?>>اعالي سعر </option>
                    </select>
                  </div>                  
                  <div class="col-lg-2 col-md-6 px-2 pull-right">
                    <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="model">
                      <option value="0">على حسب الموديل</option>
                      <?php foreach ($taxonomies_model as $term_model): ?>
                        <option value="<?= $term_model->term_id; ?>" <?= ($term_model->term_id == $model)? 'selected':'';?>><?= $term_model->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>  
                  <div class="col-lg-2 col-md-6 px-2 pull-right">
                    <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="model">
                      <option value="0">على حسب الفئه</option>
                      <?php foreach ($taxonomies_group as $term_group): ?>
                        <option value="<?= $term_group->term_id; ?>" <?= ($term_group->term_id == $group)? 'selected':'';?>><?= $term_group->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>                  
                  <div class="col-lg-2 col-md-6 px-2">
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
              <?php if(get_field('sold_done')): ?>
                <div class="sold-done" style="position: absolute;z-index: 9;left: 15px;background: #d97e00e6;padding: 30px;bottom: 0;right: 15px;top: 0;pointer-events: none;">
                  <p><img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/pay_done.png' ?>" alt="تم البياع" /></p>
                </div>
              <?php endif; ?>              
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

<script type="text/javascript" >
  jQuery(function ($) {
    $('#parent_brand').on('change', function () {
      var parent_id = $('#parent_brand').find(":selected").val();;
      var action = 'ajax_child_brand';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_id: parent_id,
        },
        beforeSend: function () {
          $('#child_brand').html("");
        },
        success: function (response) {          
          $('#child_brand').append(response);
        },
      });
    });
  });
</script>

<?php
get_footer();
?>
