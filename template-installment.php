<?php
/* 
  Template Name: Installment Account
*/

get_header(); 
?>

<!-- Page Header Start -->
<div class="container-fluid page-header" style="background-image: url('<?= $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>');">
    <h1 class="display-3 text-uppercase text-white mb-3"><?= the_title(); ?></h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
    </div>
</div>
<!-- Page Header Start -->

<section class="contsct-us-info with-sidebar-right mt-5 mb-5">
  <div class="container-fluid">
    <div class="row">
      
      <div class="col-md-3 col-12 pt-2 order-2">
        <div class="ads-finance">
          <a href="<?= the_field('ads_link_real', 'option'); ?>"><img src="<?= the_field('ads_images_real', 'option'); ?>" alt="ads"></a>
        </div>
      </div>

      <div class="col-md-6 col-xs-12 mb-5 order-3">
        <div  class="content">
          <h1 class="text-uppercase text-body m-0"><?= the_title(); ?></h1>
          <?= the_content(); ?>
        </div>

        <div class="installment-account">
          <div class="group-input">
            <div class="d-flex">
              <input type="number" id="price">
              <button id="calculation">حساب القسط</button>
            </div>
            <div class="response">
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

      <?php get_sidebar('right'); ?>


    </div>
  </div>
</section>

<script type="text/javascript" >
  jQuery(function ($) {
    $('#calculation').on('click', function () {
      var price = $('#price').val();

      var first_batch = price * 0.1;
      $('#first_batch span').html(first_batch);


      var last_batch = price * 0.25
      $('#last_batch span').html(last_batch);

      var batch = price - first_batch;
      var cost = batch * 7.52 / 100;
      var total = cost + batch;

      var monthly_installment = total / 60;
      $('#monthly_installment span').html(monthly_installment);

      console.log(batch, cost, total);
    });
  });
</script>

<?php
get_footer();
?>
