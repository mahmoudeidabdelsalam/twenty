<?php
/* 
  Template Name: Tracking
*/

get_header(); 

$second_id = isset($_GET['second_id']) ? $_GET['second_id'] : '';
?>

<!-- Page Header Start -->
<div class="container-fluid page-header-tags">
  <img src="<?= $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="banner">
</div>
<!-- Page Header Start -->

<section class="contsct-us-info mt-5 mb-5">
  <div class="container">
    <div class="row">
      <?php if(get_the_content()): ?>
        <div class="col-xs-12 text-center mb-5">
          <div  class="content">
            <?= the_content(); ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="col-md-12 col-12" id="Tracking">
        <form class="form-inline" action="" method="get">
          <div class="form-group">
            <select class="form-control">
              <option>تمويل الافراد</option>
              <option>تمويل السيارات</option>
              <option>تمويل الشركات</option>
            </select>
            <input type="number" name="second_id" class="form-control" placeholder="123">
          </div>
          <button type="submit" class="btn btn-default">تتبع</button>
        </form>

        <?php 
          $entry = GFAPI::get_entry( $second_id );
          if( $second_id && !is_wp_error($entry)):
        ?>
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">رقم الطلب</th>
            <th scope="col">حالة الطلب</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><?= $second_id; ?></th>
              <td><?= ($entry['approval_status'] == 'pending')? 'في الإنتظار' : 'موافق عليه' ;?></td>
            </tr>
          </tbody>
        </table>
        <?php else: ?>
            <p style="text-align: center;font-size: 18px;margin: 30px 0;">لا يوجد طلب لهذا الرقم</p>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<style>
  div#Tracking form {
      display: flex;
      justify-content: center;
      align-items: center;
  }

  div#Tracking form button {
      background: #f6941c;
      border: 1px solid #333;
      border-radius: 0;
      margin-right: 10px;
      padding: 15px;
      width: 100px;
  }

  div#Tracking form input {
      padding: 15px;
      height: auto;
      border-radius: 0;
      border: 1px solid #333;
  }

  div#Tracking form input[name="first_id"] {
      max-width: 50px;
      text-align: center;
  }

  div#Tracking {
      min-height: 500px;
  }

  table.table {
      text-align: right;
      padding: 10px;
      background: #1778be;
      margin-top: 20px;
  }

  th {
      text-align: right;
  }

  table.table th, table.table td {
      font-size: 18px;
      padding: 15px !important;
  }

  table.table th[scope="col"] {
      color: #fff;
  }  

  div#Tracking select.form-control {
    padding: 11px;
    height: auto;
    border-radius: 0;
    border: 1px solid #333;
  }
</style>
<?php
get_footer();
?>
