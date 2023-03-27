<?php
get_header();
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    $images = get_field('car_galleries');



    $terms = get_the_terms( get_the_ID(), 'products-tag' );

    $checking = array(
      'post_type' => 'checking',
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key' => 'car_checking_relationship_2',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        ),
        array(
          'key' => 'car_checking_relationship_2',
          'value' => get_the_ID(),
          'compare' => '='
        ),
        array(
          'key' => 'car_checking_relationship_1',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        ),
        array(
          'key' => 'car_checking_relationship_1',
          'value' => get_the_ID(),
          'compare' => '='
        ),                
        array(
          'key' => 'car_checking_relationship_3',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        ),
        array(
          'key' => 'car_checking_relationship_3',
          'value' => get_the_ID(),
          'compare' => '='
        )
      )
    );
    
  $query_checking = new WP_Query( $checking );
  $counter = get_post_meta( get_the_ID(), 'link_click_counter', true );

  $author_id = get_the_author_meta('ID');
  $user_phone = get_field('user_phone', 'user_'. $author_id);
  $user_whatsapp = get_field('user_whatsapp', 'user_'. $author_id);
  $installment = get_field('vendor_cars_installment', 'user_'. $author_id);

  $user_logo = get_field('user_logo', 'user_'. $author_id);

?> 

  <!-- Page Header Start -->
  <div class="container-fluid page-header mb-3" style="background-image:url('<?= $featured_img_url; ?>');">
    <h1 class="display-3 text-uppercase text-white mb-3"><?= the_title(); ?></h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="<?php echo esc_url(home_url('/')); ?>">الرئيسية</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
    </div>
  </div>
  <!-- Page Header Start -->

  <!-- Detail Start -->
  <div class="container-fluid">
    <div class="container pb-3">
      <div class="row align-items-center pb-2 d-flex" style="flex-wrap: wrap;">

        <div class="col-lg-8 mb-4 order-1 col-12">
          <?php if(get_field('sold_done')): ?>
            <div class="sold-done">
              <p><img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/pay_done.png' ?>" alt="تم البياع" /></p>
            </div>
          <?php endif; ?>
          <h1 class="display-4 text-uppercase"><?= the_title(); ?></h1>
          <span class="number-car"><b>رقم الاعلان</b> <?= get_the_ID(); ?></span>

            <div class="content-carousel single-carousel-car">
                <div class="owl-carousel owl-interior">
                    <?php if($featured_img_url): ?>
                        <div><img class="img-fluid" src="<?= $featured_img_url; ?>" alt="<?= the_title(); ?>"></div>
                    <?php endif; ?>
                
                    <?php if($images): ?>
                      <?php foreach( $images as $image ): ?>
                        <div><img src="<?= $image; ?>" alt="slide"></div>
                      <?php endforeach; ?>
                    <?php endif; ?>  
                </div>
            </div>

          <div class="content-car" style="margin-bottom:15px;display:inline-block;width:100%;">
            <?= the_content(); ?>
          </div>

          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">بيانات السيارة</a></li>
            <!--<?php if($installment == 'installment'): ?>-->
            <!--  <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">اقساط</a></li>-->
            <!--  <li role="presentation" class=""><a href="#calculator" aria-controls="calculator" role="tab" data-toggle="tab">حاسبة الاقساط</a></li>-->
            <!--<?php endif; ?>-->
            <?php if ( $query_checking->have_posts() ): ?>
              <li role="presentation" class=""><a href="/car-checking/?car_id=<?= get_the_ID(); ?>">الفحص</a></li>
            <?php endif; ?>
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
              <h4 class="mb-2">السعر شامل الضريبة: <?= get_field('price'); ?> <?= get_field('currency_pricing', 'option'); ?></h4>

              
                <ul>
                  <?php if ($terms[0]->term_id == "16") : ?>
                    <li><span>اللون:</span> <?= get_field('color_car'); ?></li>
                    <li><span>الفئة:</span> <?= get_field('model_car'); ?></li>
                    <li><span>الممشى:</span> <?= get_field('km_car'); ?></li>
                  <?php endif; ?>
                  <li><span>رقم الأعلان:</span> <?= get_the_ID(); ?></li>
                </ul>
              

              <h3>كيف تشتري سيارتك</h3>
              <div class="col-steps">
              <?php
              if( have_rows('steps_sale_car', 'option') ):
                while( have_rows('steps_sale_car', 'option') ) : the_row();
              ?>
                <div class="bg-light p-4">
                  <p><?= the_sub_field('text_step'); ?></p>
                  <img src="<?= the_sub_field('icon_step'); ?>" alt="">
                </div>
                <?php endwhile; ?>
              <?php endif; ?> 
              </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile">
              <div class="list-finance">
                <?php if(get_field('price_finance_duration')): ?>
                  <p><span>مدة القسط</span> <?= get_field('price_finance_duration'); ?> شهر</p>
                <?php else: ?>
                  <p><span>مدة القسط</span>  <span>60</span> شهر</p>
                <?php endif; ?>
                <?php if(get_field('the_first_batch')): ?>
                  <p><span>الدفعة الأولى</span> <?= get_field('the_first_batch'); ?> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php else: ?>
                  <p><span>الدفعة الأولى</span> <span class="the-first-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php endif; ?>
                <?php if(get_field('finance_month')): ?>
                  <p><span>القسط</span> <?= get_field('finance_month'); ?> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php else: ?>
                  <p><span>القسط</span> <span class="the-finance-month"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php endif; ?>
                <?php if(get_field('the_last_batch')): ?>
                  <p><span>الدفعة الأخيرة</span> <?= get_field('the_last_batch'); ?> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php else: ?>
                  <p><span>الدفعة الأخيرة</span> <span class="the-last-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php endif; ?>                                  
              </div>
              <h3>كيف تمول سيارتك</h3>
              <div class="col-steps">
                <?php
                if( have_rows('steps_finance_car', 'option') ):
                  while( have_rows('steps_finance_car', 'option') ) : the_row();
                ?>
                  <div class="bg-light p-4">
                    <p><?= the_sub_field('text_step_finance'); ?></p>
                    <img src="<?= the_sub_field('icon_step_finance'); ?>" alt="">
                  </div>
                  <?php endwhile; ?>
                <?php endif; ?> 
              </div>


              <?php $form_id_finance = get_field('form_id_finance', 'option'); ?>
              


              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                لطلب تمويل
              </button>

              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"> لطلب تمويل</h4>
                    </div>
                    <div class="modal-body">
                    <?=  do_shortcode( '[gravityform id="'.$form_id_finance.'" title="false" description="false" ajax="true"]' ); ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div role="tabpanel" class="tab-pane" id="calculator">
              <h5>حاسبة تقريبة للاقساط</h5>
              <p>يمكنك تعديل فترة القسط و الدفعة الاولي للحصول علي القسط المنناسب</p>
              <div class="list-finance">
                <?php if(get_field('price_finance_duration')): ?>
                  <p><span>مدة القسط</span> <?= get_field('price_finance_duration'); ?> شهر</p>
                <?php else: ?>
                  <p><span>مدة القسط</span>  <span>60</span> شهر</p>
                <?php endif; ?>
                <?php if(get_field('the_first_batch')): ?>
                  <p><span>الدفعة الأولى</span> <?= get_field('the_first_batch'); ?> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php else: ?>
                  <p><span>الدفعة الأولى</span> <span class="the-first-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php endif; ?>
                <?php if(get_field('finance_month')): ?>
                  <p><span>القسط</span> <?= get_field('finance_month'); ?> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php else: ?>
                  <p><span>القسط</span> <span class="the-finance-month"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php endif; ?>
                <?php if(get_field('the_last_batch')): ?>
                  <p><span>الدفعة الأخيرة</span> <?= get_field('the_last_batch'); ?> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php else: ?>
                  <p><span>الدفعة الأخيرة</span> <span class="the-last-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                <?php endif; ?>
              </div>

              <div class="installment-account">
                <div class="group-input">
                  <div class="d-flex">
                    <label for="month">مدة القسط</label>
                    <select name="month" id="month">
                      <option value="0">اختر</option>
                      <option value="60">60 شهور</option>
                      <option value="48">48 شهر</option>
                      <option value="36">36 شهر</option>
                      <option value="24">24 شهر</option>
                      <option value="12">12 شهر</option>
                    </select>
                  </div>
                  <div class="d-flex">
                  <label for="month">الدفعة الأولى</label>
                    <input type="number" id="price">                        
                  </div>
                  <div class="d-flex">
                    <button id="calculation">حساب القسط <i class="fa fa-calculator"></i></button>
                  </div>
                  <div class="response">
                    <div id="month">
                      <b>مدة القسط :</b> <span></span>
                    </div>
                    <div id="first_batch">
                      <b>الدفعة الأولى:</b> <span></span>
                    </div>
                    <div id="last_batch">
                      <b>الدفعة الأخيرة:</b> <span></span>
                    </div>
                    <div id="monthly_installment">
                      <b>القسط الشهري:</b> <span></span>
                    </div>                            
                  </div>
                </div>
              </div>

            </div>

            <?php if(get_field('date_examination')): ?>
              <div role="tabpanel" class="tab-pane" id="examination">
                <h5>تاريخ الفحص: <?= the_field('date_examination'); ?></h5>
                <?php if(get_field('picture_from_examination')): ?>
                  <img class="img-fluid" src="<?= the_field('picture_from_examination'); ?>" alt="<?= the_field('date_examination'); ?>">
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>

        </div>

        <div class="col-lg-4 mb-4 order-2 col-12">


          <div id="counter"><?= $counter; ?> <i class="fa fa-eye" aria-hidden="true"></i> أشخاص شاهدوا هذه السيارة خلال آخر ساعة.</div>

          
          <div class="author-showroom">
            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"> 
              <?php if($user_logo): ?>
                <div class="logo-author"><img class="img-fluid" src="<?= $user_logo; ?>" alt="<?= the_author_meta( 'display_name', $author->ID ); ?>"></div>
              <?php endif; ?>
              <p><?= get_the_author_meta('display_name', $author_id); ?></p>
            </a>
          </div>
          <ul class="contact-information informations-user">
            <li>
              <a href="https://wa.me/<?= $user_whatsapp; ?>" class="whatsapp" target="_blank">
                <img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/whatsapp.png' ?>" alt="<?=get_bloginfo('name', 'display'); ?>" title="<?= get_bloginfo('name'); ?>" style="width:45px;"/>
              </a>
            </li>
            <li>
              <a href="tel:<?= $user_phone; ?>">
                <img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/phone.png' ?>" alt="<?=get_bloginfo('name', 'display'); ?>" title="<?= get_bloginfo('name'); ?>" style="width:40px;"/>
              </a>
            </li>
            <a id="countable_link" href="javascript:void(0)">للتواصل اضغط هنا. <i class="fa fa-eye-slash" aria-hidden="true"></i></a>
          </ul>

          <h4>تفاصيل السيارة</h4>
          <div class="row mt-n3 mt-lg-0 pb-4 car-information">
            <?php
            if( have_rows('specifications') ):
              while( have_rows('specifications') ) : the_row();
            ?>
              <div class="col-md-12 col-6 mb-2 information">
                <i class="<?= the_sub_field('icon_specifications'); ?> text-primary mr-2"></i>
                <span><?= the_sub_field('text_specifications'); ?></span>
              </div>
              <?php endwhile; ?>
            <?php endif; ?>             
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Detail End -->


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

  <script type="text/javascript" >
  jQuery(function ($) {

    <?php if($terms[0]->term_id): ?>

      $('#calculation').on('click', function () {
        var price = Number(<?= get_field('price'); ?>);
        var month = $('#month').find(":selected").val();
        if(month === '0') {
          month = 60
        }
        var first_batch =  $('#price').val();
        $('#first_batch span').html('يبدأ من ' + first_batch);

        var last_batch = price * 0.25
        $('#last_batch span').html('يبدأ من ' + last_batch);

        var subtotal = price * 7.5 / 100;

        var total = price - first_batch - last_batch + subtotal;

        console.log(total);

        var monthly_installment = total / month;
        $('#monthly_installment span').html('يبدأ من ' + Math.round(monthly_installment));

        $('#month span').html('يبدأ من ' + month);
      });


      $( window ).load(function() {
        var price = Number(<?= get_field('price'); ?>); 

        var first_batch = price * 0.1;
        var last_batch = price * 0.25;

        var cost = (price * 7.5 / 100) + 3000;
        var total = price - first_batch - last_batch + cost;

        var monthly_installment = total / 60;

        $('.the-first-batch').html('يبدأ من ' + first_batch);
        $('.the-finance-month').html('يبدأ من ' + Math.round(monthly_installment));
        $('.the-last-batch').html('يبدأ من ' + Math.round(last_batch));
      });

    <?php else: ?>

      $('#calculation').on('click', function () {
        var price = Number(<?= get_field('price'); ?>);
        var month = $('#month').find(":selected").val();
        if(month === '0') {
          month = 60
        }
        var first_batch =  $('#price').val();
        $('#first_batch span').html('يبدأ من ' + first_batch);

        var last_batch = price * 0.25
        $('#last_batch span').html('يبدأ من ' + last_batch);

        var subtotal = price * 11.5 / 100;

        var total = price - first_batch - last_batch + subtotal;

        console.log(total);

        var monthly_installment = total / month;
        $('#monthly_installment span').html('يبدأ من ' + Math.round(monthly_installment));

        $('#month span').html('يبدأ من ' + month);
      });


      $( window ).load(function() {
        var price = Number(<?= get_field('price'); ?>); 

        var first_batch = price * 0.1;
        var last_batch = price * 0.25;

        var cost = (price * 11.5 / 100) + 3000;
        var total = price - first_batch - last_batch + cost;

        var monthly_installment = total / 60;

        $('.the-first-batch').html('يبدأ من ' + first_batch);
        $('.the-finance-month').html('يبدأ من ' + monthly_installment);
        $('.the-last-batch').html('يبدأ من' + Math.round(last_batch));
      });

    <?php endif; ?>




    $('#countable_link').on('click', function () {
      var post_id = <?php echo get_the_ID(); ?>;
      var action = 'link_click_counter';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          post_id: post_id,
        },
        beforeSend: function () {
        },
        success: function (response) {
          $('#counter').html(response + '<i class="fa fa-eye" aria-hidden="true"></i>  أشخاص شاهدوا هذه السيارة خلال آخر ساعة.');
          $('#countable_link').hide();
        },
      });
    });

    $( window ).load(function() {
      var post_id = <?php echo get_the_ID(); ?>;
      var action = 'link_click_counter';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          post_id: post_id,
        },
        beforeSend: function () {
        },
        success: function (response) {
          $('#counter').html(response + '<i class="fa fa-eye" aria-hidden="true"></i>  أشخاص شاهدوا هذه السيارة خلال آخر ساعة.');
        },
      });
    });

  });
