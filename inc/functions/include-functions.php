<?php
/**
 * This file will include all available function files.
 * 
 * @package bootstrap-basic4
 */

 /**
* Function Name: DD - dd();
* This dd function dumps the given variables and ends execution of the script with simple style
* @param ($args)
* @return (Wow)
*/
function dump(...$objects) {
  echo "<pre class='pre-dd'>";
  foreach ($objects as $object) {
    ?>
    <style media="screen">
    .pre-dd{
      direction: ltr;
      display: block;
      padding: 9.5px;
      margin: 0 0 10px;
      font-size: 13px;
      line-height: 1.42857143;
      color: #333;
      word-break: break-all;
      word-wrap: break-word;
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    </style>
    <?php
    var_dump($object);
    echo "\n";
  }
  echo "</pre>";
  die();
}

function custom_author_pagination($args = array(), $query_object = 'wp_query') {
  if ($query_object == 'wp_query') {
      global $wp_query;
      $main_query = $wp_query;
  } else {
      $main_query = $query_object;
  }
  //var_dump($wp_query);
  $big = 99999; // This needs to be an unlikely integer
  // For more options and info view the docs for paginate_links()
  // http://codex.wordpress.org/Function_Reference/paginate_links
  $current_page = max(1, get_query_var('page'));
  $pages_count = $main_query->max_num_pages;
  $default_args = array(
      // 'base' => str_replace($big, '%#%', get_pagenum_link($big)),
      'format'     => '?page=%#%',
      'current' => $current_page,
      'total' => $pages_count,
      'mid_size' => 2,
      'prev_text' => '<i class="fa fa-caret-left" aria-hidden="true"></i>',
      'next_text' => '<i class="fa fa-caret-right" aria-hidden="true"></i>',
      'type' => 'array'
  );
  $args = wp_parse_args($args, $default_args);
  $paginate_links = paginate_links($args);
  if ($paginate_links) {
      ?>

        <ul class="pagination col-12 row justify-content-center ml-0 mr-0 mt-5 mb-5">
            <?php foreach ($paginate_links as $link): ?>
                <li class="page-item"><span class="page-link"><?php echo $link; ?></span></li>
            <?php endforeach; ?>
        </ul>

      <?php
  }
}


function custom_base_pagination($args = array(), $query_object = 'wp_query') {
  if ($query_object == 'wp_query') {
      global $wp_query;
      $main_query = $wp_query;
  } else {
      $main_query = $query_object;
  }
  //var_dump($wp_query);
  $big = 99999; // This needs to be an unlikely integer
  // For more options and info view the docs for paginate_links()
  // http://codex.wordpress.org/Function_Reference/paginate_links
  $current_page = max(1, get_query_var('paged'));
  $pages_count = $main_query->max_num_pages;
  $default_args = array(
      //'base' => str_replace($big, '%#%', get_pagenum_link($big)),
      'current' => $current_page,
      'total' => $pages_count,
      'mid_size' => 2,
      'prev_text' => '<i class="fa fa-caret-left" aria-hidden="true"></i>',
      'next_text' => '<i class="fa fa-caret-right" aria-hidden="true"></i>',
      'type' => 'array'
  );
  $args = wp_parse_args($args, $default_args);
  $paginate_links = paginate_links($args);
  if ($paginate_links) {
      ?>

        <ul class="pagination col-12 row justify-content-center ml-0 mr-0 mt-5 mb-5">
            <?php foreach ($paginate_links as $link): ?>
                <li class="page-item"><span class="page-link"><?php echo $link; ?></span></li>
            <?php endforeach; ?>
        </ul>

      <?php
  }
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_sub_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General Settings',
		'menu_slug' 	=> 'general-settings',
		'parent_slug'	=> 'index.php',
		'icon_url' 		=> 'dashicons-welcome-widgets-menus',
		'position' => 1,
		'redirect'		=> false
	));
}


