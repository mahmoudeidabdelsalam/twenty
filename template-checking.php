<?php
/* 
  * Template Name: Car checking
*/ 

get_header(); 

$car_id   = isset($_GET['car_id']) ? $_GET['car_id'] : '0';
if($car_id):

$args_1 = array(
  'post_type' => 'checking',
  'meta_query' => array(
    'relation' => 'OR',
    array(
      'key' => 'car_checking_relationship_1',
      'value' => '"' . $car_id . '"',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'car_checking_relationship_1',
      'value' => $car_id,
      'compare' => '='
    )
  )
);

$args_2 = array(
  'post_type' => 'checking',
  'meta_query' => array(
    'relation' => 'OR',
    array(
      'key' => 'car_checking_relationship_2',
      'value' => '"' . $car_id . '"',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'car_checking_relationship_2',
      'value' => $car_id,
      'compare' => '='
    )
  )
);

$args_3 = array(
  'post_type' => 'checking',
  'meta_query' => array(
    'relation' => 'OR',
    array(
      'key' => 'car_checking_relationship_3',
      'value' => '"' . $car_id . '"',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'car_checking_relationship_3',
      'value' => $car_id,
      'compare' => '='
    )
  )
);

$query_1 = new WP_Query( $args_1 );
$query_2 = new WP_Query( $args_2 );
$query_3 = new WP_Query( $args_3 );



