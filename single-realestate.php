<?php
get_header();
if (have_posts()) {
  while (have_posts()) {
    the_post();
    
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    $images = get_field('galleries');
    $counter = get_post_meta( get_the_ID(), 'link_click_counter', true );
?> 

  <div class="container-fluid page-header" style="background-image:url('<?= $featured_img_url; ?>');">
    <h1 class="display-3 text-uppercase text-white mb-3"><?= the_title(); ?></h1>
    <div class="d-inline-flex text-white">
      <h6 class="text-uppercase m-0"><a class="text-white" href="<?php echo esc_url(home_url('/')); ?>">الرئيسية</a></h6>
      <h6 class="text-body m-0 px-3">/</h6>
      <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
    </div>
  </div>
  
  <div class="container">
    <div class="row align-items-center pb-2">
      <div class="col-lg-8 mb-4">
          <?php if($images): ?>
            <div class="content-carousel">
              <div class="owl-carousel owl-interior">
                <?php foreach( $images as $image ): ?>
                  <div><img src="<?= $image; ?>" alt="slide"></div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
      </div>
      <div class="col-lg-4 col-xs-12 mb-4 informations">
        <h3 class="display-4 text-uppercase">بيانات التواصل</h3>  
        <ul class="contact-information informations-user">
          <li><b>الهاتف</b> <?= the_field('contact_information_phone'); ?></li>
          <li><b>البريد الالكتروني</b> <?= the_field('contact_information_email'); ?></li>
          <a id="countable_link" href="javascript:void(0)">للتواصل اضغط هنا. <i class="fa fa-eye-slash" aria-hidden="true"></i></a>
        </ul>
        <div id="counter"><?= $counter; ?> <i class="fa fa-eye" aria-hidden="true"></i></div>

        <h3 class="display-4 text-uppercase mt-5">البيانات</h3>  
        <ul class="contact-information informations-area">
          <li><b>المساحة</b> <?= the_field('space_area'); ?></li>
          <li><b>السعر</b> <?= the_field('price'); ?></li>
          <?php
          if( have_rows('division_property') ):
            while( have_rows('division_property') ) : the_row();
            ?>
              <li><b><?= the_sub_field('the_name'); ?></b> <?= the_sub_field('the_number'); ?></li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul> 
      </div>
    </div>
  </div>



  <div class="container mb-4">
    <div class="the-content">
      <?= the_content(); ?>
      <?= the_field('map_area'); ?>
    </div>
  </div>

  <div class="container-fluid pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <?php 
            $form_id = get_field('id_form_realestate', 'option');
            if($form_id):
          ?>
            <?=  do_shortcode( '[gravityform id="'.$form_id.'" title="false" description="false" ajax="true"]' ); ?>
          <?php endif; ?>
        </div>
        <div class="col-lg-4 border-left bg-light">
          <h2 class="mb-4">تفاصيل</h2>
          <div class="row mt-n3 mt-lg-0 pb-4 car-information">
            <?php
            if( have_rows('additional_details') ):
              while( have_rows('additional_details') ) : the_row();
            ?>
              <div class="col-md-12 col-12 mb-2 information">
                <b><?= the_sub_field('the_name'); ?></b>
                <span><?= the_sub_field('the_number'); ?></span>
              </div>
              <?php endwhile; ?>
            <?php endif; ?>             
          </div>
        </div>
      </div>
    </div>
  </div>

    <script type="text/javascript" >
      jQuery(function ($) {
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
              $('#counter').html(response + '<i class="fa fa-eye" aria-hidden="true"></i>');
              $('#countable_link').hide();
            },
          });
        });
      });
    </script>

<?php
 }
}
get_footer();