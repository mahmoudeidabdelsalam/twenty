<?php
/* 
  * Template Name: delete Car sold
*/ 

get_header();

$args = array(
  'post_type' => array( 'cars', 'products' ),
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'meta_query' => array(
    array(
			'key' => 'sold_done',
			'value' => '1',
			'compare' => '=='
    ),
  )
);

$query = new WP_Query( $args );

?>

<div class=" container">
  <div class="row" style="margin:100px 0;">
    <?php
    $array = [];
      if ( $query->have_posts() ):
        while ( $query->have_posts() ):
          $query->the_post();
          $array[] = get_the_ID();
    ?>
      
      <span><?= the_title(); ?></span> <br>

    <?php
        endwhile;
      else: 
    ?>
      <div class="alert alert-danger" role="alert">لا يوجد سيارات</div>              
    <?php 
      endif; 
    ?>
    <br><br>
    <button id="delete_cars">delete cars</button>
  </div>
</div>


    <script type="text/javascript" >
      jQuery(function ($) {

        $('#delete_cars').on('click', function () {
          var post_ids = <?= json_encode($array); ?>;
          var action = 'delete_cars_slod';
          $.ajax({
            url: "<?= admin_url( 'admin-ajax.php' ); ?>",
            type: 'post',
            data: {
              action: action,
              post_ids: post_ids,
            },
            beforeSend: function () {
            },
            success: function (response) {
              
            },
          });
        });

      });
    </script>
<?php

get_footer();
?>