// Register Careers custom Post Type
function products_post_type() {
  $labels = array(
      'name' => __('سيارات', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('سيارات', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('سيارات', 'post-type'),
      'parent_item_colon' => __('Parent سيارات:', 'post-type'),
      'all_items' => __('All', 'post-type'),
      'view_item' => __('View سيارات', 'post-type'),
      'add_new_item' => __('Add New', 'post-type'),
      'add_new' => __('Add New', 'post-type'),
      'edit_item' => __('Edit', 'post-type'),
      'update_item' => __('Update', 'post-type'),
      'search_items' => __('Search', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail',),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,


  );
  register_post_type('products', $args);
}

// Hook into the 'init' action
add_action('init', 'products_post_type', 0);

// Register Careers custom Post Type
function checking_post_type() {
  $labels = array(
      'name' => __('فحص السيارة', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('فحص السيارة', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('فحص السيارة', 'post-type'),
      'parent_item_colon' => __('Parent فحص:', 'post-type'),
      'all_items' => __('All', 'post-type'),
      'view_item' => __('View فحص', 'post-type'),
      'add_new_item' => __('Add New', 'post-type'),
      'add_new' => __('Add New', 'post-type'),
      'edit_item' => __('Edit', 'post-type'),
      'update_item' => __('Update', 'post-type'),
      'search_items' => __('Search', 'post-type'),
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
      'menu_position' => 5,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'page',
      'show_in_rest' => true,


  );
  register_post_type('checking', $args);
}

// Hook into the 'init' action
add_action('init', 'checking_post_type', 0);

//register taxonomy for custom post tags
register_taxonomy( 
  'products-tag', //taxonomy 
  array('products', 'cars'), //post type
  array( 
    'hierarchical'  => true, 
    'label'         => __( 'القسم','taxonomy general name'), 
    'singular_name' => __( 'القسم', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true ,
    'show_admin_column' => true
  ));
  
  register_taxonomy( 
    'products-brand', //taxonomy 
    'products', //post-type
    array( 
      'hierarchical'  => true, 
      'label'         => __( 'الماركة ','taxonomy general name'), 
      'singular_name' => __( 'الماركة ', 'taxonomy general name' ), 
      'rewrite'       => true, 
      'query_var'     => true ,
      'show_admin_column' => true
    ));
    
    register_taxonomy( 
      'products-model', //taxonomy 
      array('products', 'cars'), //post type
      array( 
        'hierarchical'  => true, 
        'label'         => __( 'السنة','taxonomy general name'), 
        'singular_name' => __( 'السنة', 'taxonomy general name' ), 
        'rewrite'       => true, 
        'query_var'     => true ,
        'show_admin_column' => true
      )
    );
  
  register_taxonomy( 
    'products-group', //taxonomy 
    'products', //post-type
    array( 
      'hierarchical'  => true, 
      'label'         => __( 'الفئه','taxonomy general name'), 
      'singular_name' => __( 'الفئه', 'taxonomy general name' ), 
      'rewrite'       => true, 
      'query_var'     => true ,
      'show_admin_column' => true
    )
  );
      
// Register Careers custom Post Type
function realـestate_post_type() {
  $labels = array(
      'name' => __('عقارات', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('عقارات', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('عقارات', 'post-type'),
      'parent_item_colon' => __('Parent عقارات:', 'post-type'),
      'all_items' => __('All', 'post-type'),
      'view_item' => __('View عقارات', 'post-type'),
      'add_new_item' => __('Add New', 'post-type'),
      'add_new' => __('Add New', 'post-type'),
      'edit_item' => __('Edit', 'post-type'),
      'update_item' => __('Update', 'post-type'),
      'search_items' => __('Search', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail',),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'page',
      'show_in_rest' => true,


  );
  register_post_type('realestate', $args);
}

// Hook into the 'init' action
add_action('init', 'realـestate_post_type', 0);

register_taxonomy( 
  'realestate-category', //taxonomy 
  'realestate', //post-type
  array( 
    'hierarchical'  => true, 
    'label'         => __( 'category','taxonomy general name'), 
    'singular_name' => __( 'category', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true
  )
);

register_taxonomy( 
  'realestate-cities', //taxonomy 
  'realestate', //post-type
  array( 
    'hierarchical'  => true, 
    'label'         => __( 'cities','taxonomy general name'), 
    'singular_name' => __( 'cities', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);


register_taxonomy( 
  'realestate-package', //taxonomy 
  'products', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'Package','taxonomy general name'), 
    'singular_name' => __( 'Package', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);



if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_62dd404347e00',
    'title' => 'Featured Car',
    'fields' => array(
      array(
        'key' => 'field_62dd404353954',
        'label' => 'سيارة مميزة (عرض في الرئيسية)',
        'name' => 'featured_car',
        'aria-label' => '',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui' => 1,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'products',
        ),
      ),
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'cars',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  acf_add_local_field_group(array(
    'key' => 'group_62af8d5a934cc',
    'title' => 'Offer',
    'fields' => array(
      array(
        'key' => 'field_62af8d65238fb',
        'label' => 'عرض (offer)',
        'name' => 'offers',
        'aria-label' => '',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui' => 1,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
      array(
        'key' => 'field_62b18df4a0612',
        'label' => 'السعر بعد العرض',
        'name' => 'price_offer',
        'aria-label' => '',
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
      array(
        'key' => 'field_62b18e0ca0613',
        'label' => 'صورة العرض',
        'name' => 'image_offer',
        'aria-label' => '',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'products',
        ),
      ),
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'cars',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  endif;		
  
      
if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_620cd22d2ff0e',
    'title' => 'About US',
    'fields' => array(
      array(
        'key' => 'field_620cd27d421e7',
        'label' => 'Who we are',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_620cd28c421e8',
        'label' => 'Headline',
        'name' => 'headline',
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
      array(
        'key' => 'field_620cd2b6421ea',
        'label' => 'Image About us',
        'name' => 'image_about_us',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_620cd2a4421e9',
        'label' => 'content about us',
        'name' => 'sub_headline',
        'type' => 'wysiwyg',
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
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),  
      array(
        'key' => 'field_620cd36797c73',
        'label' => 'steps',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_620cd37497c74',
        'label' => 'steps',
        'name' => 'values',
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
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_620cd37a97c75',
            'label' => 'headline step',
            'name' => 'values_headline',
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
          array(
            'key' => 'field_620cd3232137a97c75',
            'label' => 'icon step',
            'name' => 'values_icon',
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
      array(
        'key' => 'field_620cd2321344frfd27d421e7',
        'label' => 'our services',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_61dd81231231231232cweqewqew82323232658daf',
        'label' => 'headline services',
        'name' => 'headline_services',
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
      array(
        'key' => 'field_61dd8c8e343ewqewqewwde58dewq433b0',
        'label' => 'content services',
        'name' => 'content_services',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
      ),
      array(
        'key' => 'field_62197wqewewqec6b04c1a',
        'label' => 'steps about us',
        'name' => 'steps_about_us',
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
        'layout' => 'block',
        'button_label' => 'add step',
        'sub_fields' => array(
          array(
            'key' => 'field_621aeqrewrewrer32132231a3b04c1c',
            'label' => 'icon step',
            'name' => 'icon_step',
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
          array(
            'key' => 'field_621rewrewra1a3b04c1c',
            'label' => 'headline step',
            'name' => 'headline_step',
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
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'template-about-page.php',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'acf_after_title',
    'style' => 'seamless',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  acf_add_local_field_group(array(
    'key' => 'group_6211159113226',
    'title' => 'contact us',
    'fields' => array(
      array(
        'key' => 'field_620cd3c79123e32e332e32d60c',
        'label' => 'contact information',
        'name' => 'contact_info',
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
        'layout' => 'block',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_620cd323324234324cd9160d',
            'label' => 'contact image',
            'name' => 'contact_image',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33.3333',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_620c43we32432d3d89160e',
            'label' => 'contact headline',
            'name' => 'contact_headline',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33.3333',
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
            'key' => 'field_620cd323d4fwfdc9160f',
            'label' => 'contact text',
            'name' => 'contact_text',
            'type' => 'textarea',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33.3333',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => '',
            'new_lines' => 'br',
          ),
        ),
      ),
      array(
        'key' => 'field_62111a818de3a',
        'label' => 'headline',
        'name' => 'headline',
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
      array(
        'key' => 'field_62111a8e8de3b',
        'label' => 'id form',
        'name' => 'id_form',
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
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
      array(
        'key' => 'field_621117ff08bd6',
        'label' => 'map embed',
        'name' => 'map_embed',
        'type' => 'textarea',
        'instructions' => 'map embed iframe <iframe src="#" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'template-contact-us.php',
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
    'key' => 'group_61dd89f480753',
    'title' => 'General Settings',
    'fields' => array(
      array(
        'key' => 'field_61dd8a1df482c',
        'label' => 'Logo',
        'name' => 'logo',
        'type' => 'image',
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
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),

      array(
        'key' => 'field_61dd8214124a1df482c',
        'label' => 'Logo Footer',
        'name' => 'logo_footer',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),

      array(
        'key' => 'field_61dd8ac8f4830',
        'label' => 'social media',
        'name' => 'social_media',
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
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_61dd8ae8f4831',
            'label' => 'icon social media',
            'name' => 'icon_social_media',
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
          ),
          array(
            'key' => 'field_61dd8af9f4832',
            'label' => 'link social media',
            'name' => 'link_social_media',
            'type' => 'url',
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
          ),
        ),
      ),
      array(
        'key' => 'field_61dd8b15f4833',
        'label' => 'copy right',
        'name' => 'copy_right',
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
      array(
        'key' => 'field_61dd8b15f4833wwqehatse2app',
        'label' => 'number whatsapp',
        'name' => 'whatsapp',
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
      array(
        'key' => 'field_61dd8b18332132sdd31232',
        'label' => 'number phone',
        'name' => 'phone',
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
      array(
        'key' => 'field_622dc872a04c5',
        'label' => 'currency pricing',
        'name' => 'currency_pricing',
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
      array(
        'key' => 'field_622dc881a04c6',
        'label' => 'form id rent car',
        'name' => 'form_id_rent',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33.3333',
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
        'key' => 'field_622dc9ada04c7',
        'label' => 'form id sale car',
        'name' => 'form_id_sale',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33.3333',
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
        'key' => 'field_622dc9b8a04c8',
        'label' => 'form id finance car',
        'name' => 'form_id_finance',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '33.3333',
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
        'key' => 'field_622dca16a04c9',
        'label' => 'logos Vendor',
        'name' => 'logos_vendor',
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
        'button_label' => 'add logo',
        'sub_fields' => array(
          array(
            'key' => 'field_622dca25a04ca',
            'label' => 'logo Vendor',
            'name' => 'logo_vendor',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ), 
      array(
        'key' => 'field_6232f28cc8ae5',
        'label' => 'steps sale car',
        'name' => 'steps_sale_car',
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
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_6232f296c8ae6',
            'label' => 'icon step',
            'name' => 'icon_step',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_6232f2afc8ae7',
            'label' => 'text step',
            'name' => 'text_step',
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
      array(
        'key' => 'field_6232f328cc12323123218ae5',
        'label' => 'steps finance car',
        'name' => 'steps_finance_car',
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
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_6232fewqewqewqe296c8ae6',
            'label' => 'icon step',
            'name' => 'icon_step_finance',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_6232f2aeqwewfc8ae7',
            'label' => 'text step',
            'name' => 'text_step_finance',
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

      array(
        'key' => 'field_6232fewqewqewqe12e12dsadsde23ee296c8ae6',
        'label' => 'image ads real step',
        'name' => 'ads_images_real',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_6232f2aeqwewfc8ae32e23ee233e23ee7',
        'label' => 'link ads Real',
        'name' => 'ads_link_real',
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

      array(
        'key' => 'field_6232fewqew23232dsadsde23ee296c8ae6',
        'label' => 'image ads real step',
        'name' => 'ads_images_real_2',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_6232f2ae2344245455e233e23ee7',
        'label' => 'link ads Real',
        'name' => 'ads_link_real_2',
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


      array(
        'key' => 'field_628ab27ddf4e2',
        'label' => 'select our projects real',
        'name' => '',
        'type' => 'message',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      array(
        'key' => 'field_628ab28cdf4e3',
        'label' => 'select term projects',
        'name' => 'select_term_projects',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'realestate-category',
        'field_type' => 'select',
        'allow_null' => 0,
        'add_term' => 1,
        'save_terms' => 0,
        'load_terms' => 0,
        'return_format' => 'id',
        'multiple' => 0,
      ),
      array(
        'key' => 'field_6232f332fr23333ee7',
        'label' => 'ID form real estate',
        'name' => 'id_form_realestate',
        'type' => 'number',
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
      array(
        'key' => 'field_62a055fc6bf46',
        'label' => 'صفحة عروض السيارات',
        'name' => 'page_installment',
        'type' => 'link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
      ),

      array(
        'key' => 'field_62a0323e3255fc6bf46',
        'label' => 'صفحة العلامات التجارية',
        'name' => 'term_page_link',
        'type' => 'link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
      ),      

    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'general-settings',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  acf_add_local_field_group(array(
    'key' => 'group_61dd8bede714d',
    'title' => 'Home page',
    'fields' => array(
      array(
        'key' => 'field_61dd8bf33c888',
        'label' => 'Slider',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_61dd8c0f3c889',
        'label' => 'slider home',
        'name' => 'slider_home',
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
        'layout' => 'block',
        'button_label' => 'add slide',
        'sub_fields' => array(
          array(
            'key' => 'field_61dd8c1b3c88a',
            'label' => 'image slider',
            'name' => 'image_slider',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_61dd8c293c88b',
            'label' => 'content slider',
            'name' => 'content_slider',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'delay' => 0,
          ),
          array(
            'key' => 'field_61dd8c3b3c88c',
            'label' => 'page slider',
            'name' => 'page_slider',
            'type' => 'link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
          ),
        ),
      ),

      // add new section to home page
      array(
        'key' => 'field_629b47e8a2813',
        'label' => 'سكشين عرض السيارات بالصتنيف',
        'name' => 'cars_by_category',
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
        'layout' => 'block',
        'button_label' => 'اضافة تصنيف جديد',
        'sub_fields' => array(
          array(
            'key' => 'field_629b480ba2814',
            'label' => 'العنوان',
            'name' => 'headline_cars_by_category',
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
          array(
            'key' => 'field_629b481fa2815',
            'label' => 'اختر نوع التصنيف',
            'name' => 'category_cars_taxonomy',
            'type' => 'taxonomy',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'taxonomy' => 'products-tag',
            'field_type' => 'select',
            'allow_null' => 0,
            'add_term' => 0,
            'save_terms' => 0,
            'load_terms' => 0,
            'return_format' => 'id',
            'multiple' => 0,
          ),

          array(
            'key' => 'field_6377cb9834b2d',
            'label' => 'اختار السيارات',
            'name' => 'category_cars',
            'aria-label' => '',
            'type' => 'relationship',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'post_type' => array(
              0 => 'products',
              1 => 'cars',
            ),
            'filters' => array(
              0 => 'search',
              1 => 'taxonomy',
            ),
            'return_format' => 'object',
            'min' => '',
            'max' => 6,
            'elements' => '',
          ),

          array(
            'key' => 'field_629be32sd480ba2814',
            'label' => 'رابط صفحة الجميع',
            'name' => 'link_cars_by_category',
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
        


      array(
        'key' => 'field_61dd8c6e32e3e3e3e658dae',
        'label' => 'Ads',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_61dd8c82323232658daf',
        'label' => 'headline ads',
        'name' => 'headline_ads',
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
      array(
        'key' => 'field_61dd8c8e58dewq433b0',
        'label' => 'content ads',
        'name' => 'content_ads',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
      ),

      array(
        'key' => 'field_62197c9150523d04c1b',
        'label' => 'ads left',
        'name' => 'ads_left',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_62197c213232139104c1b',
        'label' => 'ads right',
        'name' => 'ads_right',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_61dde21e218c6658dae',
        'label' => 'our services',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),

      array(
        'key' => 'field_61dd81231231231232c82323232658daf',
        'label' => 'headline services',
        'name' => 'headline_services',
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
      array(
        'key' => 'field_61dd8c8e343ewde58dewq433b0',
        'label' => 'content services',
        'name' => 'content_services',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
      ),
      array(
        'key' => 'field_62197c6b04c1a',
        'label' => 'steps about us',
        'name' => 'steps_about_us',
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
        'layout' => 'block',
        'button_label' => 'add step',
        'sub_fields' => array(
          array(
            'key' => 'field_621aeq32132231a3b04c1c',
            'label' => 'icon step',
            'name' => 'icon_step',
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
          array(
            'key' => 'field_621a1a3b04c1c',
            'label' => 'headline step',
            'name' => 'headline_step',
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

      array(
        'key' => 'field_61dd8c6658dae',
        'label' => 'about us',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),

      array(
        'key' => 'field_61dd8c8658daf',
        'label' => 'headline about us',
        'name' => 'headline_about_us',
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
      array(
        'key' => 'field_61dd8cwqeewqewqe8658daf',
        'label' => 'sub headline about us',
        'name' => 'sub_sheadline_about_us',
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
      array(
        'key' => 'field_61dd8c8e58db0',
        'label' => 'content about us',
        'name' => 'content_about_us',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
      ),
      array(
        'key' => 'field_61dd8ce258db2',
        'label' => 'image about us',
        'name' => 'image_about_us',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_61dd8d53e6e5e',
        'label' => 'information',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_6212133231235fbf51dc1d',
        'label' => 'products headline',
        'name' => 'products_headline',
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
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
      array(
        'key' => 'field_6215fbf51dc1d',
        'label' => 'products text',
        'name' => 'products_text',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
      array(
        'key' => 'field_61dd8e08bdb33',
        'label' => 'contact us',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),

      array(
        'key' => 'field_622dc03448119',
        'label' => 'our clients',
        'name' => 'our_clients',
        'type' => 'gallery',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
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
      array(
        'key' => 'field_622dc0414811a',
        'label' => 'testimonial',
        'name' => 'testimonial',
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
        'layout' => 'block',
        'button_label' => 'add',
        'sub_fields' => array(
          array(
            'key' => 'field_622dc0544811b',
            'label' => 'name of testimonial',
            'name' => 'name_of_testimonial',
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
          array(
            'key' => 'field_622dc05c4811c',
            'label' => 'text of testimonial',
            'name' => 'text_of_testimonial',
            'type' => 'textarea',
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
            'maxlength' => '',
            'rows' => '',
            'new_lines' => '',
          ),
          array(
            'key' => 'field_622dc0634811d',
            'label' => 'image of testimonial',
            'name' => 'image_of_testimonial',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),
      array(
        'key' => 'field_622dc07c4811e',
        'label' => 'contact us headline',
        'name' => 'contact_us_headline',
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
      array(
        'key' => 'field_622dc0874811f',
        'label' => 'contact us text',
        'name' => 'contact_us_text',
        'type' => 'textarea',
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
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
      array(
        'key' => 'field_622dc09348120',
        'label' => 'contact us link',
        'name' => 'contact_us_link',
        'type' => 'link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
      ),

    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'template-home-page.php',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  acf_add_local_field_group(array(
    'key' => 'group_620ce80e3c4d6',
    'title' => 'our products',
    'fields' => array(
      array(
        'key' => 'field_620ce820fcf52',
        'label' => 'head',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_620ce827fcf53',
        'label' => 'headline',
        'name' => 'headline',
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
      array(
        'key' => 'field_620ce835fcf54',
        'label' => 'sub headline',
        'name' => 'sub_headline',
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
      array(
        'key' => 'field_620ce843fcf55',
        'label' => 'image',
        'name' => 'image_our_seervices',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_620ce86804826',
        'label' => 'products',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_620ce89204829',
        'label' => 'products',
        'name' => 'products',
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
        'layout' => 'block',
        'button_label' => 'add products',
        'sub_fields' => array(
          array(
            'key' => 'field_620ce8a10482a',
            'label' => 'image products',
            'name' => 'image_products',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_620ce8ac0482b',
            'label' => 'icon products',
            'name' => 'icon_products',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_620ce8bf0482c',
            'label' => 'headline products',
            'name' => 'headline_products',
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
          array(
            'key' => 'field_620ce8c70482d',
            'label' => 'text products',
            'name' => 'text_products',
            'type' => 'textarea',
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
            'maxlength' => '',
            'rows' => '',
            'new_lines' => '',
          ),
          array(
            'key' => 'field_620ce8dd0482e',
            'label' => 'link products',
            'name' => 'link_products',
            'type' => 'link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_template',
          'operator' => '==',
          'value' => 'template-our-products.php',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  acf_add_local_field_group(array(
    'key' => 'group_61e6dcfa26e75',
    'title' => 'الماركة',
    'fields' => array(
      array(
        'key' => 'field_61e6dd0a63ca9',
        'label' => 'الصورة',
        'name' => 'icon_term',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'taxonomy',
          'operator' => '==',
          'value' => 'all',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));

  acf_add_local_field_group(array(
    'key' => 'group_622252a079013',
    'title' => 'author post',
    'fields' => array(
      array(
        'key' => 'field_622252abc5ef0',
        'label' => 'author name',
        'name' => 'author_name',
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
      array(
        'key' => 'field_622252b7c5ef1',
        'label' => 'author title',
        'name' => 'author_title',
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
      array(
        'key' => 'field_622252bdc5ef2',
        'label' => 'author image',
        'name' => 'author_image',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_622252d4c5ef3',
        'label' => 'author bio',
        'name' => 'author_bio',
        'type' => 'textarea',
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
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
    


    acf_add_local_field_group(array(
      'key' => 'group_6333fb67a673c',
      'title' => 'تم البيع',
      'fields' => array(
        array(
          'key' => 'field_6333fb67ac6e4',
          'label' => 'تم البيع',
          'name' => 'sold_done',
          'type' => 'true_false',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'message' => '',
          'default_value' => 0,
          'ui' => 1,
          'ui_on_text' => '',
          'ui_off_text' => '',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'products',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'side',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
      'show_in_rest' => 0,
    ));
    
	

  acf_add_local_field_group(array(
    'key' => 'group_622db219d7c8a',
    'title' => 'Cars Products',
    'fields' => array(
      array(
        'key' => 'field_622db4b45ebbd',
        'label' => 'سعر الكاش',
        'name' => 'price',
        'type' => 'number',
        'instructions' => 'ادخل السعر شامل الضريبة',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_6232f2e3e44af',
        'label' => 'القسط الشهري',
        'name' => 'finance_month',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_6232f312e44b0',
        'label' => 'مدة التمويل',
        'name' => 'price_finance_duration',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_6232f342e44b1',
        'label' => 'الدفعة الأولى',
        'name' => 'the_first_batch',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_6232f346e44b2',
        'label' => 'الدفعة الأخيرة',
        'name' => 'the_last_batch',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_622db89d5ebbf',
        'label' => 'رقم اللوحــة',
        'name' => 'number_car',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_432622db89324d5ebbf',
        'label' => 'اللــــــــــون',
        'name' => 'color_car',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_624232db8432439d5ebbf',
        'label' => 'الفئــــــــــة',
        'name' => 'model_car',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_624232db8432439d5e21213123bbf',
        'label' => '(الممشى (عدد الكيلوات',
        'name' => 'km_car',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_6242322133312d5e21213123bbf',
        'label' => 'رقم الاعلان',
        'name' => 'number_ads',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '20',
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
        'key' => 'field_622dc0344312lkk31232321328119',
        'label' => 'galleries car',
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
        'return_format' => 'url',
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
      array(
        'key' => 'field_622db8e452ccb',
        'label' => 'Specifications',
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
        'button_label' => 'add spec',
        'sub_fields' => array(
          array(
            'key' => 'field_622db8ec52ccc',
            'label' => 'Icon Specifications',
            'name' => 'icon_specifications',
            'type' => 'text',
            'instructions' => '<a href="https://fontawesome.com/v4/icons/" target="_blank">get icon</a>',
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
          array(
            'key' => 'field_622db90052ccd',
            'label' => 'Text Specifications',
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
          'value' => 'products',
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
    'key' => 'group_62333dfd42d73',
    'title' => 'finance',
    'fields' => array(
      array(
        'key' => 'field_62333e079e83e',
        'label' => 'id form finance',
        'name' => 'id_form_finance',
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
      array(
        'key' => 'field_62333e139e83f',
        'label' => 'headline finance',
        'name' => 'headline_finance',
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
      array(
        'key' => 'field_62333e249e840',
        'label' => 'sub headline finance',
        'name' => 'sub_headline_finance',
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
      array(
        'key' => 'field_62333e2f9e841',
        'label' => 'ads images',
        'name' => 'ads_images',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_62333e3c9e842',
        'label' => 'ads link',
        'name' => 'ads_link',
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
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'template-finance.php',
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
    'key' => 'group_629fb0d29d37a',
    'title' => 'user media',
    'fields' => array(
      array(
        'key' => 'field_629fb0de58814',
        'label' => 'صورة الشعار',
        'name' => 'user_logo',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_629fb0ec58815',
        'label' => 'صورة الصفحة',
        'name' => 'user_background',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_62333e3213c9e842',
        'label' => 'العنوان',
        'name' => 'user_address',
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
      array(
        'key' => 'field_62333123de3213c9e842',
        'label' => 'الهاتف',
        'name' => 'user_phone',
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
      array(
        'key' => 'field_623243333123de3213c9e842',
        'label' => 'الواتس',
        'name' => 'user_whatsapp',
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
      array(
        'key' => 'field_62d7dcb17276b',
        'label' => 'حالة السيارات',
        'name' => 'vendor_cars_status',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'used' => 'مستعمل',
          'new' => 'جديد',
        ),
        'allow_custom' => 0,
        'default_value' => array(
          0 => 'new',
        ),
        'layout' => 'horizontal',
        'toggle' => 0,
        'return_format' => 'value',
        'save_custom' => 0,
      ),
      array(
        'key' => 'field_62d7dc42114dqw23b17276b',
        'label' => 'تقسيط',
        'name' => 'vendor_cars_installment',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'installment' => 'لا يوجد',
          'no_installment' => 'يوجد',
        ),
        'allow_custom' => 0,
        'default_value' => array(
          0 => 'installment',
        ),
        'layout' => 'horizontal',
        'toggle' => 0,
        'return_format' => 'value',
        'save_custom' => 0,
      ),

      array(
        'key' => 'field_6313b96c241b9',
        'label' => 'البلد',
        'name' => 'cities',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'realestate-cities',
        'field_type' => 'select',
        'allow_null' => 0,
        'add_term' => 1,
        'save_terms' => 0,
        'load_terms' => 0,
        'return_format' => 'id',
        'multiple' => 0,
      ),
      array(
        'key' => 'field_6313b996241ba',
        'label' => 'تصنيفات',
        'name' => 'package',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'realestate-package',
        'field_type' => 'select',
        'allow_null' => 0,
        'add_term' => 1,
        'save_terms' => 0,
        'load_terms' => 0,
        'return_format' => 'id',
        'multiple' => 0,
      ),
        
      array(
        'key' => 'field_633382cf5c2e8',
        'label' => 'الخريطة',
        'name' => 'map_user',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7455039.62543262!2d49.56753333971721!3d24.166258812130987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15e7b33fe7952a41%3A0x5960504bc21ab69b!2z2KfZhNiz2LnZiNiv2YrYqQ!5e0!3m2!1sar!2seg!4v1664320363338!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
      
      array(
        'key' => 'field_6203233d2cd2a4421e9',
        'label' => 'المحتوي الخاص بالعميل',
        'name' => 'user_content',
        'type' => 'wysiwyg',
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
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ), 

  		array(
        'key' => 'field_638f310ee7461',
        'label' => 'العلامة التجارية',
        'name' => 'brands',
        'aria-label' => '',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'products-brand',
        'add_term' => 0,
        'save_terms' => 0,
        'load_terms' => 0,
        'return_format' => 'object',
        'field_type' => 'multi_select',
        'allow_null' => 0,
        'multiple' => 0,
      ),

    ),
    'location' => array(
      array(
        array(
          'param' => 'user_form',
          'operator' => '==',
          'value' => 'all',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  endif;		

add_action( 'init', 'process_user_roles' );

function process_user_roles(){
  global $wp_roles;

  if( is_admin() && !empty( $_GET['page'] ) && $_GET['page'] == 'activate_roles') {
      $current_user = wp_get_current_user();
      $roles = $current_user->roles;
      if(!in_array('administrator', $roles)) return;

      $roles = ['administrator'];
      foreach ($roles as $role) {
          $role = get_role($role);
      }

      remove_role('vendor');
      remove_role('agents');
      remove_role('delegate');
      remove_role('body_check');
      remove_role('mechanic');
      remove_role('electric');

      add_role('vendor', __('معرض','number20'), []);
      add_role('agents', __('وكلاء','number20'), []);
      add_role('delegate', __('مندووب','number20'), []);
      add_role('body_check', __('فاحص الجسم','number20'), []);
      add_role('mechanic', __('الميكانيكي','number20'), []);
      add_role('electric', __('الكهربائي','number20'), []);

      $roles = ['vendor', 'agents', 'delegate', 'body_check', 'mechanic',  'electric', 'administrator'];

      $roles_rm = ['body_check', 'mechanic',  'electric'];

      foreach ($roles as $role) {
        $role = get_role($role);
        $role->add_cap('read');
      }

      // Assign the Pages post type and Media to all roles
      $roles = $wp_roles->role_names;
      foreach ($roles as $role => $role_name) {
        $role = get_role($role);
        $role->add_cap('edit_pages');
        $role->add_cap('edit_published_pages');
        $role->add_cap('publish_pages');
        $role->add_cap('read_private_pages');
        $role->add_cap('upload_files');
        $role->add_cap('manage_categories');
        $role->add_cap('edit_posts');
        $role->add_cap('delete_pages');
        $role->add_cap('delete_private_pages');
        $role->add_cap('delete_published_pages');
        $role->add_cap('gravityforms_view_entries');
        $role->add_cap('gravityforms_edit_entries');
        $role->add_cap('gravityforms_delete_entries');
      }

      $vendor = get_role('vendor');
      $vendor->add_cap( 'read_private_posts' );
      $caps = array (
        'edit_published_posts',
        'publish_posts',
        'delete_posts',
        'delete_published_posts',
      );

      foreach ( $caps as $cap ) {
        $vendor->remove_cap( $cap );
      }

      $agents = get_role('agents');
      $agents->add_cap( 'read_private_posts' );
      $capsـagents = array (
        'edit_published_posts',
        'publish_posts',
        'delete_posts',
        'delete_published_posts',
      );

      foreach ( $capsـagents as $cap ) {
        $agents->remove_cap( $cap );
      }

      $roles_rm = $wp_roles->role_names;
      foreach ($roles_rm as $role => $role_name) {
        $role = get_role($role);
        $role->remove_cap('gravityforms_view_entries');
        $role->remove_cap('gravityforms_edit_entries');
        $role->remove_cap('gravityforms_delete_entries');
      }


      $role = get_role( 'author' );
      $role->add_cap( 'manage_categories' ); 

    echo "Roles Proceed Succesfully";
    die();
    return;
  }
}


$user = wp_get_current_user();

$allowed_roles = array('vendor', 'agents');
if( array_intersect($allowed_roles, $user->roles ) ) {  
  function remove_menus() {
    remove_menu_page( 'index.php' );                  //Dashboard  
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=category' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=post_tag' );        //Settings
    remove_menu_page('woocommerce');  
  }
  add_action( 'admin_menu', 'remove_menus' );
}

$allowed_check = array('body_check', 'mechanic',  'electric',);
if( array_intersect($allowed_check, $user->roles ) ) {  
  function remove_menus() {
    remove_menu_page( 'index.php' );                      //Dashboard       
    remove_menu_page( 'edit.php' );                       //Posts
    remove_menu_page( 'upload.php' );                     //Media
    remove_menu_page( 'edit.php?post_type=page' );        //Pages
    remove_menu_page( 'edit.php?post_type=products' );    //products
    remove_menu_page( 'edit.php?post_type=realestate' );  //realestate
    remove_menu_page( 'admin.php?page=gf_entries' );      //gf_entries
    remove_menu_page( 'edit-comments.php' );              //Comments
    remove_menu_page( 'themes.php' );                     //Appearance
    remove_menu_page( 'plugins.php' );                    //Plugins
    remove_menu_page( 'users.php' );                      //Users
    remove_menu_page( 'tools.php' );                      //Tools
    remove_menu_page( 'options-general.php' );            //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=category' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=post_tag' );        //Settings
    remove_menu_page('woocommerce');  
  }
  add_action( 'admin_menu', 'remove_menus' );
}


/**
 * override output of author drop down to include ALL user roles 
*/ 
add_filter('wp_dropdown_users', 'include_all_users');
function include_all_users($output) {
  global $post; 
  $args = array('role__in' => array('administrator', 'vendor', 'agents', 'author')); 
  $users = get_users($args);
  $current_user =  wp_get_current_user();

  $output = '<select id="post_author_override" name="post_author_override" class="">';

  foreach($users as $user){
    if($post->post_author == $user->ID) {
      $select =  'selected';
    } else {
      $select = '';
    }
      $output .= '<option value="'.$user->ID.'"'.$select.'>'.$user->user_login.'</option>';
  }
  $output .= '</select>';
  return $output;
}

/*
Plugin Name: Link Clicks Counter
*/

add_action('wp_ajax_link_click_counter', 'link_click_counter', 0);
add_action('wp_ajax_nopriv_link_click_counter', 'link_click_counter');

function link_click_counter() {
    if ( isset( $_POST['post_id'] ) ) {
        $count = get_post_meta( $_POST['post_id'], 'link_click_counter', true );
        update_post_meta( $_POST['post_id'], 'link_click_counter', ( $count === '' ? 1 : $count + 1 ) );
    }

    echo get_post_meta( $_POST['post_id'], 'link_click_counter', true );

    die;
}


add_action('wp_ajax_delete_cars_slod', 'delete_cars_slod', 0);
add_action('wp_ajax_nopriv_delete_cars_slod', 'delete_cars_slod');

function delete_cars_slod() {

    if ( isset( $_POST['post_ids'] ) ) {
      foreach ($_POST['post_ids'] as $key => $value) {
        wp_delete_post( (int)$value, true); 
      }
    }

    die;
}


/*
Plugin Name: ajax child brand
*/


add_action('wp_ajax_ajax_child_brand', 'ajax_child_brand', 0);
add_action('wp_ajax_nopriv_ajax_child_brand', 'ajax_child_brand');

function ajax_child_brand() {
    if ( isset( $_POST['parent_id'] ) ) {
      $categories=  get_categories('child_of='.$_POST['parent_id'].'&hide_empty=1&taxonomy=products-brand');
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




add_action('wp_ajax_entry_assign_useer', 'entry_assign_useer', 0);
add_action('wp_ajax_nopriv_entry_assign_useer', 'entry_assign_useer');

function entry_assign_useer() {

  $user_id  = $_POST['user_id'];
  $entry_id = $_POST['entry_id'];

  $updated_entry = GFAPI::get_entry( $entry_id );

  $updated_entry['created_by'] = $user_id;
  $updated = GFAPI::update_entry( $updated_entry );

  die;
}

add_action( 'gform_after_update_entry', 'entry_assign_useer', 10, 3 );



add_action('wp_ajax_entry_actions', 'entry_actions', 0);
add_action('wp_ajax_nopriv_entry_actions', 'entry_actions');

function entry_actions() {

  $status  = $_POST['status'];
  $entry_id = $_POST['entry_id'];
  $updated_entry = GFAPI::get_entry( $entry_id );

  $updated_entry['approval_status'] = $status;
  $updated_entry['approval_status_1'] = $status;
  $updated = GFAPI::update_entry( $updated_entry );

  die;
}

add_action( 'gform_after_update_entry', 'entry_entry_actions', 10, 3 );


// post meta acf body check
if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_62bb44fdb7208',
    'title' => 'فحص السيارة',
    'fields' => array(
      // tab checking car
      array(
        'key' => 'field_62bb46aeb124128331',
        'label' => 'السيارة',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_62bc3204de6d5',
        'label' => 'سيارة الفحص',
        'name' => 'car_checking_relationship_1',
        'type' => 'relationship',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'products',
        ),
        'taxonomy' => '',
        'filters' => array(
          0 => 'search',
          1 => 'post_type',
          2 => 'taxonomy',
        ),
        'elements' => array(
          0 => 'featured_image',
        ),
        'min' => '',
        'max' => 1,
        'return_format' => 'id',
      ),
      array(
        'key' => 'field_62bc3fea3968f',
        'label' => 'تاريخ الفحص',
        'name' => 'date_checking',
        'type' => 'date_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'display_format' => 'F j, Y',
        'return_format' => 'F j, Y',
        'first_day' => 1,
      ),


      array(
        'key' => 'field_62bb46aeb8331',
        'label' => 'فحص الجسم الخارجي',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),



      array(
        'key' => 'field_62bb4f0bb8333',
        'label' => 'رفرف امامي يمين',
        'name' => 'car_checking_1',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cbb8334',
        'label' => 'ملاحظات',
        'name' => 'car_checking_1_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f0bb8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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



      array(
        'key' => 'field_62bb4f0b3433b8333',
        'label' => 'رفرف امامي يسار',
        'name' => 'car_checking_2',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50c2144124bb8334',
        'label' => 'ملاحظات',
        'name' => 'car_checking_2_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f0b3433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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



      array(
        'key' => 'field_62bb4f4124433b8333',
        'label' => 'رفرف خلفي يمين',
        'name' => 'car_checking_3',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrewrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_3_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f4124433b842333',
        'label' => 'رفرف خلفي يسار',
        'name' => 'car_checking_4',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrew21rnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_4_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124433b842333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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



      array(
        'key' => 'field_62bb4f41wrwer4123b8333',
        'label' => 'باب امامي يمين',
        'name' => 'car_checking_5',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjr1123213ewrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_5_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f41wrwer4123b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f4124433b81221313333',
        'label' => 'باب امامي يسار',
        'name' => 'car_checking_6',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrewrnn812312312334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_6_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124433b81221313333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f412123232134433b8333',
        'label' => 'باب خلفي يمين',
        'name' => 'car_checking_7',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrew12321rnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_7_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f412123232134433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f4124123213433b8333',
        'label' => 'باب خلفي يسار',
        'name' => 'car_checking_8',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrewrnnsad28334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_8_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124123213433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f412443wewe3b8333',
        'label' => 'الكبوت',
        'name' => 'car_checking_9',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrewrnn123sdsd8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_9_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f412443wewe3b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f4124e1212433b8333',
        'label' => 'الشنطة',
        'name' => 'car_checking_10',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjwqe128334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_10_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124e1212433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f4124431sa3b8333',
        'label' => 'القايم اليمين',
        'name' => 'car_checking_11',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50crwqr21n8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_11_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124431sa3b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f4124wqewq433b8333',
        'label' => 'القايم اليسار',
        'name' => 'car_checking_12',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50412214214n8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_12_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124wqewq433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f41244qrqw33b8333',
        'label' => 'عتب يمين',
        'name' => 'car_checking_13',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjreeqwewee333334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_13_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f41244qrqw33b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f41244qewqewq33b8333',
        'label' => 'عتب يسا',
        'name' => 'car_checking_14',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrqw1218334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_14_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f41244qewqewq33b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f41241222224433b8333',
        'label' => 'الشاسيه',
        'name' => 'car_checking_15',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb332333n8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_15_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f41241222224433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f2sdfd213b8333',
        'label' => 'صدام امامي',
        'name' => 'car_checking_16',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjre12e121328334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_16_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f2sdfd213b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f41244332112222b8333',
        'label' => 'صدام خلفي',
        'name' => 'car_checking_17',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50c3131233n8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_17_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f41244332112222b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4f412443423243b8333',
        'label' => 'مراياه يمين',
        'name' => 'car_checking_18',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cjrewrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_18_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f412443423243b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f4124433b8333444',
        'label' => 'مرايه يسار',
        'name' => 'car_checking_19',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cjrewrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_19_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4124433b8333444',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bc432a5827c',
        'label' => 'ملاحظات بالصور',
        'name' => 'checking_with_image_1',
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
        'layout' => 'block',
        'button_label' => 'اضافة ملاحظة',
        'sub_fields' => array(
          array(
            'key' => 'field_62bc43615827d',
            'label' => 'الملاحظة',
            'name' => 'text_note_1',
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
          array(
            'key' => 'field_62bc439b5827e',
            'label' => 'الصورة',
            'name' => 'img_note_1',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),
 





      // tab checking car
      array(
        'key' => 'field_62bb12311231232346aeb8331',
        'label' => 'فحص جسم الداخلي',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),



      array(
        'key' => 'field_62bb4f4122114124124433b8333',
        'label' => 'مقاعد وأحزمة',
        'name' => 'car_checking_20',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cjre1223123123wrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_20_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4122114124124433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f4122114123123124124433b8333',
        'label' => 'الضوابط والمفاتيح الداخلية',
        'name' => 'car_checking_21',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cjre1123123223123123wrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_21_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4122114123123124124433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_6223asdswe1e1234433b8333',
        'label' => 'فتحة السقف والنوافذ',
        'name' => 'car_checking_22',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50smkee0012wrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_22_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_6223asdswe1e1234433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f412211412412132132332131232124433b8333',
        'label' => 'عداد الوقود درجة الحرارة',
        'name' => 'car_checking_23',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cjr3123qsddqwd3wrnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_23_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f412211412412132132332131232124433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f4122114124124434312414123b8333',
        'label' => 'لوحة القيادة وأجهزة القياس',
        'name' => 'car_checking_24',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cjre1223123123wr1231232132nn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_24_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f4122114124124434312414123b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f414mdfm00994124433b8333',
        'label' => 'نظام راديو / موسيقى',
        'name' => 'car_checking_25',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_6244442144sfferen8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_25_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f414mdfm00994124433b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f41221141241244141412dsad33b8333',
        'label' => 'وسائد هوائية',
        'name' => 'car_checking_26',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cjre1223123123w123213rnn8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_26_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f41221141241244141412dsad33b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb41241412414',
        'label' => 'إمالة / قفل عجلة القيادة',
        'name' => 'car_checking_27',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cds123s3124',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_27_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb4f41221qrwrwrwqrqw1323b8333',
        'label' => 'المرايا',
        'name' => 'car_checking_28',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),

      array(
        'key' => 'field_62bb50cjre1223123123wrnnqwe8334',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_28_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4f41221qrwrwrwqrqw1323b8333',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bc432a524343421412827c',
        'label' => 'ملاحظات بالصور',
        'name' => 'checking_with_image_2',
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
        'layout' => 'block',
        'button_label' => 'اضافة ملاحظة',
        'sub_fields' => array(
          array(
            'key' => 'field_62bc43615123232411827d',
            'label' => 'الملاحظة',
            'name' => 'text_note_2',
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
          array(
            'key' => 'field_62bc439b123312541827e',
            'label' => 'الصورة',
            'name' => 'img_note_2',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),




    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'checking',
        ),
        array(
          'param' => 'current_user_role',
          'operator' => '==',
          'value' => 'body_check',
        ),
      ),
      array(
        array(
          'param' => 'current_user_role',
          'operator' => '==',
          'value' => 'administrator',
        ),
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'checking',
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
  
  endif;		


// post meta acf mechanic
  if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_62bb44fd414124b7208',
    'title' => 'فحص السيارة',
    'fields' => array(
      // tab checking car
      array(
        'key' => 'field_62bb46aeb121312334128331',
        'label' => 'السيارة',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_62bc3312312312231204de6d5',
        'label' => 'سيارة الفحص',
        'name' => 'car_checking_relationship_2',
        'type' => 'relationship',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'products',
        ),
        'taxonomy' => '',
        'filters' => array(
          0 => 'search',
          1 => 'post_type',
          2 => 'taxonomy',
        ),
        'elements' => array(
          0 => 'featured_image',
        ),
        'min' => '',
        'max' => 1,
        'return_format' => 'id',
      ),
      array(
        'key' => 'field_62bc3fea244233968f',
        'label' => 'تاريخ الفحص',
        'name' => 'date_checking_2',
        'type' => 'date_picker',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'display_format' => 'F j, Y',
        'return_format' => 'F j, Y',
        'first_day' => 1,
      ),





      // المحرك وناقل الحركه
      array(
        'key' => 'field_62bb46aeb12123231231312334128331',
        'label' => 'المحرك وناقل الحركه',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),

     array(
        'key' => 'field_62bb4124141241429',
        'label' => 'الصوفة الامامية',
        'name' => 'car_checking_29',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312429',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_29_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241429',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241430',
        'label' => 'حالة الماكينة ( النسبة     % )',
        'name' => 'car_checking_30',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312430',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_30_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241430',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241431',
        'label' => 'الصوفة الخلفية',
        'name' => 'car_checking_31',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312431',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_31_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241431',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241432',
        'label' => 'تصفية ماكينة',
        'name' => 'car_checking_32',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312432',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_32_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241432',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241433',
        'label' => 'كرسي الماكينة',
        'name' => 'car_checking_33',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312433',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_33_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241433',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241434',
        'label' => 'وجه كرتير الماكينة',
        'name' => 'car_checking_34',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312434',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_34_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241434',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241435',
        'label' => 'وجه غطاء البلوف',
        'name' => 'car_checking_35',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312435',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_35_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241435',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241436',
        'label' => 'قاعدة فلتر الزيت',
        'name' => 'car_checking_36',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312436',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_36_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241436',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241437',
        'label' => 'وجه الثلاجة',
        'name' => 'car_checking_37',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312437',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_37_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241437',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241438',
        'label' => 'تهريبات ماء',
        'name' => 'car_checking_38',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312438',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_38_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241438',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241439',
        'label' => 'رادياتير الماء',
        'name' => 'car_checking_39',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312439',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_39_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241439',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241440',
        'label' => 'وجه صدر الماكينة امام / خلفي',
        'name' => 'car_checking_40',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312440',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_40_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241440',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241441',
        'label' => 'طرمبة الماء',
        'name' => 'car_checking_41',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312441',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_41_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241441',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241442',
        'label' => 'السيور',
        'name' => 'car_checking_42',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312442',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_42_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241442',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241458',
        'label' => 'صفايه البنزين',
        'name' => 'car_checking_58',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312458',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_58_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241458',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241443',
        'label' => 'فلتر الهواء',
        'name' => 'car_checking_43',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312443',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_43_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241443',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241444',
        'label' => 'وجه طرمبة الزيت',
        'name' => 'car_checking_44',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312444',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_44_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241444',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241445',
        'label' => 'كرسي الجير بوكس',
        'name' => 'car_checking_45',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312445',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_45_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241445',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241446',
        'label' => 'وجه كرتير الجير',
        'name' => 'car_checking_46',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312446',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_46_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241446',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241447',
        'label' => 'صوف عصا الجير',
        'name' => 'car_checking_47',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312447',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_47_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241447',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241448',
        'label' => 'ماسورة مبرد الجير',
        'name' => 'car_checking_48',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312448',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_48_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241448',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241449',
        'label' => 'حالة الجير',
        'name' => 'car_checking_49',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312449',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_49_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241449',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241450',
        'label' => 'عدم وجود تسرب زيت من المحرك ',
        'name' => 'car_checking_50',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312450',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_50_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241450',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241451',
        'label' => 'مروحه المحرك ',
        'name' => 'car_checking_51',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312451',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_51_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241451',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241452',
        'label' => 'دورة التبريد وخراطيم الفرامل ',
        'name' => 'car_checking_52',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312452',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_52_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241452',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241453',
        'label' => 'بكرات سير المحرك ',
        'name' => 'car_checking_53',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312453',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_53_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241453',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241454',
        'label' => 'نظام التعليق وإمتصاص الصدمات ',
        'name' => 'car_checking_54',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312454',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_54_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241454',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241455',
        'label' => 'حوامل التوجيه وقضبان الربط ',
        'name' => 'car_checking_55',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312455',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_55_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241455',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241456',
        'label' => 'محور العجلة ',
        'name' => 'car_checking_56',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312456',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_56_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241456',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457',
        'label' => 'محور التدوير ',
        'name' => 'car_checking_57',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_57_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bc432a5243434255345341412827c',
        'label' => 'ملاحظات بالصور',
        'name' => 'checking_with_image_3',
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
        'layout' => 'block',
        'button_label' => 'اضافة ملاحظة',
        'sub_fields' => array(
          array(
            'key' => 'field_62bcvdsfffw12317d',
            'label' => 'الملاحظة',
            'name' => 'text_note_3',
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
          array(
            'key' => 'field_62bc43vef314827e',
            'label' => 'الصورة',
            'name' => 'img_note_3',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),










      // الفرامل والدفرنس
      array(
        'key' => 'field_62bb46aeb121232wqe2314s128331',
        'label' => 'الفرامل والدفرنس',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),




      array(
        'key' => 'field_62bf11086c03e',
        'label' => 'الفرامل',
        'name' => '',
        'type' => 'message',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => 'فحص الفرامل',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),

      array(
        'key' => 'field_62bb41241412414570059',
        'label' => 'فرامل (امامية / خلفية)',
        'name' => 'car_checking_59',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570059',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_59_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570059',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570060',
        'label' => 'هوب (امامي / خلفي)',
        'name' => 'car_checking_60',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570060',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_60_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570060',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570061',
        'label' => 'فلنجات (امامية / خلفية)',
        'name' => 'car_checking_61',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570061',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_61_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570061',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570062',
        'label' => 'علبة الفرامل الرئيسية',
        'name' => 'car_checking_62',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570062',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_62_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570062',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570063',
        'label' => 'سلندر (امامي / خلفي)',
        'name' => 'car_checking_63',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570063',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_63_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570063',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570064',
        'label' => 'سلك فرامل اليد (جلنط)',
        'name' => 'car_checking_64',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570064',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_64_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570064',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570065',
        'label' => 'ليات فرامل',
        'name' => 'car_checking_65',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_65_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bf1108614124c03e',
        'label' => 'الدفرنس',
        'name' => '',
        'type' => 'message',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => 'فحص الفرامل',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      

      array(
        'key' => 'field_62bb4124141241457006566',
        'label' => 'العكوس الامامية',
        'name' => 'car_checking_66',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006566',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_66_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006566',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb4124141241457006567',
        'label' => 'العكوس الخلفية',
        'name' => 'car_checking_67',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006567',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_67_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006567',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb4124141241457006568',
        'label' => 'العكوس الدفرنس',
        'name' => 'car_checking_68',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006568',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_68_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006568',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb4124141241457006569',
        'label' => 'دفرنس امام / خلفي',
        'name' => 'car_checking_69',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006569',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_69_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006569',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb4124141241457006570',
        'label' => 'صوفة عكس (امامي / خلفي)',
        'name' => 'car_checking_70',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006570',
        'label' => 'ملاحظات ',
        'name' => 'car_checking_70_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006570',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      



      array(
        'key' => 'field_62bc432a5fdfdfds341412827c',
        'label' => 'ملاحظات بالصور',
        'name' => 'checking_with_image_4',
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
        'layout' => 'block',
        'button_label' => 'اضافة ملاحظة',
        'sub_fields' => array(
          array(
            'key' => 'field_62bcfdfssdfs317d',
            'label' => 'الملاحظة',
            'name' => 'text_note_4',
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
          array(
            'key' => 'field_6ewre4423427e',
            'label' => 'الصورة',
            'name' => 'img_note_4',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),











      // اسفل السياره
      array(
        'key' => 'field_62bb46aeb12123214s128331',
        'label' => 'اسفل السياره',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      


      array(
        'key' => 'field_62bb4124141241457006571',
        'label' => 'الهيكل السفلى',
        'name' => 'car_checking_71',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006571',
        'label' => 'ملاحظات',
        'name' => 'car_checking_71_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006571',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006572',
        'label' => 'الركبة اليمنى واليسرى',
        'name' => 'car_checking_72',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006572',
        'label' => 'ملاحظات',
        'name' => 'car_checking_72_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006572',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006573',
        'label' => 'ذراع شاص',
        'name' => 'car_checking_73',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006573',
        'label' => 'ملاحظات',
        'name' => 'car_checking_73_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006573',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006574',
        'label' => 'ذراع الدودة',
        'name' => 'car_checking_74',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006574',
        'label' => 'ملاحظات',
        'name' => 'car_checking_74_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006574',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006575',
        'label' => 'علبة الدركسيون (طلمبة)',
        'name' => 'car_checking_75',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006575',
        'label' => 'ملاحظات',
        'name' => 'car_checking_75_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006575',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006576',
        'label' => 'الدودة',
        'name' => 'car_checking_76',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006576',
        'label' => 'ملاحظات',
        'name' => 'car_checking_76_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006576',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006577',
        'label' => 'عامود الدركسيون',
        'name' => 'car_checking_77',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006577',
        'label' => 'ملاحظات',
        'name' => 'car_checking_77_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006577',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006578',
        'label' => 'المساعدات الامامية / كراسي مساعدات',
        'name' => 'car_checking_78',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006578',
        'label' => 'ملاحظات',
        'name' => 'car_checking_70_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006578',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006579',
        'label' => 'المساعدات الخلفيه',
        'name' => 'car_checking_79',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006579',
        'label' => 'ملاحظات',
        'name' => 'car_checking_79_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006579',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006580',
        'label' => 'مسمام عامود التوازن',
        'name' => 'car_checking_80',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006580',
        'label' => 'ملاحظات',
        'name' => 'car_checking_80_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006580',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006581',
        'label' => 'صليب عامود الدوران',
        'name' => 'car_checking_81',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006581',
        'label' => 'ملاحظات',
        'name' => 'car_checking_81_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006581',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006582',
        'label' => 'جلد المقص العلوي',
        'name' => 'car_checking_82',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006582',
        'label' => 'ملاحظات',
        'name' => 'car_checking_82_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006582',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006583',
        'label' => 'جلد المقص السفلي',
        'name' => 'car_checking_83',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006583',
        'label' => 'ملاحظات',
        'name' => 'car_checking_83_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006583',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006584',
        'label' => 'اليايات',
        'name' => 'car_checking_84',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006584',
        'label' => 'ملاحظات',
        'name' => 'car_checking_84_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006584',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      





      array(
        'key' => 'field_62bf11086141e12312124c03e',
        'label' => 'السوائل',
        'name' => '',
        'type' => 'message',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => 'فحص الفرامل',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      
      array(
        'key' => 'field_62bb4124141241457006585',
        'label' => 'زيت الماكينة',
        'name' => 'car_checking_85',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006585',
        'label' => 'ملاحظات',
        'name' => 'car_checking_85_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006585',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006586',
        'label' => 'زيت الجير',
        'name' => 'car_checking_86',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006586',
        'label' => 'ملاحظات',
        'name' => 'car_checking_86_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006586',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006587',
        'label' => 'زيت الفرامل',
        'name' => 'car_checking_87',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006587',
        'label' => 'ملاحظات',
        'name' => 'car_checking_87_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006587',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006588',
        'label' => 'ماء الرديتر',
        'name' => 'car_checking_88',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006588',
        'label' => 'ملاحظات',
        'name' => 'car_checking_88_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006588',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      
      array(
        'key' => 'field_62bb4124141241457006589',
        'label' => 'ماء المساحات',
        'name' => 'car_checking_89',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006589',
        'label' => 'ملاحظات',
        'name' => 'car_checking_89_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006589',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      


      array(
        'key' => 'field_62bc43555dfdsfdf7c',
        'label' => 'ملاحظات بالصور',
        'name' => 'checking_with_image_5',
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
        'layout' => 'block',
        'button_label' => 'اضافة ملاحظة',
        'sub_fields' => array(
          array(
            'key' => 'field_62b54555fdffdfd',
            'label' => 'الملاحظة',
            'name' => 'text_note_5',
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
          array(
            'key' => 'field_6ewerewrewrwerwe27e',
            'label' => 'الصورة',
            'name' => 'img_note_5',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),












      // الاطارات
      array(
        'key' => 'field_62bb46aeewdf14s128331',
        'label' => 'الاطارات',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),


      array(
        'key' => 'field_62bb4124141241457006590',
        'label' => 'إطارات متماثلة  ( النسبة % )',
        'name' => 'car_checking_90',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006590',
        'label' => 'ملاحظات',
        'name' => 'car_checking_90_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006590',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006591',
        'label' => 'جنوط الإطارات (بدون خدوش/صدمات)',
        'name' => 'car_checking_91',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006591',
        'label' => 'ملاحظات',
        'name' => 'car_checking_91_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006591',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006592',
        'label' => 'وسادات المكابح الأماميه',
        'name' => 'car_checking_92',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006592',
        'label' => 'ملاحظات',
        'name' => 'car_checking_92_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006592',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006593',
        'label' => 'إسطوانات المكابح الأمامية ',
        'name' => 'car_checking_93',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006593',
        'label' => 'ملاحظات',
        'name' => 'car_checking_93_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006593',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006594',
        'label' => 'وسادات المكابح الخلفية ( الفحمات )',
        'name' => 'car_checking_94',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006594',
        'label' => 'ملاحظات',
        'name' => 'car_checking_94_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006594',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006595',
        'label' => 'إسطوانات المكابح الخلفية ( الفحمات )',
        'name' => 'car_checking_95',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006595',
        'label' => 'ملاحظات',
        'name' => 'car_checking_95_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006595',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006596',
        'label' => 'جميع العروات موجودة',
        'name' => 'car_checking_96',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006596',
        'label' => 'ملاحظات',
        'name' => 'car_checking_96_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006596',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006597',
        'label' => 'جميع أقفال الإطارت والمفتاح متاحه (إن وجدت)',
        'name' => 'car_checking_97',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006597',
        'label' => 'ملاحظات',
        'name' => 'car_checking_97_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006597',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006598',
        'label' => 'جميع أدوات الصيانة متاحه (إن وجدت)',
        'name' => 'car_checking_98',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006598',
        'label' => 'ملاحظات',
        'name' => 'car_checking_98_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006598',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb4124141241457006599',
        'label' => 'إطار إحتياطى متاح بالسيارة',
        'name' => 'car_checking_99',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s312457006599',
        'label' => 'ملاحظات',
        'name' => 'car_checking_99_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb4124141241457006599',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570065100',
        'label' => 'الإطار الأمامى الأيسر',
        'name' => 'car_checking_100',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065100',
        'label' => 'ملاحظات',
        'name' => 'car_checking_100_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065100',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570065101',
        'label' => 'الإطار الأمامى الأيمن',
        'name' => 'car_checking_101',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065101',
        'label' => 'ملاحظات',
        'name' => 'car_checking_101_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065101',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb41241412414570065102',
        'label' => 'الإطار الخلفى الأيمن',
        'name' => 'car_checking_102',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065102',
        'label' => 'ملاحظات',
        'name' => 'car_checking_102_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065102',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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

      array(
        'key' => 'field_62bb41241412414570065103',
        'label' => 'الإطارات لم تُخلع أثناء الفحص',
        'name' => 'car_checking_103',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065103',
        'label' => 'ملاحظات',
        'name' => 'car_checking_103_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065103',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bb41241412414570065140',
        'label' => 'الإطار الخلفى الأيسر',
        'name' => 'car_checking_140',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065140',
        'label' => 'ملاحظات',
        'name' => 'car_checking_140_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065140',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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


      array(
        'key' => 'field_62bc43555dfds4234324fdf7c',
        'label' => 'ملاحظات بالصور',
        'name' => 'checking_with_image_6',
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
        'layout' => 'block',
        'button_label' => 'اضافة ملاحظة',
        'sub_fields' => array(
          array(
            'key' => 'field_62b54555324324234fdffdfd',
            'label' => 'الملاحظة',
            'name' => 'text_note_6',
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
          array(
            'key' => 'field_6ewe32434234324324234rwe27e',
            'label' => 'الصورة',
            'name' => 'img_note_6',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),


  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'checking',
      ),
      array(
        'param' => 'current_user_role',
        'operator' => '==',
        'value' => 'mechanic',
      ),
    ),
    array(
      array(
        'param' => 'current_user_role',
        'operator' => '==',
        'value' => 'administrator',
      ),
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'checking',
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

  endif;		


// post meta acf electric
  if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
      'key' => 'group_62bb44fd414124b71241244212213208',
      'title' => 'فحص السيارة',
      'fields' => array(
      // tab checking car
      array(
        'key' => 'field_62bb46aeb12131rrerewrew2334128331',
        'label' => 'السيارة',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_62bc331231231rwqrwqrqw2231204de6d5',
        'label' => 'سيارة الفحص',
        'name' => 'car_checking_relationship_3',
        'type' => 'relationship',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'products',
        ),
        'taxonomy' => '',
        'filters' => array(
          0 => 'search',
          1 => 'post_type',
          2 => 'taxonomy',
        ),
        'elements' => array(
          0 => 'featured_image',
        ),
        'min' => '',
        'max' => 1,
        'return_format' => 'id',
      ),
      array(
        'key' => 'field_62bc3fea244qwrq41421421233968f',
        'label' => 'تاريخ الفحص',
        'name' => 'date_checking_3',
        'type' => 'date_picker',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'display_format' => 'F j, Y',
        'return_format' => 'F j, Y',
        'first_day' => 1,
      ),
    

      array(
        'key' => 'field_62bb46ae321123300942421d123ew2334128331',
        'label' => 'كهرباء',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),




      array(
        'key' => 'field_62bb41241412414570065104',
        'label' => 'بطارية وأسلاكها',
        'name' => 'car_checking_104',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065104',
        'label' => 'ملاحظات',
        'name' => 'car_checking_104_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065104',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065105',
        'label' => 'الدينمو',
        'name' => 'car_checking_105',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065105',
        'label' => 'ملاحظات',
        'name' => 'car_checking_105_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065105',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065106',
        'label' => 'السلف',
        'name' => 'car_checking_106',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065106',
        'label' => 'ملاحظات',
        'name' => 'car_checking_106_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065106',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065107',
        'label' => 'الانوار',
        'name' => 'car_checking_107',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065107',
        'label' => 'ملاحظات',
        'name' => 'car_checking_107_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065107',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065108',
        'label' => 'لمكيف كمبروسر',
        'name' => 'car_checking_108',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065108',
        'label' => 'ملاحظات',
        'name' => 'car_checking_108_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065108',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065109',
        'label' => 'السنتر لوك',
        'name' => 'car_checking_109',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065109',
        'label' => 'ملاحظات',
        'name' => 'car_checking_109_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065109',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065110',
        'label' => 'المساحات',
        'name' => 'car_checking_110',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065110',
        'label' => 'ملاحظات',
        'name' => 'car_checking_110_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065110',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065111',
        'label' => 'شاشة المكيف',
        'name' => 'car_checking_111',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065111',
        'label' => 'ملاحظات',
        'name' => 'car_checking_111_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065111',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065112',
        'label' => 'كودات الكمبيوتر',
        'name' => 'car_checking_112',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065112',
        'label' => 'ملاحظات',
        'name' => 'car_checking_112_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065112',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065113',
        'label' => 'ثلاجة مكيف',
        'name' => 'car_checking_113',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065113',
        'label' => 'ملاحظات',
        'name' => 'car_checking_113_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065113',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065114',
        'label' => 'رديتر مكيف',
        'name' => 'car_checking_114',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065114',
        'label' => 'ملاحظات',
        'name' => 'car_checking_114_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065114',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065115',
        'label' => 'المحرك ',
        'name' => 'car_checking_115',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065115',
        'label' => 'ملاحظات',
        'name' => 'car_checking_115_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065115',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065116',
        'label' => 'وحدة التحكم بالمحرك ',
        'name' => 'car_checking_116',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065116',
        'label' => 'ملاحظات',
        'name' => 'car_checking_116_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065116',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065117',
        'label' => 'ناقل الحركة ',
        'name' => 'car_checking_117',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065117',
        'label' => 'ملاحظات',
        'name' => 'car_checking_117_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065117',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065118',
        'label' => 'نظام كبح ',
        'name' => 'car_checking_118',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065118',
        'label' => 'ملاحظات',
        'name' => 'car_checking_118_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065118',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065119',
        'label' => 'نظام وسادة الهوائية ',
        'name' => 'car_checking_119',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065119',
        'label' => 'ملاحظات',
        'name' => 'car_checking_119_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065119',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065120',
        'label' => 'مكيف الهواء ',
        'name' => 'car_checking_120',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065120',
        'label' => 'ملاحظات',
        'name' => 'car_checking_120_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065120',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065121',
        'label' => 'العدادات وإشارات التحذير ',
        'name' => 'car_checking_121',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065121',
        'label' => 'ملاحظات',
        'name' => 'car_checking_121_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065121',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065122',
        'label' => 'النظام الكهربى (الكشافات الأمامية، مقود مرن وغيره) ',
        'name' => 'car_checking_122',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065122',
        'label' => 'ملاحظات',
        'name' => 'car_checking_122_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065122',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065123',
        'label' => 'وسائل الراحة الداخليه ( مثبت السرعة، الكاميرا الخلفية، مستشعرات الوقوف) ',
        'name' => 'car_checking_123',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065123',
        'label' => 'ملاحظات',
        'name' => 'car_checking_123_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065123',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065124',
        'label' => 'نظام ملاحي ',
        'name' => 'car_checking_124',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065124',
        'label' => 'ملاحظات',
        'name' => 'car_checking_124_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065124',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065125',
        'label' => 'النوافذ وفتحه السقف ',
        'name' => 'car_checking_125',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065125',
        'label' => 'ملاحظات',
        'name' => 'car_checking_125_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065125',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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
      
      array(
        'key' => 'field_62bb41241412414570065126',
        'label' => 'لون انبعاثات العادم صافية (لا يوجد دخان',
        'name' => 'car_checking_126',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'succeeded' => 'نجح',
          'notice' => 'ملاحظات',
          'not_check' => 'لم تفحص',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => 'نجح',
        'layout' => 'horizontal',
        'return_format' => 'value',
        'save_other_choice' => 0,
      ),
      array(
        'key' => 'field_62bb50cds123s3124570065126',
        'label' => 'ملاحظات',
        'name' => 'car_checking_126_note',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_62bb41241412414570065126',
              'operator' => '==',
              'value' => 'notice',
            ),
          ),
        ),
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



      array(
        'key' => 'field_62bc43555dfds4234324fdf7c32432432',
        'label' => 'ملاحظات بالصور',
        'name' => 'checking_with_image_7',
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
        'layout' => 'block',
        'button_label' => 'اضافة ملاحظة',
        'sub_fields' => array(
          array(
            'key' => 'field_62b54555324324234fdffdfd423432',
            'label' => 'الملاحظة',
            'name' => 'text_note_7',
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
          array(
            'key' => 'field_6ewe32434234324324234rwe27e432432',
            'label' => 'الصورة',
            'name' => 'img_note_7',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),


    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'checking',
        ),
        array(
          'param' => 'current_user_role',
          'operator' => '==',
          'value' => 'electric',
        ),
      ),
      array(
        array(
          'param' => 'current_user_role',
          'operator' => '==',
          'value' => 'administrator',
        ),
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'checking',
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
    
  endif;		

// completely disable image size threshold
add_filter( 'big_image_size_threshold', '__return_false' );
 
// increase the image size threshold to 4000px
function mynamespace_big_image_size_threshold( $threshold ) {
    return 6000; // new threshold
}
add_filter('big_image_size_threshold', 'mynamespace_big_image_size_threshold', 999, 1);



function allowAuthorEditing()
{
  add_post_type_support( 'products', 'author' );
}

add_action('init','allowAuthorEditing');