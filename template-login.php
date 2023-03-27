<?php
/* 
  Template Name: car tester
*/
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <!--WordPress head-->
  <?php wp_head(); ?>
  <!--end WordPress head-->
</head>

<body <?php body_class(); ?>>
<header id="header">
  <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">
    <div class="container">
      <div class="navbar-header pull-none">
        <div class="logoSection">
        <?php 
            if(get_field('logo', 'option')): 
            $image = get_field('logo', 'option');
            ?>
            <div class="logoSection">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                  title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                  <img class="img-fluid" src="<?= $image['url']; ?>"
                    alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
                  <span class="sr-only"> <?=get_bloginfo('name') ?> </span>
                </a>
            </div>
           <?php else: ?>
          <div class="logoSection">
            <a href="<?php echo esc_url(home_url('/')); ?>"
              title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
              <img class="img-fluid" src="<?=get_theme_file_uri().'/assets/img/logo.png' ?>"
                alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
              <span class="sr-only"> <?=get_bloginfo('name') ?> </span>
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>

<?php if ( is_user_logged_in() ): ?>
  <section class="contsct-us-info mt-5 mb-5" style="height: 70vh; display: flex; align-items: center; width: 100%; text-align: center; font-size: 30px;">
    <div class="container">
      <div class="row">
        <a class="btn btn-checking" href="/wp-admin/edit.php?post_type=checking">اضافة فحص جديد</a>
      </div>
    </div>
  </section>
<?php else: ?>
  <?php 
   $args = array(
    'echo'            => true,
    'redirect'        => "/wp-admin/edit.php?post_type=checking",
    'remember'        => true,
    'value_remember'  => true,
  );
  ?>
  <section class="contsct-us-info mt-5 mb-5" style="height: 70vh; display: flex; align-items: center; width: 100%; text-align: center; font-size: 30px;">
    <div class="container">
      <div class="row">
        <?php wp_login_form($args); ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<style>
 .btn-checking {
    font-size: 22px;
    background: #f6941c;
    color: #333;
    padding: 15px;
  }
</style>
<?php
get_footer();
?>
