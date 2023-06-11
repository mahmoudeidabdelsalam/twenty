<?php
/* 
  Template Name: Users export
*/

get_header(); 

// $users = get_users( array( 'role__in' => array( 'vendor' ) ) );
$args_new = array (
  'role' => 'vendor',
  'meta_query' => array(
    'relation' => 'OR',
    array(
        'key'     => 'vendor_cars_status',
        'value'   => "new",
        'compare' => 'LIKE'
    ),
    array(
      'key' => 'vendor_cars_status',
      'compare' => 'NOT EXISTS',
    ),
  )
);

// Create the WP_User_Query object
$wp_user_query_new = new WP_User_Query($args_new);

// Get the results
$users_new = $wp_user_query_new->get_results();



// WP_User_Query arguments
$args = array (
  'role' => 'vendor',
  'order' => 'ASC',
  'orderby' => 'display_name',
  'meta_query' => array(
    array(
        'key'     => 'vendor_cars_status',
        'value'   => "used",
        'compare' => 'LIKE'
    ),
  )
);

// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);
// Get the results
$users_used = $wp_user_query->get_results();
?>


<div class="container">
  <div class="table-responsive" style="margin-top:150px; text-align:right">
    <h3>معارض السيارات الجديدة</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align: right;">#</th>
          <th style="text-align: right;">الاسم</th>
          <th style="text-align: right;">الهاتف</th>
          <th style="text-align: right;">الواتس</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $number=0;
          foreach($users_new as $user):
            $number++;
            $user_phone     = get_field('user_phone', 'user_'. $user->ID);
            $user_whatsapp  = get_field('user_whatsapp', 'user_'. $user->ID);
            $user_name      = $user->user_login;
        ?>
          <tr>
            <td><?= $number; ?></td>
            <td><?= $user->display_name; ?></td>
            <td><?= $user_phone; ?></td>
            <td><?= $user_whatsapp; ?></td>
          </tr>
        <?php
          endforeach;
        ?> 
      </tbody>
    </table>
  </div>

  <div class="table-responsive" style="margin-top:150px; text-align:right">
    <h3>معارض السيارات المستعملة</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align: right;">#</th>
          <th style="text-align: right;">الاسم</th>
          <th style="text-align: right;">الهاتف</th>
          <th style="text-align: right;">الواتس</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $number=0;
          foreach($users_used as $user):
            $number++;
            $user_phone     = get_field('user_phone', 'user_'. $user->ID);
            $user_whatsapp  = get_field('user_whatsapp', 'user_'. $user->ID);
            $user_name      = $user->user_login;
        ?>
          <tr>
            <td><?= $number; ?></td>
            <td><?= $user->display_name; ?></td>
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
