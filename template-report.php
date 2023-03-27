<?php
/* 
  Template Name: reports
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
          <a href="<?php echo esc_url(home_url('/')); ?>"
            title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
            <img class="img-fluid" src="<?=get_theme_file_uri().'/assets/img/logo.png' ?>"
              alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
            <span class="sr-only"> <?=get_bloginfo('name') ?> </span>
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>
<!--/header-->
<?php if(current_user_can('administrator')): ?>
<!-- Page Header Start -->
<div class="container-fluid page-header" style="background-image: url('<?= $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>'); height:200px">
    <h1 class="display-3 text-uppercase text-white mb-3"><?= the_title(); ?></h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
    </div>
</div>
<!-- Page Header Start -->

<section class="contsct-us-info mt-5 mb-5">
  <div class="container">
    <div class="row">
      <?php 
        $forms = GFAPI::get_forms();
        $users = get_users( array( 'role__in' => array( 'delegate', 'administrator' ) ) );
        $user_id    = isset($_GET['users']) ? $_GET['users'] : '0';

        foreach ($forms as $form) {
          $entries = GFAPI::get_entries( $form['id'] );

          if($user_id) {

            // get entries by id user
            $counter = 0;
            foreach ($entries as $entry) {
              if($entry['approval_status'] == 'approved' && $entry['created_by'] == $user_id) {
                $counter++;
                $approved +=  $counter;
              }
            }
  
            $count_pending = 0;
            foreach ($entries as $entry) {
              if($entry['approval_status'] == 'pending' && $entry['created_by'] == $user_id || $entry['approval_status'] == '' && $entry['created_by'] == $user_id) {
                $count_pending++;
                $pending +=  $count_pending;
              }
            }
  
            $count_rejected = 0;
            foreach ($entries as $entry) {
              if($entry['approval_status'] == 'rejected' && $entry['created_by'] == $user_id) {
                $count_rejected++;
                $rejected +=  $count_rejected;
              }
            }

          } else {
            
            // get entries all
            $counter = 0;
            foreach ($entries as $entry) {
              if($entry['approval_status'] == 'approved') {
                $counter++;
                $approved +=  $counter;
              }
            }
  
            $count_pending = 0;
            foreach ($entries as $entry) {
              if($entry['approval_status'] == 'pending' || $entry['approval_status'] == '') {
                $count_pending++;
                $pending +=  $count_pending;
              }
            }
  
            $count_rejected = 0;
            foreach ($entries as $entry) {
              if($entry['approval_status'] == 'rejected') {
                $count_rejected++;
                $rejected +=  $count_rejected;
              }
            }

          }
         
        }      
      ?>

      <div class="filter">
        <form action="">
          <select name="users" id="user">
            <?php 
              foreach ($users as $user) {
              ?>
                <option value="<?= $user->ID; ?>" <?= ($user_id == $user->ID)? 'selected':''; ?>><?= $user->display_name; ?></option>
              <?php
              }
            ?>
          </select>
          <button class="transfer" type="submit">حسب المندوب</button>
        </form>
      </div>


      <div class="reports">
        <div class="row">
          <div class="col-md-3 col-12 mb-3">
            <div class="box-report">
              <span>المعاملات الكلي</span>
              <?= $approved + $pending + $rejected; ?>
            </div>
          </div>

          <div class="col-md-3 col-12 mb-3">
            <div class="box-report">
              <span>المعاملات المنجزه</span>
              <?= ($approved)? $approved:'0'; ?>
            </div>
          </div>

          <div class="col-md-3 col-12 mb-3">
            <div class="box-report">
              <span>المعاملات الملغاه</span>
              <?= ($rejected)? $rejected:'0'; ?>
            </div>
          </div>

          <div class="col-md-3 col-12">
            <div class="box-report">
              <span>المعاملات المعلقه</span>
              <?= ($pending)? $pending:'0'; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php else: ?>
  <section class="contsct-us-info mt-5 mb-5" style="height: 100vh; display: flex; align-items: center; width: 100%; text-align: center; font-size: 30px;">
    <div class="container">
      <div class="row">
        admin only try <a href="/wp-admin">login</a>
      </div>
    </div>
  </section>
<?php endif; ?>

<style>
  select#user {
      min-width: 300px;
      height: 50px;
  }

  button.transfer {
      height: 50px;
      background-color: #f6941c;
      border: 1px solid #000;
  }

  .box-report {
      width: 230px;
      height: 230px;
      border: 1px solid #ddd;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-flow: column;
      font-size: 25px;
      margin: auto;
      position: relative;
      border-radius: 100%;
      overflow: hidden;
  }

  .box-report:after {
    content: "\f200";
    font-family: "FontAwesome";
    position: absolute;
    left: -3%;
    top: 60%;
    font-size: 120px;
    opacity: .2;
  }

  .box-report span {
    display: inline-block;
    margin-bottom: 10px;
    font-size: 15px;
  }
</style>
<?php
get_footer();
?>
