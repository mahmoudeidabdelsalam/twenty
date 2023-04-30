<?php
get_header(); 
$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';

$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;


$brand        = isset($_GET['parent_brand_id']) ? $_GET['parent_brand_id'] : '0';
$child_brand  = isset($_GET['child_brand_id']) ? $_GET['child_brand_id'] : '0';
$model_id     = isset($_GET['model_id']) ? $_GET['model_id'] : '0';
$model        = isset($_GET['model']) ? $_GET['model'] : '0';

$price_from   = isset($_GET['price_from']) ? $_GET['price_from'] : '0';
$price_to     = isset($_GET['price_to']) ? $_GET['price_to'] : '0';
$walkway      = isset($_GET['walkway']) ? $_GET['walkway'] : '0';
$colors       = isset($_GET['colors']) ? $_GET['colors'] : '0';

$per_page = 21;

if($price_from && $price_to) {
  $per_page = -1;
}

$tax = $wp_query->get_queried_object();

$args = array(
  'post_type'        => array( 'cars', 'products' ),
  'posts_per_page' => $per_page,
  'paged' => $paged,
);

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

if( $brand && $child_brand == 0 && $model_id == 0 && $model == 0 ) {
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
} elseif( $child_brand && $model_id == 0 && $model == 0 ) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $child_brand,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),
  );
} elseif ($model_id && $model == 0) {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $child_brand,
    ),
    array(
      'taxonomy' => 'products-group',
      'field'    => 'term_id',
      'terms'    => $model_id,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),
  );
} elseif($brand && $model && $child_brand == 0) {
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
    array(
      'taxonomy' => 'products-model',
      'field'    => 'term_id',
      'terms'    => $model,
    ),
  );
} elseif($brand && $model && $child_brand && $model_id == 0)  {
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $child_brand,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),
    array(
      'taxonomy' => 'products-model',
      'field'    => 'term_id',
      'terms'    => $model,
    ),
  );
}  elseif($brand && $model && $child_brand && $model_id)  {
  $args['tax_query'] = array(
    'relation' => 'AND',  
    array(
      'taxonomy' => 'products-brand',
      'field'    => 'term_id',
      'terms'    => $child_brand,
    ),    
    array(
      'taxonomy' => 'products-group',
      'field'    => 'term_id',
      'terms'    => $model_id,
    ),
    array(
      'taxonomy' => 'products-tag',
      'field'    => 'term_id',
      'terms'    => $tax->term_id,
    ),
    array(
      'taxonomy' => 'products-model',
      'field'    => 'term_id',
      'terms'    => $model,
    ),
  );
}

$query = new WP_Query( $args );
$image = get_field('icon_term', $tax);
?>

<!-- Page Header Start -->
<div class="container-fluid page-header-tags p-0">
  <img src="<?= $image; ?>" alt="banner">
  <h1 class="display-3 text-uppercase text-white mb-3"><?= $tax->name; ?></h1>
</div>

<!-- Page section -->

