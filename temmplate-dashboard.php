<?php
/* 
  Template Name: Dashboard
*/

get_header(); 

$users = get_users( array( 'role__in' => array( 'vendor' ) ) );
$paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;

$taxonomies = get_terms( array(
  'taxonomy' => 'basic-brand',
  'hide_empty' => false,
  'parent'   => 0
) );


$tags = get_terms( array(
  'taxonomy' => 'products-tag',
  'hide_empty' => false,
  'parent'   => 0
) );

$products_model = get_terms( array(
  'taxonomy' => 'products-model',
  'hide_empty' => false,
  'parent'   => 0
) );


global $current_user;
wp_get_current_user();

$args = array(
  'post_type'      => 'cars',
  'author' => $current_user->ID,
  'posts_per_page' => 18,
  'paged' => $paged,
);

$query = new WP_Query( $args );

$user_address = get_field('user_address', 'user_'. $current_user->ID);
$user_phone = get_field('user_phone', 'user_'. $current_user->ID);
$user_whatsapp = get_field('user_whatsapp', 'user_'. $current_user->ID);
$map = get_field('map_user', 'user_'. $current_user->ID);
$user_content = get_field('user_content', 'user_'. $current_user->ID);
$user_logo = get_field('user_logo', 'user_'. $current_user->ID);
$user_logo_Bg = get_field('user_background', 'user_'. $current_user->ID);
?>

<!-- Page Header Start -->
<div class="container-fluid page-header" style="background-image:url('<?= get_the_post_thumbnail_url(get_the_ID(),'full'); ?>');">
    <h1 class="display-3 text-uppercase text-white mb-3">لوحة التحكم</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">لوحة التحكم</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
    </div>
</div>
<!-- Page Header Start -->


<div class="container mt-5 pt-5 mb-5 pb-5">

