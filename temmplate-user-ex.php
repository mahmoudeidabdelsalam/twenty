<?php
/* 
  Template Name: Users export
*/

get_header(); 

$users = get_users( array( 'role__in' => array( 'vendor' ) ) );
?>


<div class="container">
  <div class="table-responsive" style="margin-top:150px; text-align:right">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align: right;">#</th>
          <th style="text-align: right;">الاسم</th>
          <th style="text-align: right;">اسم الدخول</th>
          <th style="text-align: right;">الباسورد</th>
          <th style="text-align: right;">الهاتف</th>
          <th style="text-align: right;">الواتس</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $number=0;
          foreach($users as $user):
            $number++;
            $user_phone     = get_field('user_phone', 'user_'. $user->ID);
            $user_whatsapp  = get_field('user_whatsapp', 'user_'. $user->ID);
            $user_name      = $user->user_login;
            wp_set_password( $user_name, $user->ID );
        ?>
          <tr>
            <td><?= $number; ?></td>
            <td><?= $user->display_name; ?></td>
            <td><?= $user_name; ?></td>
            <td style="direction: ltr;"><?= $user_name; ?></td>
            <td><?= $user_phone; ?></td>
            <td><?= $user_whatsapp; ?></td>
          </tr>
        <?php
          endforeach;
        ?> 
      </tbody>
    </table>
  </div>
</div>


<?php
get_footer();
?>