</script>
<style>
.installment-account label {
    white-space: nowrap;
    padding: 20px;
    min-width: 140px;
}
.installment-account select {
    width: 100%;
    height: 50px;
}
.author-showroom iframe {
    max-width: 100%;
}
.content-car {
    margin: 30px 0;
}
.content-carousel {
    margin-bottom: 30px;
}
.single-carousel-car .owl-interior {
    width: 100%;
}
.single-carousel-car .owl-interior .owl-pagination {
    position: relative;
    top: auto;
    left: auto !important;
    height: auto;
    width: 100%;
    overflow-y: hidden;
    overflow-x: auto;
    display: flex;
    flex-wrap: nowrap;
}
.single-carousel-car .owl-interior .owl-pagination .owl-page {
    width: 120px !important;
    height: 96px !important;
    flex: 0 0 120px;
    margin: 10px;
    border-radius: 10px;
}
.sold-done p {
    display: inline-block;
    padding: 0;
    margin-bottom: 0;
    color: #fff;
}
span.number-car {
    padding: 10px;
    border: 1px solid #333;
    display: inline-block;
    margin-bottom: 15px;
}
.author-showroom a .logo-author img {
    height: 120px;
    width: 120px;
    max-width: 120px;
    border-radius: 100%;
    object-fit: cover;
}

.author-showroom a {
    display: flex;
    align-items: center;
    margin: 20px 0;
}

.author-showroom a p {
    margin-right: 10px;
    font-size: 22px;
    color: #000;
}
.sold-done img {
    max-width: 150px;
}
</style>
<?php
 }
}
get_footer();