<?php if ( is_user_logged_in() ): ?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">بيانات المعرض</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">اضافة سيارة</a></li>
    <li role="presentation"><a href="#mycars" aria-controls="mycars" role="tab" data-toggle="tab">سيارتي</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
      <div class="update-vendor row">

        <div class="col-lg-3 col-md-6 px-2 pull-right">
          <h6 class="is-require"> اسم المعرض  </h6>
          <input type="text" class="form-control custom-select px-4 mb-3" value="<?= the_author_meta( 'display_name', $current_user->ID ); ?>" style="height: 50px; width: 100%;"  id="user_name" placeholder="اسم المعرض">
        </div>
        <div class="col-lg-3 col-md-6 px-2 pull-right">
          <h6 class="is-require"> عنوان المعرض  </h6>
          <input type="text" class="form-control custom-select px-4 mb-3" value="<?= $user_address; ?>" style="height: 50px; width: 100%;"  id="user_address"  placeholder="عنوان المعرض">
        </div>
        <div class="col-lg-3 col-md-6 px-2 pull-right">
          <h6 class="is-require"> هاتف المعرض  </h6>
          <input type="text" class="form-control custom-select px-4 mb-3" value="<?= $user_phone; ?>" style="height: 50px; width: 100%;"  id="user_phone"  placeholder="هاتف المعرض">
        </div>
        <div class="col-lg-3 col-md-6 px-2 pull-right">
          <h6 class="is-require"> واتس المعرض  </h6>
          <input type="text" class="form-control custom-select px-4 mb-3" value="<?= $user_whatsapp; ?>" style="height: 50px; width: 100%;"  id="user_whats"  placeholder="واتس المعرض">
        </div>

        <div class="col-lg-6 col-md-6 px-2 pull-right">
          <h6 class="is-require"> خريطة المعرض   </h6>
          <textarea type="text" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;"  id="user_map" placeholder="خريطة المعرض"><?= $map; ?></textarea>
        </div>

        <div class="col-lg-6 col-md-6 px-2 pull-right">
          <h6 class="is-require"> المحتوي   </h6>
          <textarea type="text" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;"  id="user_content" placeholder="المحتوي"><?= $user_content; ?></textarea>
        </div>

        <div class="col-lg-6 col-md-6 px-2 pull-right uploads">
          <h6 class="is-require">صورة الشعار</h6>
          <form id="myform" class="form" method="post" action="" enctype="multipart/form-data">
            <label for="myfilefield"><img src="<?= $user_logo; ?>" alt="logo">  <span>لرفع الصورة اظغط هنا</span> </label>
            <input type="file" id="myfilefield" name="myfilefield" class="form-control hidden" value="">
            <input type="hidden" id="user_logo">
            <?php wp_nonce_field( 'myuploadnonce', 'mynonce' );?>
            <button type="submit" class="btn btn-primary">تغير الصورة</button>
          </form>
        </div>

        <div class="col-lg-6 col-md-6 px-2 pull-right uploads">
          <h6 class="is-require">صورة الخلفية</h6>
          <form id="myformBg" class="form" method="post" action="" enctype="multipart/form-data">
            <label for="myfilefieldBg"><img src="<?= $user_logo_Bg; ?>" alt="logo">  <span>لرفع الصورة اظغط هنا</span> </label>
            <input type="file" id="myfilefieldBg" name="myfilefieldBg" class="form-control hidden" value="">
            <input type="hidden" id="user_logo_Bg">
            <?php wp_nonce_field( 'myuploadnonce', 'mynonce' );?>
            <button type="submit" class="btn btn-primary">تغير الصورة</button>
          </form>
        </div>



        <div class="insert_car row" id="user-action">
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <button class="btn btn-submit" id="SubmitUser">للمراجعات</button>
          </div>
        </div>
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

    <div role="tabpanel" class="tab-pane" id="profile">

        <div class="row">
          <h2>اضافة السيارة</h2>
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="parent_brand" name="parent_brand_id">
              <option value="0">العلامة تجاريه</option>
              <?php 
                foreach ($taxonomies as $term): 
                  if( $term->parent == 0 ):
                ?>
                <option value="<?= $term->term_id; ?>"><?= $term->name; ?></option>
              <?php 
                  endif;
                endforeach; 
                ?>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="child_brand"  name="child_brand_id">
              <option value="0">الماركة</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="model"  name="model_id">
              <option value="0">الموديل</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="cars"  name="car_id">
              <option value="0">السيارة</option>
            </select>
          </div>
        </div>
        <div class="row disabled" id="basic_specifications">
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <h6 class="is-require">اختار قسم السيارة</h6>
            <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="car_tag" name="car_tag" require>
              <option value="0">القسم (جديد - مستعمل)</option>
              <?php 
                foreach ($tags as $tag): 
                ?>
                <option value="<?= $tag->term_id; ?>"><?= $tag->name; ?></option>
              <?php 
                endforeach; 
                ?>
            </select>
          </div>

          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <h6 class="is-require">اختار السنة </h6>
            <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="car_model" name="car_model">
              <option value="0">السنة</option>
              <?php 
                foreach ($products_model as $model): 
                ?>
                <option value="<?= $model->term_id; ?>"><?= $model->name; ?></option>
              <?php 
                endforeach; 
                ?>
            </select>
          </div>
          
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <h6>اختار ادخال الصور</h6>
            <select class="custom-select px-4 mb-3" style="height: 50px; width: 100%;" id="car_img" name="car_img">
              <option value="1">صور السيارة</option>
              <option value="1">صور خاصة</option>
            </select>
          </div>

          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <h6 class="is-require"> السعر قبل الضريبة</h6>
            <input type="text" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;"  id="car_price" name="car_price" placeholder="السعر">
          </div>
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <h6 class="is-require"> لون السيارة  </h6>
            <input type="text" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;"  id="car_color" name="car_color" placeholder="">
          </div>
          <div class="col-lg-3 col-md-6 px-2 pull-right used-car d-none">
            <h6 class="is-require">(الممشى (عدد الكيلوات</h6>
            <input type="text" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;"  id="car_km" name="car_km" placeholder="">
          </div>
          <div class="col-lg-3 col-md-6 px-2 pull-right used-car d-none">
            <h6 class="is-require">رقم اللوحــة</h6>
            <input type="text" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;"  id="car_number" name="car_number" placeholder="">
          </div>
        </div>


        <div class="row disabled" id="car_specifications">
        </div>

        <div class="insert_car row disabled" id="insert_car">
          <div class="col-lg-3 col-md-6 px-2 pull-right">
            <button class="btn btn-submit" id="submit">للمراجعات</button>
          </div>
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

    <div role="tabpanel" class="tab-pane" id="mycars">
      <div class="row">
        <?php
        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
            $link = get_the_permalink();
            ?>

            <div class="media">
              <div class="img">
                <img src="<?= $img_url; ?>" alt="">
              </div>
              <div class="content">
                <h4><a href="<?= $link; ?>"><?= the_title(); ?></a></h4>
                <p class="mb-2">السعر شامل الضريبة: <?= (get_field('price',get_the_ID() ))? get_field('price',get_the_ID() ) * 0.015 + get_field('price',get_the_ID() ):''; ?> <?= get_field('currency_pricing', 'option'); ?></p>
                <span> <strong>الوان</strong> <?= get_field('color_car',get_the_ID() ); ?></span>
              </div>
            </div>

          <?php
          endwhile;     
        else: 
        ?>
          <div class="alert alert-danger" role="alert">لا يوجد نتائج للبحث برجاء تغير حقول البحث</div>              
        <?php 
        endif; 
          wp_reset_postdata(); 
          ?>

        <div class="col-md-12 mt-5">
            <?php echo custom_author_pagination(array(), $query); ?>
        </div>
      </div>
    </div>

  </div>


  <?php else: ?>
    <?php 
    $login = array(
      'echo'            => true,
      'redirect'        => get_permalink( get_the_ID() ),
      'remember'        => true,
      'value_remember'  => true,
    );
    ?>

    <section class="gutter">
      <div class="port">
        <?php wp_login_form($login); ?>
      </div>
    </section>  
  <?php endif; ?>  
</div>


<script type="text/javascript" >
  jQuery(function ($) {

    // change parent brand
    $('#parent_brand').on('change', function () {
      var parent_id = $('#parent_brand').find(":selected").val();
      var action = 'ajax_basic_brand';
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
      });
    });

    // change child model
    $('#child_brand').on('change', function () {
      var parent_id = $('#child_brand').find(":selected").val();
      var action = 'ajax_child_basic_brand';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          parent_id: parent_id,
        },
        beforeSend: function () {
          $('#model').html("");
          $('.loading').show();
        },
        success: function (response) {          
          $('#model').append(response);
          $('.loading').hide();
        },
      });
    });

    // change child Cars
    $('#model').on('change', function () {
      var model_id = $('#model').find(":selected").val();
      var action = 'ajax_child_car';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          model_id: model_id,
        },
        beforeSend: function () {
          $('#cars').html("");
          $('.loading').show();
        },
        success: function (response) {          
          $('#cars').append(response);
          $('.loading').hide();
        },
      });
    });

    // get car spac
    $('#cars').on('change', function () {
      var car_id = $('#cars').find(":selected").val();
      var action = 'ajax_get_basic_specifications';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          car_id: car_id,
        },
        beforeSend: function () {
          $('#car_specifications').html("");
          $('#basic_specifications').removeClass('disabled');
          $('#car_specifications').removeClass('disabled');
          $('#insert_car').removeClass('disabled');
          $('.loading').show();
        },
        success: function (response) {          
          $('#car_specifications').append(response);
          $('.loading').hide();
        },
      });
    });

    // change child Cars
    $('body').on('change', '#car_tag', function() {
      var tag_id = $('#car_tag').find(":selected").val();
      if(tag_id != 17) {
        $('.used-car').removeClass('d-none');
      } else {
        $('.used-car').addClass('d-none');
      }
    });

    // get car add new car
    $('#submit').on('click', function () {
      var car_id = $('#cars').find(":selected").val();
      var car_tag = $('#car_tag').find(":selected").val();
      var car_model = $('#car_model').find(":selected").val();
      var car_price = $('#car_price').val();
      var car_color = $('#car_color').val();
      var car_name = $('#car_name').val();
      
      var car_km = $('#car_km').val();
      var car_number = $('#car_number').val();

      if(car_id == 0 || car_tag == 0 || car_model == 0 || car_price == '' || car_color == '' || car_name == '') {
        alert('الرجاء اكمل الحقول ');
        return false;
      }
      var action = 'get_add_new_car';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          car_id: car_id,
          car_tag: car_tag,
          car_model: car_model,
          car_price: car_price,
          car_color: car_color,
          car_name: car_name,
          car_km: car_km,
          car_number: car_number,
        },
        beforeSend: function () {
          $('#car_specifications').html("");
          $('.loading').show();
        },
        success: function (response) {          
          $('#car_specifications').append(response);
          $('.loading').hide();
        },
      });
    });

    // update user content

      
      var myForm = $('#myform');
      $(myForm).submit(function(e) {
        e.preventDefault();
        var myformData = new FormData(myForm[0]);
        myformData.append('action', 'pn_wp_frontend_ajax_upload');
        $.ajax({
            type: "POST",
            data: myformData,
            dataType: "json",
            url: "<?= admin_url( 'admin-ajax.php' ); ?>",
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            beforeSend: function () {
              $('.loading').show();
            },
            success: function(data, textStatus, jqXHR) {
              console.log( jqXHR );
              $('#user_logo').val(jqXHR.responseJSON);
              $('.loading').hide();
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                $('#user_logo').val(jqXHR.responseJSON);
            }
        });
      });

      var myformBg = $('#myformBg');
      $(myformBg).submit(function(e) {
        e.preventDefault();
        var myformBgData = new FormData(myformBg[0]);
        myformBgData.append('action', 'pn_wp_frontend_ajax_upload');
        $.ajax({
            type: "POST",
            data: myformBgData,
            dataType: "json",
            url: "<?= admin_url( 'admin-ajax.php' ); ?>",
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            beforeSend: function () {
              $('.loading').show();
            },
            success: function(data, textStatus, jqXHR) {
              console.log( jqXHR );
              $('#user_logo_Bg').val(jqXHR.responseJSON);
              $('.loading').hide();
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                $('#user_logo_Bg').val(jqXHR.responseJSON);
            }
        });
      });

          // update user content
    $('#SubmitUser').on('click', function () {
      var user_name     = $('#user_name').val();
      var user_address  = $('#user_address').val();
      var user_phone    = $('#user_phone').val();
      var user_whats    = $('#user_whats').val();
      var user_map      = $('#user_map').val();
      var user_content  = $('#user_content').val();
      var user_logo     = $('#user_logo').val();
      var user_background     = $('#user_logo_Bg').val();
      var action = 'get_update_user';
      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          user_name: user_name,
          user_address: user_address,
          user_phone: user_phone,
          user_whats: user_whats,
          user_map: user_map,
          user_content: user_content,
          user_logo:user_logo,
          user_background: user_background,
        },
        beforeSend: function () {
          $('.loading').show();
        },
        success: function (response) {          
          location.reload();
          $('.loading').hide();
        },
      });
    });

  });
