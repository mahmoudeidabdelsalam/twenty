<?php

// // Register Basic custom Post Type
function basic_specifications_post_type() {
  $labels = array(
      'name' => __('المواصفات الاساسية', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('المواصفات الاساسية', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('المواصفات الاساسية', 'post-type'),
      'parent_item_colon' => __('Parent المواصفات:', 'post-type'),
      'all_items' => __('الكل', 'post-type'),
      'view_item' => __('عرض المواصفات', 'post-type'),
      'add_new_item' => __('اضاف المواصفات', 'post-type'),
      'add_new' => __('اضاف المواصفات', 'post-type'),
      'edit_item' => __('تعديل', 'post-type'),
      'update_item' => __('تحديث', 'post-type'),
      'search_items' => __('بحث', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-car',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,


  );
  register_post_type('basic_specifications', $args);
}

// Hook into the 'init' action
add_action('init', 'basic_specifications_post_type', 0);

// // Register Cars custom Post Type
function cars_post_type() {
  $labels = array(
      'name' => __('سيارة جديدة', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('سيارة جديدة', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('سيارة جديدة', 'post-type'),
      'parent_item_colon' => __('Parent سيارة:', 'post-type'),
      'all_items' => __('الكل', 'post-type'),
      'view_item' => __('عرض السيارة', 'post-type'),
      'add_new_item' => __('اضاف سيارة', 'post-type'),
      'add_new' => __('اضاف سيارة', 'post-type'),
      'edit_item' => __('تعديل', 'post-type'),
      'update_item' => __('تحديث', 'post-type'),
      'search_items' => __('بحث', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-car',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,
  );
  register_post_type('cars', $args);
}

// Hook into the 'init' action
add_action('init', 'cars_post_type', 0);

register_taxonomy( 
  'basic-brand', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'الماركة','taxonomy general name'), 
    'singular_name' => __( 'الماركة', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'fuel-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'نوع الوقود','taxonomy general name'), 
    'singular_name' => __( 'نوع الوقود', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'gear-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'نوع القير','taxonomy general name'), 
    'singular_name' => __( 'نوع القير', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'push-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'نوع الدفع','taxonomy general name'), 
    'singular_name' => __( 'نوع الدفع', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'cylinders-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'عدد السلندرات','taxonomy general name'), 
    'singular_name' => __( 'عدد السلندرات', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'engine-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'حجم المحرك','taxonomy general name'), 
    'singular_name' => __( 'حجم المحرك', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'color-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'الالوان','taxonomy general name'), 
    'singular_name' => __( 'الالوان', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

/*
  Plugin Name: ajax basic brand
*/
add_action('wp_ajax_ajax_basic_brand', 'ajax_basic_brand', 0);
add_action('wp_ajax_nopriv_ajax_basic_brand', 'ajax_basic_brand');

function ajax_basic_brand() {
    if ( isset( $_POST['parent_id'] ) ) {
      $categories=  get_categories('parent='.$_POST['parent_id'].'&hide_empty=1&taxonomy=basic-brand');
      if($categories) {
          foreach ($categories as $cat) {
              $option .= '<option value="'.$cat->term_id.'">';
              $option .= $cat->cat_name;
              $option .= '</option>';
          }
          echo '<option value="0" selected="selected">اختار الماركة</option>'.$option;
          die();
      } else {
          echo '<option value="0" selected="selected">لا يوجد ماركة</option>';
      }
    }
    die;
}

/*
Plugin Name: ajax child basic brand
*/
add_action('wp_ajax_ajax_child_basic_brand', 'ajax_child_basic_brand', 0);
add_action('wp_ajax_nopriv_ajax_child_basic_brand', 'ajax_child_basic_brand');

function ajax_child_basic_brand() {
    if ( isset( $_POST['parent_id'] ) ) {
      $categories=  get_categories('parent='.$_POST['parent_id'].'&hide_empty=1&taxonomy=basic-brand');
      if($categories) {
          foreach ($categories as $cat) {
              $option .= '<option value="'.$cat->term_id.'">';
              $option .= $cat->cat_name;
              $option .= '</option>';
          }
          echo '<option value="0" selected="selected">اختار الموديل</option>'.$option;
          die();
      } else {
          echo '<option value="0" selected="selected">لا يوجد الموديل</option>';
      }
    }
    die;
}

/*
  Plugin Name: ajax products-brand brand
*/
add_action('wp_ajax_ajax_products_brand', 'ajax_products_brand', 0);
add_action('wp_ajax_nopriv_ajax_products_brand', 'ajax_products_brand');

function ajax_products_brand() {
    if ( isset( $_POST['parent_id'] ) ) {
      $categories=  get_categories('parent='.$_POST['parent_id'].'&hide_empty=1&taxonomy=products-brand');
      if($categories) {
          foreach ($categories as $cat) {
              $option .= '<option value="'.$cat->term_id.'">';
              $option .= $cat->cat_name;
              $option .= '</option>';
          }
          echo '<option value="0" selected="selected">اختار الماركة</option>'.$option;
          die();
      } else {
          echo '<option value="0" selected="selected">لا يوجد ماركة</option>';
      }
    }
    die;
}

/*
Plugin Name: ajax child products brand
*/
add_action('wp_ajax_ajax_child_products_brand', 'ajax_child_products_brand', 0);
add_action('wp_ajax_nopriv_ajax_child_basic_brand', 'ajax_child_products_brand');

function ajax_child_products_brand() {
    if ( isset( $_POST['parent_id'] ) ) {

      $args = array(
        'post_type' => 'products',
        'posts_per_page' => -1,
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'products-brand',
            'field' => 'term_id',
            'terms' => $_POST['parent_id'],
          ),
          array(
            'taxonomy' => 'products-tag',
            'field' => 'term_id',
            'terms' => $_POST['tag_type'],
          ),
        ),
      );
      $the_query = new WP_Query( $args );

      $terms = [];
      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          $term_obj = get_the_terms( get_the_ID(), 'products-group' );
          $terms[$term_obj[0]->term_id] = $term_obj[0];
        }
      }

      $categories = $terms;
      if($categories) {
          foreach ($categories as $cat) {
              $option .= '<option value="'.$cat->term_id.'">';
              $option .= $cat->name;
              $option .= '</option>';
          }
          echo '<option value="0" selected="selected">اختار الفئه</option>'.$option;
          die();
      } else {
          echo '<option value="0" selected="selected">لا يوجد الفئه</option>';
      }
    }
    die;
}




/*
  Plugin Name: ajax color_selected
*/
add_action('wp_ajax_ajax_color_selected', 'ajax_color_selected', 0);
add_action('wp_ajax_nopriv_ajax_color_selected', 'ajax_color_selected');

function ajax_color_selected() {
    if ( isset( $_POST['tag_id'] ) ) {
      $args = array(
        'post_type' => 'products',
        'posts_per_page' => -1,
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'products-tag',
            'field' => 'term_id',
            'terms' => $_POST['tag_id'],
          ),
        ),
      );
      $the_query = new WP_Query( $args );

      $colors = [];
      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          $colors[] = get_field('color_car');
        }
      }

      $arr_colors = array_unique($colors);
      if($arr_colors) {
        foreach ($arr_colors as $color) {
          if(empty($color)) {
            $option .= '<option value="0">';
            $option .= 'جميع الالوان';
            $option .= '</option>';
          } else {
            $option .= '<option value="'.$color.'">';
            $option .= $color;
            $option .= '</option>';
          }
        }
          echo '<option value="0" selected="selected">اختار اللون</option>'.$option;
          die();
      } else {
          echo '<option value="0" selected="selected">اي لون</option>';
      }

    }
    die;
}




/*
  Plugin Name: ajax car
*/
add_action('wp_ajax_ajax_child_car', 'ajax_child_car', 0);
add_action('wp_ajax_nopriv_ajax_child_car', 'ajax_child_car');

function ajax_child_car() {
    if ( isset( $_POST['model_id'] ) ) {
      $args = array(
        'post_type' => 'basic_specifications',
        'posts_per_page' => -1,
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'basic-brand',
            'field' => 'term_id',
            'terms' => $_POST['model_id'],
          ),
        ),
      );
      $the_query = new WP_Query( $args );

      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          $option .= '<option value="'.get_the_ID().'">';
          $option .= get_the_title();
          $option .= '</option>';
        }
        echo '<option value="0" selected="selected">اختار السيارة</option>'.$option;
        die();
      } else {
        echo '<option value="0" selected="selected">لا يوجد سيارة</option>';
      }
    }
    die;
}

/*
  Plugin Name: ajax car basic specifications
*/
add_action('wp_ajax_ajax_get_basic_specifications', 'ajax_get_basic_specifications', 0);
add_action('wp_ajax_nopriv_ajax_get_basic_specifications', 'ajax_get_basic_specifications');

function ajax_get_basic_specifications() {
  if ( isset( $_POST['car_id'] )  ) {

    $car = get_post($_POST['car_id']);

    $featured_img_url = get_the_post_thumbnail_url($car->ID,'full');
    $featured_img_id = get_post_thumbnail_id( $car->ID );
    $images = get_field('car_galleries', $car->ID);

    $specifications = get_field('specifications', $car->ID);
    $specifications_comforts = get_field('specifications_comforts', $car->ID);
    $specifications_technologies = get_field('specifications_technologies', $car->ID);
    $specifications_external_equipment = get_field('specifications_external_equipment', $car->ID);


    $term_obj_list = get_the_terms( $car->ID, 'basic-brand' );
    $brands = join(', ', wp_list_pluck($term_obj_list, 'name'));

    $term_fuel_list = get_the_terms( $car->ID, 'fuel-type' );
    $fuels = join(', ', wp_list_pluck($term_fuel_list, 'name'));

    $term_gear_list = get_the_terms( $car->ID, 'gear-type' );
    $gears = join(', ', wp_list_pluck($term_gear_list, 'name'));

    $term_push_list = get_the_terms( $car->ID, 'push-type' );
    $pushs = join(', ', wp_list_pluck($term_push_list, 'name'));

    $term_cylinders_list = get_the_terms( $car->ID, 'cylinders-type' );
    $cylinders = join(', ', wp_list_pluck($term_cylinders_list, 'name'));

    $term_engine_list = get_the_terms( $car->ID, 'engine-type' );
    $engines = join(', ', wp_list_pluck($term_engine_list, 'name'));    
    ?>

    <section id="set_specifications">
      <div class="col-lg-12 col-md-12 px-2">
        <label for="#name" class="is-require">اسم السيارة</label>
        <input type="text" id="car_name" placeholder="اكتب اسم السيارة هنا" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;">
      </div>
      <?php if($brands): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>العلامة التجارة</h3>
            <p><?= $brands; ?></p>
        </div>
      <?php endif; ?>

      <?php if($fuels): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع الوقود</h3>
            <p><?= $fuels; ?></p>
        </div>
      <?php endif; ?>

      <?php if($gears): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع القير</h3>
            <p><?= $gears; ?></p>
        </div>
      <?php endif; ?>

      <?php if($pushs): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع الدفع</h3>
            <p><?= $pushs; ?></p>
        </div>
      <?php endif; ?>

      <?php if($cylinders): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>عدد الاسطوانات</h3>
            <p><?= $cylinders; ?></p>
        </div>
      <?php endif; ?>

      <?php if($engines): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع المحرك</h3>
            <p><?= $engines; ?></p>
        </div>
      <?php endif; ?>


      <div class="col-lg-12 px-2">
        <h6>الصور <span>(اول صورة هي الصورة الرئيسية)</span></h6>
        <div class="images">
          <div><img class="img-fluid" src="<?= $featured_img_url; ?>" alt="<?= the_title(); ?>"></div>
          <?php foreach( $images as $image ): ?>
            <div><img src="<?= $image['url']; ?>" alt="slide"></div>
          <?php endforeach; ?>
        </div>
      </div>

      <?php if($specifications): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>الأمان</h3>
        <?php 
          foreach( $specifications as $specification ): 
            $icon = $specification['icon_specifications'];
            $text = $specification['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if($specifications_comforts): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>الراحة</h3>
        <?php 
          foreach( $specifications_comforts as $comforts ): 
            $icon = $comforts['icon_specifications'];
            $text = $comforts['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if($specifications_technologies): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>التقنيات</h3>
        <?php 
          foreach( $specifications_technologies as $technologies ): 
            $icon = $technologies['icon_specifications'];
            $text = $technologies['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if($specifications_external_equipment): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>تجهيزات خارجية</h3>
        <?php 
          foreach( $specifications_external_equipment as $external_equipment ): 
            $icon = $external_equipment['icon_specifications'];
            $text = $external_equipment['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </section>
  <?php
  }
  
  die();
}

/*
  Plugin Name: ajax car add new
*/
add_action('wp_ajax_get_add_new_car', 'get_add_new_car', 0);
add_action('wp_ajax_nopriv_get_add_new_car', 'get_add_new_car');

function get_add_new_car() {

  $car_name = $_POST['car_name'];
  $car_id = $_POST['car_id'];
  $car_price = $_POST['car_price'];

  $car_tag = $_POST['car_tag'];
  $car_model = $_POST['car_model'];
  
  $car_color = $_POST['car_color'];
  $car_km = $_POST['car_km'];
  $car_number = $_POST['car_number'];


  $current_user = wp_get_current_user();
  $author_id = $current_user->ID;


  if ($car_id && $car_tag && $car_model && $car_price && $car_color && $car_name) {

    // Create post object
    $post = array(
      'post_title'    => wp_strip_all_tags( $_POST['car_name'] ),
      'post_status'   => 'pending',
      'post_author'   => $author_id,
      'post_type' => 'cars',
    );

    // Insert the post into the database
    $post_id =  wp_insert_post( $post );

    if ($post_id) {
      // UPDATE POST META
      update_field('id_basic_specifications', $car_id, $post_id);
      update_field('price', $car_price, $post_id);
      update_field('color_car', $car_color, $post_id);
      update_field('km_car', $car_km, $post_id);
      update_field('number_car', $car_number, $post_id);
      
      // UPDATE TAXONOMY
      wp_set_post_terms( $post_id, $car_tag, 'products-tag' );
      wp_set_post_terms( $post_id, $car_model, 'products-model' );

      echo 'success';
    } else {
      echo 'error';
    }
  } else {
    echo 'error';
  }
    
  die();
}
  
/*
  Plugin Name: ajax update users
*/
add_action('wp_ajax_get_update_user', 'get_update_user', 0);
add_action('wp_ajax_nopriv_get_update_user', 'get_update_user');

function get_update_user() {

  $user_name    = $_POST['user_name'];
  $current_user = wp_get_current_user();
  $user_data = wp_update_user( array ('ID' => $current_user->ID, 'display_name' => $user_name));

  if ( is_wp_error( $user_data ) ) {
    // There was an error; possibly this user doesn't exist.
    echo 'Error.';
  } else {
    // Success!
    update_field( 'user_address', $_POST['user_address'], 'user_'.$current_user->ID );
    update_field( 'user_phone', $_POST['user_phone'], 'user_'.$current_user->ID );
    update_field( 'user_whatsapp', $_POST['user_whats'], 'user_'.$current_user->ID );
    update_field( 'map_user', $_POST['user_map'], 'user_'.$current_user->ID );
    update_field( 'user_content', $_POST['user_content'], 'user_'.$current_user->ID );  
    if ($_POST['user_logo']) {
      update_field( 'user_logo', $_POST['user_logo'], 'user_'.$current_user->ID );
    }
    if ($_POST['user_background']) {
      update_field( 'user_background', $_POST['user_background'], 'user_'.$current_user->ID );
    }
    echo 'User profile updated.';
  }

  die();
}
  

acf_add_local_field_group(array(
  'key' => 'group_622db21dasds9d7c8a',
  'title' => 'Cars Specifications',
  'fields' => array(
    array(
      'key' => 'field_622dc0344addas31qeeq2lkk31232321328119',
      'label' => 'صور السيارة',
      'name' => 'car_galleries',
      'type' => 'gallery',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'preview_size' => 'medium',
      'insert' => 'append',
      'library' => 'all',
      'min' => '',
      'max' => '',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),

    // المواصفات
    // مواصفات الامان
    array(
      'key' => 'field_622db8e4sadd52ccb',
      'label' => 'الأمان',
      'name' => 'specifications',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 0,
      'max' => 0,
      'layout' => 'table',
      'button_label' => 'اضف وصف',
      'sub_fields' => array(
        array(
          'key' => 'field_622dbdsdas8ec52ccc',
          'label' => 'ايقونة الوصف',
          'name' => 'icon_specifications',
          'aria-label' => '',
          'type' => 'font-awesome',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'icon_sets' => array(
            0 => 'all',
          ),
          'custom_icon_set' => '',
          'default_label' => '&amp;#xf1b9; car',
          'default_value' => 'fa-car',
          'save_format' => 'class',
          'allow_null' => 0,
          'show_preview' => 1,
          'enqueue_fa' => 0,
          'fa_live_preview' => '',
          'choices' => array(),
        ),
        array(
          'key' => 'field_622db90sad052ccd',
          'label' => 'الوصف',
          'name' => 'text_specifications',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
      ),
    ),



    // مواصفات الراحة
    array(
      'key' => 'field_622db414414148adsdae452ccb',
      'label' => 'الراحة',
      'name' => 'specifications_comforts',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 0,
      'max' => 0,
      'layout' => 'table',
      'button_label' => 'اضف وصف',
      'sub_fields' => array(
        array(
          'key' => 'field_622db8e4214124saddsa21412414555c52ccc',
          'label' => 'ايقونة الوصف',
          'name' => 'icon_specifications',
          'aria-label' => '',
          'type' => 'font-awesome',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'icon_sets' => array(
            0 => 'all',
          ),
          'custom_icon_set' => '',
          'default_label' => '&amp;#xf1b9; car',
          'default_value' => 'fa-car',
          'save_format' => 'class',
          'allow_null' => 0,
          'show_preview' => 1,
          'enqueue_fa' => 0,
          'fa_live_preview' => '',
          'choices' => array(),
        ),
        array(
          'key' => 'field_622db905125sadds12qwq14052ccd',
          'label' => 'الوصف',
          'name' => 'text_specifications',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
      ),
    ),



    // مواصفات التقنيات
    array(
      'key' => 'field_622db84124sdae12asda31321312341241241241e452ccb',
      'label' => 'التقنيات',
      'name' => 'specifications_technologies',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 0,
      'max' => 0,
      'layout' => 'table',
      'button_label' => 'اضف وصف',
      'sub_fields' => array(
        array(
          'key' => 'field_622db84124dad2sdasd2133123123ec52ccc',
          'label' => 'ايقونة الوصف',
          'name' => 'icon_specifications',
          'aria-label' => '',
          'type' => 'font-awesome',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'icon_sets' => array(
            0 => 'all',
          ),
          'custom_icon_set' => '',
          'default_label' => '&amp;#xf1b9; car',
          'default_value' => 'fa-car',
          'save_format' => 'class',
          'allow_null' => 0,
          'show_preview' => 1,
          'enqueue_fa' => 0,
          'fa_live_preview' => '',
          'choices' => array(),
        ),
        array(
          'key' => 'field_622db903ddas213dsadsad41412414052ccd',
          'label' => 'الوصف',
          'name' => 'text_specifications',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
      ),
    ),


    // مواصفات تجهيزات خارجية
    array(
      'key' => 'field_622db812323qadqwwqee12e1232133sae452ccb',
      'label' => 'تجهيزات خارجية',
      'name' => 'specifications_external_equipment',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 0,
      'max' => 0,
      'layout' => 'table',
      'button_label' => 'اضف وصف',
      'sub_fields' => array(
        array(
          'key' => 'field_622db8ec52wqwqwqwqewqeqweasddasddccc',
          'label' => 'ايقونة الوصف',
          'name' => 'icon_specifications',
          'aria-label' => '',
          'type' => 'font-awesome',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'icon_sets' => array(
            0 => 'all',
          ),
          'custom_icon_set' => '',
          'default_label' => '&amp;#xf1b9; car',
          'default_value' => 'fa-car',
          'save_format' => 'class',
          'allow_null' => 0,
          'show_preview' => 1,
          'enqueue_fa' => 0,
          'fa_live_preview' => '',
          'choices' => array(),
        ),
        array(
          'key' => 'field_622db90052qwwdqweqsdadasdasdqwewqeccd',
          'label' => 'الوصف',
          'name' => 'text_specifications',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
      ),
    ),


  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'basic_specifications',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'acf_after_title',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
  'show_in_rest' => 0,
));



acf_add_local_field_group(array(
  'key' => 'group_622db2dasdad1dasds9d7c8a',
  'title' => 'Cars Specifications',
  'fields' => array(

		array(
			'key' => 'field_636f7af8e7986',
			'label' => 'المواصفات الاساسية',
			'name' => 'id_basic_specifications',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'basic_specifications',
			),
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
			'ui' => 1,
		),

    array(
      'key' => 'field_622db4saddab45ebbd',
      'label' => 'سعر الكاش',
      'name' => 'price',
      'type' => 'number',
      'instructions' => 'ادخل السعر شامل الضريبة',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array(
      'key' => 'field_622dasdb89d5ebbf',
      'label' => 'رقم اللوحــة',
      'name' => 'number_car',
      'type' => 'text',
      'instructions' => 'رقم اللوحــة',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),

    array(
      'key' => 'field_432622sdadsadb89324d5ebbf',
      'label' => 'اللــــــــــون',
      'name' => 'color_car',
      'type' => 'text',
      'instructions' => 'الالوان',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),

    array(
      'key' => 'field_624232ddadb8432439d5e21213123bbf',
      'label' => '(الممشى (عدد الكيلوات',
      'name' => 'km_car',
      'type' => 'text',
      'instructions' => '(الممشى (عدد الكيلوات',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),

    array(
      'key' => 'field_622dc0344addas312lkk31232321328119',
      'label' => 'صور السيارة',
      'name' => 'car_galleries',
      'type' => 'gallery',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'preview_size' => 'medium',
      'insert' => 'append',
      'library' => 'all',
      'min' => '',
      'max' => '',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),

    // مواصفات خاصة 
    array(
      'key' => 'field_622db812323qa3qqwe42422343wfe2e1232133sae452ccb',
      'label' => 'مواصفات خاصة',
      'name' => 'specifications_special',
      'type' => 'repeater',
      'instructions' => 'مواصفات خاصة بالسيارات المستعملة',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 0,
      'max' => 0,
      'layout' => 'table',
      'button_label' => 'اضف وصف',
      'sub_fields' => array(
        array(
          'key' => 'field_622db8ec5werr21232wqewqeqwasaddfeasddasddccc',
          'label' => 'ايقونة الوصف',
          'name' => 'icon_specifications',
          'aria-label' => '',
          'type' => 'font-awesome',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'icon_sets' => array(
            0 => 'all',
          ),
          'custom_icon_set' => '',
          'default_label' => '&amp;#xf1b9; car',
          'default_value' => 'fa-car',
          'save_format' => 'class',
          'allow_null' => 0,
          'show_preview' => 1,
          'enqueue_fa' => 0,
          'fa_live_preview' => '',
          'choices' => array(),
        ),
        array(
          'key' => 'field_622db90052qweweqsdffafadasdasdqwewqeccd',
          'label' => 'الوصف',
          'name' => 'text_specifications',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
      ),
    ),


  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'cars',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'acf_after_title',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
  'show_in_rest' => 0,
));

function formatPost(&$post){
  unset($post->post_title, $post->post_author, $post->post_date, $post->post_modified, $post->post_date_gmt, $post->post_content, $post->comment_status, $post->ping_status, $post->post_password, $post->to_ping, $post->pinged, $post->post_modified_gmt, $post->post_content_filtered, $post->post_parent, $post->guid, $post->post_mime_type);
  unset($post->comment_count, $post->comment_count, $post->filter, $post->menu_order, $post->post_status);

}

function pn_upload_files() {
  //Do the nonce security check

  $current_user = wp_get_current_user();
  
  if ( !isset($_POST['mynonce']) || !wp_verify_nonce( $_POST['mynonce'], 'myuploadnonce' ) ) {
      //Send the security check failed message
      _e( 'Security Check Failed', 'pixelnet' ); 
  } else {
      //Security check cleared, let's proceed
      //If your form has other fields, process them here.
      if ( isset($_FILES) && !empty($_FILES) ) {
          //Include the required files from backend
          require_once( ABSPATH . 'wp-admin/includes/image.php' );
          require_once( ABSPATH . 'wp-admin/includes/file.php' );
          require_once( ABSPATH . 'wp-admin/includes/media.php' );
          //Check if uploaded file doesn't contain any error
          if ( isset($_FILES['myfilefield']['error']) && $_FILES['myfilefield']['error'] == 0 ) {
              /*
               * 'myfilefield' is the name of the file upload field.
               * Replace the second parameter (0) with the post id
               * you want your file to be attached to
               */
              $file_id = media_handle_upload( 'myfilefield', 0 );              
              if ( !is_wp_error( $file_id ) ) {
                  $attachment_image = wp_get_attachment_url( $file_id );

                  if ($_POST['type'] == "logo") {
                    update_field( 'user_logo',  $file_id, 'user_'.$current_user->ID );
                  }

                  echo $attachment_image;
              }
          }
          if ( isset($_FILES['myfilefieldBg']['error']) && $_FILES['myfilefieldBg']['error'] == 0 ) {
            /*
             * 'myfilefield' is the name of the file upload field.
             * Replace the second parameter (0) with the post id
             * you want your file to be attached to
             */
            $file_id = media_handle_upload( 'myfilefieldBg', 0 );              
            if ( !is_wp_error( $file_id ) ) {
                $attachment_image = wp_get_attachment_url( $file_id );
                    if ($_POST['type'] == 'background') {
                      update_field( 'user_background',  $file_id, 'user_'.$current_user->ID );
                    }
                echo $attachment_image;
            }
        }
      }
  }
  die();
}

//Hook our function to the action we set at jQuery code
add_action( 'wp_ajax_pn_wp_frontend_ajax_upload', 'pn_upload_files');
add_action( 'wp_ajax_nopriv_pn_wp_frontend_ajax_upload', 'pn_upload_files');