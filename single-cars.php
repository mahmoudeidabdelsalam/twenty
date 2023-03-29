<?php
get_header();


$get_basic_specifications = get_field('id_basic_specifications');

$car_id = get_the_ID();

$query = new WP_Query( array( 'post_type' => 'basic_specifications', 'post__in' => array($get_basic_specifications) ) );

if ($query->have_posts()):
  while ($query->have_posts()):
    $query->the_post();

    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    $images = get_field('car_galleries');
    $author_id = get_the_author_meta('ID');
    $user_phone = get_field('user_phone', 'user_'. $author_id);
    $user_whatsapp = get_field('user_whatsapp', 'user_'. $author_id);
    $installment = get_field('vendor_cars_installment', 'user_'. $author_id);
    $user_logo = get_field('user_logo', 'user_'. $author_id);

    $car_price = get_field('price', $car_id );
    $galleries = get_field('car_galleries', $car_id);

    $term_obj_list = get_the_terms( get_the_ID(), 'basic-brand' );
    $brands = join(', ', wp_list_pluck($term_obj_list, 'name'));

    $term_fuel_list = get_the_terms( get_the_ID(), 'fuel-type' );
    $fuels = join(', ', wp_list_pluck($term_fuel_list, 'name'));

    $term_gear_list = get_the_terms( get_the_ID(), 'gear-type' );
    $gears = join(', ', wp_list_pluck($term_gear_list, 'name'));

    $term_push_list = get_the_terms( get_the_ID(), 'push-type' );
    $pushs = join(', ', wp_list_pluck($term_push_list, 'name'));

    $term_cylinders_list = get_the_terms( get_the_ID(), 'cylinders-type' );
    $cylinders = join(', ', wp_list_pluck($term_cylinders_list, 'name'));

    $term_engine_list = get_the_terms( get_the_ID(), 'engine-type' );
    $engines = join(', ', wp_list_pluck($term_engine_list, 'name')); 
    
    $term_model_list = get_the_terms( $car_id, 'products-model' );
    $model = join(', ', wp_list_pluck($term_model_list, 'name')); 
    
    $term_tag_list = get_the_terms( $car_id, 'products-tag' );
    $tag = join(', ', wp_list_pluck($term_tag_list, 'name')); 
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
          <div class="row align-items-center pb-2 d-flex" style="flex-wrap: wrap;align-items: flex-start;">

          <?php if(get_field('sold_done')): ?>
            <div class="sold-done">
              <p><img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/pay_done.png' ?>" alt="تم البياع" /></p>
            </div>
          <?php endif; ?>

            <div class="col-lg-8 mb-4 order-1 col-12">
              <?php if(get_field('sold_done')): ?>
                <div class="sold-done">
                  <p><img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/pay_done.png' ?>" alt="تم البياع" /></p>
                </div>
              <?php endif; ?>
              <h1 class="display-4 text-uppercase"><?= the_title(); ?></h1>
              <span class="number-car"><b>حالة السيارة</b> #<?= $tag; ?></span>
              <span class="number-car"><b>موديل</b> #<?= $model; ?></span>
              <span class="number-car"><b>رقم الاعلان</b> #<?= $car_id; ?>-<?= get_the_ID(); ?></span>

              <div class="content-carousel single-carousel-car">
                <div class="owl-carousel owl-interior">
                  <div><img class="img-fluid" src="<?= $featured_img_url; ?>" alt="<?= the_title(); ?>"></div>
                  <?php if($images): ?>
                  <?php foreach( $images as $image ):?>
                    <div><img src="<?= $image['url']; ?>" alt="slide"></div>
                  <?php endforeach; ?>
                  <?php elseif($galleries): ?>
                    <?php foreach( $galleries as $image ): ?>
                      <div><img src="<?= $image['url']; ?>" alt="slide"></div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>

              <h4>تفاصيل السيارة</h4>
              <div class="row mt-n3 mt-lg-0 pb-4 car-information">
                <div class="col-md-6 col-6 mb-2 information">
                  <h5>الأمان</h5>
                  <?php
                  if( have_rows('specifications') ):
                    while( have_rows('specifications') ) : the_row();
                  ?>
                  <div>
                    <i class="fa <?= the_sub_field('icon_specifications'); ?> text-primary mr-2"></i>
                    <span><?= the_sub_field('text_specifications'); ?></span>
                    </div>
                  <?php 
                    endwhile; 
                  endif; ?> 
                </div>  
                <div class="col-md-6 col-6 mb-2 information">
                <h5>الراحة</h5>
                  <?php
                  if( have_rows('specifications_comforts') ):
                    while( have_rows('specifications_comforts') ) : the_row();
                  ?>
                  <div>
                    <i class="fa <?= the_sub_field('icon_specifications'); ?> text-primary mr-2"></i>
                    <span><?= the_sub_field('text_specifications'); ?></span>
                    </div>
                  <?php 
                    endwhile; 
                  endif; ?> 
                </div> 
                <div class="col-md-6 col-6 mb-2 information">
                <h5>التقنيات</h5>
                  <?php
                  if( have_rows('specifications_technologies') ):
                    while( have_rows('specifications_technologies') ) : the_row();
                  ?>
                    <div>
                      <i class="fa <?= the_sub_field('icon_specifications'); ?> text-primary mr-2"></i>
                      <span><?= the_sub_field('text_specifications'); ?></span>
                    </div>
                  <?php 
                    endwhile; 
                  endif; ?> 
                </div> 
                <div class="col-md-6 col-6 mb-2 information">
                <h5>تجهيزات خارجية</h5>
                  <?php
                  if( have_rows('specifications_external_equipment') ):
                    while( have_rows('specifications_external_equipment') ) : the_row();
                  ?>
                  <div>
                    <i class="fa <?= the_sub_field('icon_specifications'); ?> text-primary mr-2"></i>
                    <span><?= the_sub_field('text_specifications'); ?></span>
                    </div>
                  <?php 
                    endwhile; 
                  endif; ?> 
                </div> 
              </div>

              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">بيانات السيارة</a></li>
                            <?php if($installment == 'installment'): ?>
              <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">اقساط</a></li>
              <li role="presentation" class=""><a href="#calculator" aria-controls="calculator" role="tab" data-toggle="tab">حاسبة الاقساط</a></li>
            <?php endif; ?>
              </ul>

              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                  <h4 class="mb-2">السعر شامل الضريبة: <?= $car_price; ?> <?= get_field('currency_pricing', 'option'); ?></h4>
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
                    <p><span>مدة القسط</span>  <span>60</span> شهر</p>
                    <p><span>الدفعة الأولى</span> <span class="the-first-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                    <p><span>القسط</span> <span class="the-finance-month"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                    <p><span>الدفعة الأخيرة</span> <span class="the-last-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>                             
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
                    <p><span>مدة القسط</span>  <span>60</span> شهر</p>
                    <p><span>الدفعة الأولى</span> <span class="the-first-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                    <p><span>القسط</span> <span class="the-finance-month"></span> <?= get_field('currency_pricing', 'option'); ?></p>
                    <p><span>الدفعة الأخيرة</span> <span class="the-last-batch"></span> <?= get_field('currency_pricing', 'option'); ?></p>
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
                                
              </div>
            </div>

            <div class="col-lg-4 mb-4 order-2 col-12" style="padding: 10px 10px 10px;margin-top: 140px;background: #f8f8f8;">
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

              <div class="content-car" style="margin-bottom:15px;display:inline-block;width:100%;">
                <h4 style="text-align: right;"><strong>مواصفات السيارة</strong></h4>
                    <ul>
                      <li><span>اللون:</span> <?= get_field('color_car', $car_id); ?></li>
                      <?php if(get_field('number_car', $car_id)): ?>
                        <li><span>رقم اللوحــة:</span> <?= get_field('number_car', $car_id); ?></li>
                      <?php endif; ?>
                      <?php if(get_field('km_car', $car_id)): ?>
                        <li><span>الممشى:</span> <?= get_field('km_car', $car_id); ?></li>
                      <?php endif; ?>
                      <li><span>العلامة التجارة</span> <?= $brands; ?></li>
                      <li><span>نوع الوقود </span> <?= $fuels; ?></li>
                      <li><span>نوع القير </span> <?= $gears; ?></li>
                      <li><span>نوع الدفع </span> <?= $pushs; ?></li>
                      <li><span>عدد الاسطوانات  </span> <?= $cylinders; ?></li>
                      <li><span>نوع المحرك </span> <?= $engines; ?></li>
                    </ul>
                <?= the_content(); ?>
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


        function financial(x) {
          return Number.parseFloat(x).toFixed(3);
        }

        function numberWithCommas(x) {
          var parts = x.toString().split(".");
          parts[0]=parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
          return parts.join(",");
        }

        $('#calculation').on('click', function () {
          var month = $('#month').find(":selected").val();
          if(month === '0') {
            month = 60
          }
          var year = month / 12;

          var price = <?= $car_price; ?>;  //السعر النقدي للسيارة

          var first_batch = $('#price').val(); // الدفعة المقدمة
              first_batch = numberWithCommas(first_batch);

          var last_batch = price * 0.25; // الدفعة الأخيرة

          var Profit_Ratio = 4.85; // نسبة الربح
          var insurance_percentage = 3.9; // نسبة التأمين

          var price_before_tax = price * 100 / 115; //السعر قبل الضريبة 
          var profits = ((price_before_tax - first_batch - last_batch)*Profit_Ratio/100 * year) + ((price_before_tax - first_batch - last_batch)*Profit_Ratio/100 * year)*15/100; // الأرباح
          var insurance = (price - last_batch) * insurance_percentage/100*5; // التأمين

          var monthly_installment = (price - first_batch - last_batch  + profits + insurance) / month;  // القسط الشهري

          $('#first_batch span').html('يبدأ من ' + financial(first_batch));
          $('#monthly_installment span').html('يبدأ من ' + financial(monthly_installment));
          $('#last_batch span').html('يبدأ من ' + financial(last_batch));
          $('#month span').html('يبدأ من ' + month);
        });


        $( window ).load(function() {
          var price = <?= $car_price; ?>;  //السعر النقدي للسيارة
          var first_batch = price * 0.1; // الدفعة المقدمة
          var last_batch = price * 0.25; // الدفعة الأخيرة

          var Profit_Ratio = 4.85; // نسبة الربح
          var insurance_percentage = 3.9; // نسبة التأمين

          var price_before_tax = price * 100 / 115; //السعر قبل الضريبة 
          var profits = ((price_before_tax - first_batch - last_batch)*Profit_Ratio/100 *5) + ((price_before_tax - first_batch - last_batch)*Profit_Ratio/100 *5)*15/100; // الأرباح
          var insurance = (price - last_batch) * insurance_percentage/100*5; // التأمين

          var monthly_installment = (price - first_batch - last_batch  + profits + insurance) / 60;  // القسط الشهري

          $('.the-first-batch').html('يبدأ من ' + financial(first_batch));
          $('.the-finance-month').html('يبدأ من ' + financial(monthly_installment));
          $('.the-last-batch').html('يبدأ من ' + financial(last_batch));
        });

        
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
    .car-information .information > div {
      width: 100%;
      flex: 0 0 100%;
      padding: 10px;
    }
    .car-information .information {
        flex-flow: wrap;
        padding: 0;
        border: none;
    }
    .car-information .information i.fa {
        border: 1px solid #f67e07;
        padding: 8px;
        border-radius: 6px;
    }    
    .car-information {
        justify-content: stretch;
        flex-flow: wrap;
        margin-bottom: 70px;
        border-bottom: 1px solid #d97e00;
    }
    .car-information .information h5 {
        border-top: 1px solid #d97e00;
        width: 100%;
        padding: 10px;
        border-bottom: 1px solid #d97e00;
    }


    .car-information .information {
      align-items: baseline !important;
    }   
    
    .content-car ul li {
      border: 1px solid #f5941c;
      padding: 10px;
      margin-bottom: 1px;
    }

    .content-car ul li span {
      font-size: 14px;
      font-weight: bold;
      min-width: 110px;
      display: inline-block;
      border-left: 1px solid #d97e00;
      margin-left: 10px;
    }    
    </style>
  <?php
  endwhile;
  wp_reset_postdata();
endif;
get_footer();