<section class="contsct-us-info mt-5 mb-5">
  <div class="row m-0">
    
    <div class="col-md-3 col-12 pt-2">
      <div class="ads-finance">
        <a href="<?= the_field('ads_link_real', 'option'); ?>"><img src="<?= the_field('ads_images_real', 'option'); ?>" alt="ads"></a>
      </div>

      <div class="search-cars">
        <form action="" method="get" class="mb-5 mt-5 float-right">
          <div class="row">

            <div class="col-lg-12 col-md-12 px-2 pull-right custom-dropdown">
              <div class="dropdown custom-select px-4 mb-3">
                <button id="parent_brand" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 50px; width: 100%;">
                  <?php 
                    if($brand): 
                    $term_name = get_term( $brand )->name;
                    $categories=  get_categories('parent='.$brand.'&hide_empty=1&taxonomy=products-brand');
                    if($categories) {
                        foreach ($categories as $cat) {
                            $option .= '<option value="'.$cat->term_id.'">';
                            $option .= $cat->cat_name;
                            $option .= '</option>';
                        }
                    }
                  ?>
                    <b id="parent_brand_text"><?= $term_name; ?></b>
                  <?php else: ?>
                    <b id="parent_brand_text">العلامة تجاريه</b>
                  <?php endif; ?>
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="parent_brand">
                  <?php 
                    foreach ($taxonomies as $term): 
                      if( $term->parent == 0 ):
                      $image = get_field('icon_term', $term);
                    ?>
                    <li>
                      <input type="radio" name="parent_brand_id" id="parent_brand_id<?= $term->term_id; ?>" data-text="<?= $term->name; ?>" value="<?= $term->term_id; ?>" <?= ($term->term_id == $brand)? 'checked':'';?>>
                      <label for="parent_brand_id<?= $term->term_id; ?>"><?= $term->name; ?> <img width="64" src="<?= $image; ?>" alt="<?= $term->name; ?>"></label>                      
                    </li>
                  <?php 
                      endif;
                    endforeach; 
                ?>
                </ul>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 px-2 pull-right">
              <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="child_brand"  name="child_brand_id">
                  <?php 
                    if($child_brand): 
                    $term_name = get_term( $child_brand )->name;
                    ?>
                     <option value="<?= $child_brand; ?>"><?= $term_name; ?></option>
                     <?php echo $option; ?>
                  <?php else: ?>
                    <?php if($brand): ?>
                      <?php echo '<option value="0" selected="selected">اختار الماركة</option>'.$option; ?>
                    <?php else: ?>
                      <option value="0">الماركة</option>
                    <?php endif; ?>
                  <?php endif; ?>
              </select>
            </div>
            
            <div class="col-lg-12 col-md-12 px-2 pull-right">
              <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="model"  name="model_id">
                  <?php 
                    if($model_id): 
                    $term_model = get_term( $model_id )->name;
                  ?>
                    <option value="<?= $model_id; ?>"><?= $term_model; ?></option>
                  <?php else: ?>
                    <option value="0">الفئه</option>
                  <?php endif; ?>
              </select>
            </div>

            <div class="col-lg-12 col-md-12 px-2 pull-right">
              <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;"  name="model">
                <option value="0">سنة الصنع</option>
                <?php foreach ($taxonomies_model as $term_model): ?>
                  <option value="<?= $term_model->term_id; ?>" <?= ($term_model->term_id == $model)? 'selected':'';?>><?= $term_model->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            
            <div class="col-lg-12 col-md-12 px-2 pull-right">
              <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="colors"  name="colors">
                <option value="0">جميع الالوان</option>
              </select>
            </div>

            <div class="col-lg-12 col-md-12 px-2 inputs-group">
              <label>السعر</label>
              <input type="number" name="price_from"  placeholder="من" id="price_from">
              <input type="number" name="price_to" placeholder="الي" id="price_to">
            </div>

            <?php if($tax->term_id != "17"): ?>
              <div class="col-lg-12 col-md-12 px-2 inputs-group">
                <label>الممشى (اقل من)</label>
                <input type="number" name="walkway" placeholder="بالكيلو" id="walkway">
              </div>
            <?php endif; ?>

            <div class="col-lg-12 col-md-12 px-2">
                <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">أظهر النتائج</button>
            </div>

            <div class="loading" style="display: none;">
              <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
              </div>
            </div>
            
          </div>
        </form>
      </div>

      <div class="ads-finance">
        <a href="<?= the_field('ads_link_real_2', 'option'); ?>"><img src="<?= the_field('ads_images_real_2', 'option'); ?>" alt="ads"></a>
      </div>
    </div>

    <div class="col-md-9 col-12">
      <div class="row">
      <?php
        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
            $author_id = get_the_author_ID();
            $avatar = get_field('user_logo', 'user_'. $author_id);

            $price = get_field('price');

            if($price_from && $price_to  && $price >= $price_from && $price <= $price_to):

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
        <?php elseif(empty($price_from) || empty($price_to)): ?>
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
        <?php endif; ?>          
        <?php endwhile; ?>
          <div class="col-md-12 mt-5"><?php echo custom_base_pagination(array(), $query); ?></div>
        <?php else: ?>
          <div class="alert alert-danger" role="alert">لا يوجد نتائج للبحث برجاء تغير حقول البحث</div>              
        <?php endif; wp_reset_postdata(); ?>
      </div>
    </div>

  </div>
</section>

<script type="text/javascript" >
  jQuery(function ($) {

    // change parent brand
    $('input[type=radio][name=parent_brand_id]').change(function() {
      
      var dataText = $(this).attr("data-text");
      $('#parent_brand_text').html(dataText);

      var parent_id = this.value;
      var action = 'ajax_products_brand';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_id: parent_id,
        },
        beforeSend: function () {
          $('#child_brand').html("");
          $('.loading').show();
        },
        success: function (response) {          
          $('#child_brand').append(response);
          $('.loading').hide();
        },
        error: function(response) {
          $('.loading').hide();
        }
      });
    });

    // change child model
    $('#child_brand').on('change', function () {
      var parent_id = $('#child_brand').find(":selected").val();
      var tag_type =  <?= $tax->term_id; ?>;
      var action = 'ajax_child_products_brand';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_id: parent_id,
          tag_type: tag_type,
        },
        beforeSend: function () {
          $('#model').html("");
          $('.loading').show();
        },
        success: function (response) {          
          $('#model').append(response);
          $('.loading').hide();
        },
        error: function(response) {
          alert(response);
          $('.loading').hide();
        }
      });
    });

    $( window ).load(function() {
      var tag_id = <?= $tax->term_id; ?>;
      var action = 'ajax_color_selected';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          tag_id: tag_id,
        },
        beforeSend: function () {
          $('#colors').html("");
        },
        success: function (response) {          
          $('#colors').append(response);
        },
      });
    });
  });
</script>

<?php
get_footer();
?>
