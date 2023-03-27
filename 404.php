<?php
/** 
 * File not found or web page not found template file.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();

/* @var $wp_widget_factory \WP_Widget_Factory */
global $wp_widget_factory;
?>
<main id="main" class="col-12 site-main" role="main">
  <section class="error-404 not-found">
    <header class="page-header">
      <h1 class="page-title"><?php _e('Oops! - لا يمكن العثور على هذه الصفحة.', 'bootstrap-basic4'); ?></h1>
    </header><!-- .page-header -->
    <div class="page-content">
      <div class="container">
        <div class="row" style="min-height:500px;">
          <p class="text-center">
            <?php _e('يبدو أنه لم يتم العثور على أي شيء في هذا الموقع. ربما جرب أحد الروابط أدناه أو ابحث؟', 'bootstrap-basic4'); ?>
          </p>
        </div><!-- .page-content -->
      </div><!-- .page-content -->
    </div><!-- .page-content -->
  </section><!-- .error-404 -->
</main>
<?php
get_footer();
