<?php
/* 
  Template Name: Entry Users
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
<?php if(current_user_can('administrator') || current_user_can('delegate')): ?>
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
      <div>
        <?php
          $forms = GFAPI::get_forms();
          $users = get_users( array( 'role__in' => array( 'delegate', 'administrator' ) ) );
          global $current_user;
          wp_get_current_user();
        ?>
        <ul class="nav nav-tabs" role="tablist">
          <?php 
            $counter = 0;
            foreach ($forms as $form):
              $counter++;
          ?>
            <li role="presentation" class="<?= ($counter == 1)? 'active':''; ?>"><a href="#home-<?= $counter; ?>" aria-controls="home-<?= $counter; ?>" role="tab" data-toggle="tab"><?= $form['title']; ?></a></li>
          <?php 
            endforeach;
          ?>
        </ul>
        <div class="tab-content">
          <?php 
            $count = 0;
            foreach ($forms as $form):
              $count++;
              $entry = GFAPI::get_entries($form["id"]);
          ?>
          <div role="tabpanel" class="tab-pane <?= ($count == 1)? 'active':''; ?>" id="home-<?= $count; ?>">
            <?php if($entry): ?>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <?php
                        $numbers = ["1", "2", "3", "4", "5", "6"];
                        foreach ($numbers as $number) {
                          echo "<th>".$number."</th>";
                        }
                      ?>
                      <th>حالة</th>
                      <th>عرض</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $numbers = ["1", "2", "3", "4", "5", "6"];
                      foreach ($entry as $variable) {
                        if($variable["approval_status"] == "approved") {
                          $class = "success";
                        } elseif($variable["approval_status"] == "rejected") {
                          $class = "warning";
                        } else {
                          $class = "info";
                        }
                        if($current_user->ID == $variable['created_by']) {
                      ?>
                      <tr class="<?= $class; ?>">
                        <?php
                          foreach ($numbers as $number) {
                            if($variable[$number]) {
                              echo "<td>".$variable[$number]."</td>";
                            } else {
                              echo "<td>#</td>";
                            }
                          }
                        ?>
                        <td>
                          <select name="status" id="status-<?= $variable["form_id"]; ?>-<?= $variable["id"]; ?>">
                            <option value="pending" <?= ($variable["approval_status"]== 'pending')? 'selected':'' ?>>انتظار</option>
                            <option value="approved" <?= ($variable["approval_status"]== 'approved')? 'selected':'' ?>>موافق عليه</option>
                            <option value="rejected" <?= ($variable["approval_status"]== 'rejected')? 'selected':'' ?>>مرفوض</option>
                          </select>
                          <button class="transfer" data-id="<?= $variable["id"]; ?>" data-status="#status-<?= $variable["form_id"]; ?>-<?= $variable["id"]; ?>">تحويل</button>
                        </td>
                        <td><a href="/wp-admin/admin.php?page=gf_entries&view=entry&id=<?= $variable["form_id"]; ?>&lid=<?= $variable["id"]; ?>" target="_blank">عرض</a></td>
                      </tr>
                        <?php
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <p>لا يوجد معاملات</p>
            <?php endif; ?>
          </div>
          <?php 
            endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript" >
  jQuery(function ($) {
    $('.transfer').on('click', function () {
      var id = $(this).data("id");
      var select = $(this).data("status");
      var status = $(select).find(":selected").val();

      var action = "entry_actions";

      $.ajax({
        url: "<?= admin_url( 'admin-ajax.php' ); ?>",
        type: 'post',
        data: {
          action: action,
          status: status,
          entry_id: id,
        },
        beforeSend: function () {
        },
        success: function (response) {
          $.notify({
            // options
            title: '<strong>نجاح</strong>',
            message: "<br><em><strong>تم تغير المعاملة </strong></em>",
            icon: 'glyphicon glyphicon-ok',
            url: '',
            target: '_blank'
          },{
            // settings
            element: 'body',
            //position: null,
            type: "success",
            //allow_dismiss: true,
            //newest_on_top: false,
            showProgressbar: false,
            placement: {
              from: "bottom",
              align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 3300,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
              enter: 'animated fadeInDown',
              exit: 'animated fadeOutRight'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
          });
        },
      });
    });
  });
</script>


<?php else: ?>
  <section class="contsct-us-info mt-5 mb-5" style="height: 70vh; display: flex; align-items: center; width: 100%; text-align: center; font-size: 30px;">
    <div class="container">
      <div class="row">
        <?php wp_login_form(); ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<style>
  .table thead tr th {
    text-align: right;
  }

  .table tbody tr td select {
    min-width: 200px;
    border-radius: 0 !important;
    border: 1px solid #f5941c;
  }

  .table tbody tr td button {
    background: #f6941c;
    border: none;
    padding: 5px 10px;
  } 
  
  .tab-content {
    min-height: 600px;
  } 
   
  @media screen and (max-width: 769px) {
    .nav-tabs li, .nav-tabs li a {
      width: 100%;
      border: 1px solid #eee;
    } 
  }
</style>
<?php
get_footer();
?>
