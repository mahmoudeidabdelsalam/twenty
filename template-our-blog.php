<?php
/* Template Name: our Blog */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#about-page
 *
*/

get_header(); 

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$args = array(
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'posts_per_page' => 12,
  'paged' => $paged
);
$posts = get_posts( $args );
$query = new WP_Query( $args );
?>

  <!-- Page Header Start -->
  <div class="container-fluid page-header" style="background-image:url('<?= get_the_post_thumbnail_url(get_the_ID(),'full'); ?>');">
      <h1 class="display-3 text-uppercase text-white mb-3">السيارات</h1>
      <div class="d-inline-flex text-white">
          <h6 class="text-uppercase m-0"><a class="text-white" href="">الرئيسية</a></h6>
          <h6 class="text-body m-0 px-3">/</h6>
          <h6 class="text-uppercase text-body m-0"><?= the_title(); ?></h6>
      </div>
  </div>
  <!-- Page Header Start -->


<section class="posts" style="margin-bottom:40px">
  <div class="container">
    <div class="row">
      <?php 
      if ( $posts ):
        foreach ( $posts as $post ):
          $img_url = get_the_post_thumbnail_url($post->ID,'full');
          $author_id = $post->post_author;
          ?>
          <div class="col-md-4 col-12" style="margin-bottom: 20px;">
            <div class="box-post">
              <img src="<?= $img_url; ?>" alt="<?= get_the_title($post->ID); ?>">
              <div class="infromtion">
                <time datetime="<?php echo get_the_date('c', $post->ID); ?>" itemprop="datePublished"><?php echo get_the_date('M d, Y', $post->ID); ?></time>
              </div>
              <h2><a href="<?= get_the_permalink($post->ID); ?>"><?= get_the_title($post->ID); ?></a></h2>
            </div>
          </div>
          <?php
        endforeach;
      endif;
      ?>
    </div>
  </div>
  <div class="container">
    <?php echo custom_base_pagination(array(), $query); ?>
  </div>
</section>

<?php
get_footer();
?>