</script>

<style>
  .row.disabled {
    opacity: .5;
    pointer-events: none;
    cursor: not-allowed;
  }
  .images {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
  }
  .images img {
    max-width: 100%;
  }
  .images div {
    border: 1px solid #000;
    margin: 5px;
  }  
  h6 span {
    font-size: 9px;
    color: green;
  }  
  .d-none {
    display: none;
  }
  section#set_specifications .col-lg-3 > div {
    padding: 10px 5px;
    border: 1px solid #ccc;
    margin: 10px 0;
  }
  section#set_specifications .col-lg-3 {
    padding: 5px;
  }  
  section#set_specifications p {
    font-size: 20px;
  }  
  section#set_specifications p {
    font-size: 20px;
  }
  div#car_specifications {
    padding: 30px;
    background: #f8f8f8;
    margin: 5px;
    border: 1px solid #ccc;
    border-radius: 10px;
  }
  section#set_specifications .col-lg-4.col-md-12.px-2 h3 {
      font-size: 14px;
      border-bottom: 1px solid #d6d6d6;
      background: #bcbcbc91;
      padding: 8px;
      margin-bottom: 0;
  }
  section#set_specifications .col-lg-4.col-md-12.px-2 p {
      border-bottom: 1px solid #d6d6d6;
      padding: 10px;
      border-right: 1px solid #d6d6d6;
      border-left: 1px solid #d6d6d6;
  }
  section#set_specifications h6 {
      font-size: 26px;
  }  
  h6.is-require:after,
  label.is-require:after {
    content: "*";
    color: red;
    font-size: 15px;
    float: right;
    margin-left: 4px;
  }
  div.insert_car .btn {
    margin-top: 100px;
    background: #d97e00;
    color: #fff;
    padding: 10px 30px;
    font-size: 22px;
    border-radius: 4px;
  }  
  div#mycars .media {
    display: flex;
    flex-wrap: nowrap;
    align-content: space-around;
    align-items: center;
  }
  div#mycars .media .img img {
      max-width: 100%;
  }
  div#mycars .media .img {
      max-width: 120px;
      min-width: 120px;
      border: 1px solid #ccc;
      min-height: 120px;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      margin: 0 10px;
  }
  div#mycars .media h4 {
      font-size: 20px;
      margin: 0;
  }  
  form#loginform {
    margin: auto;
    display: block;
  }

  @media only screen and (max-width: 769px) {
    .update-vendor .col-lg-3, .update-vendor .col-lg-6, .update-vendor .col-lg-4 {
        width: 100%;
    }

    div#profile .col-lg-3, div#profile .col-lg-6, div#profile .col-lg-4 {
        width: 100%;
    }

    div#car_specifications {
        padding: 30px 0;
    }
  }
  .uploads label span {
      display: block;
      font-size: 12px;
      text-align: center;
  }

  .uploads img {
      max-width: 100%;
  }
</style>
<?php 
  get_footer();
?>