$number_car = get_field('number_car', $car_id);
$color_car = get_field('color_car', $car_id);
$model_car = get_field('model_car', $car_id);
?>

  <!-- Page Header Start -->
  <div class="container-fluid page-header mb-2" style="background-image:url('<?= get_theme_file_uri().'/assets/img/test-car.webp'; ?>');">
      <h1 class="display-3 text-uppercase text-white mb-3">الفحص</h1>
      <div class="d-inline-flex text-white">
          <h6 class="text-uppercase m-0"><a class="text-white" href="<?php echo esc_url(home_url('/')); ?>">الرئيسية</a></h6>
          <h6 class="text-body m-0 px-3">/</h6>
          <h6 class="text-uppercase text-body m-0"><a class="text-white" href="<?= get_permalink($car_id); ?>"><?= get_the_title($car_id); ?></a></h6>
      </div>
      <ol class="info-car d-inline-flex text-white mt-3">
        <li>رقم اللوحة: <?= $number_car; ?></li>
        <li>اللون: <?= $color_car; ?></li>
        <li>الفئة : <?= $model_car; ?></li>
      </ol>
  </div>
  <!-- Page Header Start -->

  <!-- Rent A Car Start -->
  <div class="container-fluid  checking-car">
      <div class="container pb-3">
          <h1 class="display-4 text-uppercase text-center">الفحوصات</h1>
          <ol class="info-check">
            <li><i class="fa fa-check-circle green"></i> <span>نجح</span></li>            
            <li><i class="fa fa-exclamation-circle gray"></i> <span>ملاحظات</span></li>
            <li><i class="fa fa-minus-circle red"></i> <span>لم تفحص</span></li>
          </ol>
          <p class="text-center">الفحص تم في موقع مالك السيارة، لذلك لا نضمن النتجية، وينبغي علي المشتري عمل فحص شامل للسيارة قبل شراءها</p>
          <div class="row mt-5">

            <div class="col-md-4 col-sm-12">
              <?php
              if ( $query_1->have_posts() ):
                while ( $query_1->have_posts() ):
                  $query_1->the_post();
                  $number_1 = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19);
                  $number_2 = array(20,21,22,23,24,25,26,27,28);
              ?>
                <div class="date-checking">
                  تاريخ فحص جسم السيارة : <?= the_field('date_checking'); ?>
                </div>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">   فحص الجسم الخارجي</a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <ul>
                          <?php 
                            foreach ($number_1 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <div class="checking-list">
                          <?php
                          if( have_rows('checking_with_image_1') ):
                            while ( have_rows('checking_with_image_1') ) : the_row(); 
                          ?>
                            <div class="checking-img">
                              <b><?= the_sub_field('text_note_1'); ?></b>
                              <span><img src="<?= the_sub_field('img_note_1'); ?>" alt="<?= the_sub_field('text_note_1'); ?>"></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">   فحص جسم الداخلي</a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <ul>
                          <?php 
                            foreach ($number_2 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <div class="checking-list">
                          <?php
                          if( have_rows('checking_with_image_2') ):
                            while ( have_rows('checking_with_image_2') ) : the_row(); 
                          ?>
                            <div class="checking-img">
                              <b><?= the_sub_field('text_note_2'); ?></b>
                              <span><img src="<?= the_sub_field('img_note_2'); ?>" alt="<?= the_sub_field('text_note_2'); ?>"></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
                endwhile;
              endif;
              ?>     
            </div>
            <?php wp_reset_postdata(); ?>

            <div class="col-md-4 col-sm-12">
              <?php
              if ( $query_2->have_posts() ):
                while ( $query_2->have_posts() ):
                  $query_2->the_post();
                  $number_3 = array(29,30,31,32,33,34,35,36,37,38,39,40,41,42,58,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57);
                  //فحص الفرامل
                  $number_4 = array(59,60,61,62,63,64,65);
                  //الدفرنس
                  $number_5 = array(66,67,68,69,70);
                  //اسفل السياره
                  //الهيكل السفلى
                  $number_6 = array(71,72,73,74,75,76,77,78,79,80,81,82,83,84);
                  //السوائل
                  $number_7 = array(85,86,87,88,89);
                  //الاطار
                  $number_8 = array(90,91,92,93,94,95,96,97,98,99,100,101,102,103,140);
              ?>
                <div class="date-checking">
                  تاريخ فحص المحرك : <?= the_field('date_checking_2'); ?>
                </div>
                <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne_1">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne">  المحرك وناقل الحركه</a>
                      </h4>
                    </div>
                    <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                    <div class="panel-body">
                        <ul>
                          <?php 
                            foreach ($number_3 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <div class="checking-list">
                          <?php
                          if( have_rows('checking_with_image_3') ):
                            while ( have_rows('checking_with_image_3') ) : the_row(); 
                          ?>
                            <div class="checking-img">
                              <b><?= the_sub_field('text_note_3'); ?></b>
                              <span><img src="<?= the_sub_field('img_note_3'); ?>" alt="<?= the_sub_field('text_note_3'); ?>"></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo_1">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false" aria-controls="collapseTwo">  الفرامل والدفرنس</a>
                      </h4>
                    </div>
                    <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                        <span>فحص الفرامل</span>
                        <ul>
                          <?php 
                            foreach ($number_4 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <span>الدفرنس</span>
                        <ul>
                          <?php 
                            foreach ($number_5 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <div class="checking-list">
                          <?php
                          if( have_rows('checking_with_image_4') ):
                            while ( have_rows('checking_with_image_4') ) : the_row(); 
                          ?>
                            <div class="checking-img">
                              <b><?= the_sub_field('text_note_4'); ?></b>
                              <span><img src="<?= the_sub_field('img_note_4'); ?>" alt="<?= the_sub_field('text_note_4'); ?>"></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>                        
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree_1">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false" aria-controls="collapseThree_1">  اسفل السياره </a>
                      </h4>
                    </div>
                    <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1">
                      <div class="panel-body">
                        <ul>
                          <?php 
                            foreach ($number_6 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <span>السوائل</span>
                        <ul>
                          <?php 
                            foreach ($number_7 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <div class="checking-list">
                          <?php
                          if( have_rows('checking_with_image_5') ):
                            while ( have_rows('checking_with_image_5') ) : the_row(); 
                          ?>
                            <div class="checking-img">
                              <b><?= the_sub_field('text_note_5'); ?></b>
                              <span><img src="<?= the_sub_field('img_note_5'); ?>" alt="<?= the_sub_field('text_note_5'); ?>"></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>                        
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour_1">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseFour_1" aria-expanded="false" aria-controls="collapseFour_1">  الاطارات  </a>
                      </h4>
                    </div>
                    <div id="collapseFour_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour_1">
                      <div class="panel-body">
                        <ul>
                          <?php 
                            foreach ($number_8 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <div class="checking-list">
                          <?php
                          if( have_rows('checking_with_image_6') ):
                            while ( have_rows('checking_with_image_6') ) : the_row(); 
                          ?>
                            <div class="checking-img">
                              <b><?= the_sub_field('text_note_6'); ?></b>
                              <span><img src="<?= the_sub_field('img_note_6'); ?>" alt="<?= the_sub_field('text_note_6'); ?>"></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>
                      </div>
                    </div>
                  </div>                  
                </div>
              <?php
                endwhile;
              endif;
              ?>     
            </div>
            <?php wp_reset_postdata(); ?>

            <div class="col-md-4 col-sm-12">
              <?php
              if ( $query_3->have_posts() ):
                while ( $query_3->have_posts() ):
                  $query_3->the_post();
                  $number_9 = array(104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126);
              ?>
                <div class="date-checking">
                  تاريخ فحص الكهرباء : <?= the_field('date_checking_3'); ?>
                </div>
                <div class="panel-group" id="accordion_2" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne_2">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_2" aria-expanded="false" aria-controls="collapseOne_2">   كهرباء</a>
                      </h4>
                    </div>
                    <div id="collapseOne_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
                      <div class="panel-body">
                        <ul>
                          <?php 
                            foreach ($number_9 as $number): 
                              $field = get_field_object('car_checking_'. $number);
                              $note = get_field('car_checking_'.$number.'_note');
                            ?>
                          <li><?php echo $field['label']; ?>: <?php if($field['value'] == 'notice'): ?> <button type="button" class="btn p-0" data-toggle="tooltip" data-placement="top" title="<?= $note; ?>"><i class="fa fa-exclamation-circle"></i></button>  <?php else: ?>    <i class="<?php echo $field['value']; ?> fa <?= ($field['value'] == 'succeeded')? 'fa-check-circle':'fa-minus-circle'; ?>"></i><?php endif; ?></li>
                          <?php endforeach; ?>
                        </ul>
                        <div class="checking-list">
                          <?php
                          if( have_rows('checking_with_image_6') ):
                            while ( have_rows('checking_with_image_6') ) : the_row(); 
                          ?>
                            <div class="checking-img">
                              <b><?= the_sub_field('text_note_6'); ?></b>
                              <span><img src="<?= the_sub_field('img_note_6'); ?>" alt="<?= the_sub_field('text_note_6'); ?>"></span>
                            </div>
                          <?php 
                            endwhile;
                          endif;
                        ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
                endwhile;
              endif;
              ?>     
            </div>
            <?php wp_reset_postdata(); ?>

          </div>
      </div>
  </div>
  <!-- Rent A Car End -->


<style>
.page-header {
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    height: 500px;
    background-attachment: unset;
    margin-top: 30px;
}
</style>
<?php
endif;
get_footer();
?>
