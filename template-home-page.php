<?php
/* Template Name: Home Page */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#hom-page
 *
*/

get_header(); 

$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
// $terms = get_terms( array(
//   'taxonomy' => 'products-brand',
//   'parent' => 0,
//   array('number' => 4)
// ) );

$terms = get_terms('products-brand', array('parent' => 0, 'number' => 9));
$term_page_link = get_field('term_page_link', 'option');
?>

<section id="main-slider">
  <div class="container">
    <div class="owl-carousel">
      <?php
      $counter = 0;
      if( have_rows('slider_home') ):
        while( have_rows('slider_home') ) : the_row();
        $counter++;
      ?>
      <div class="item">
        <div class="slider-inner">
          <img src="<?= get_sub_field('image_slider'); ?>" alt="slide">
          <div class="carousel-caption">
            <div class="carousel-content">
              <?= get_sub_field('content_slider'); ?>
              <?php 
              $link = get_sub_field('page_slider');
              if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self'; 
              ?>
              <p><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
  </div>
</section>

<?php 
  $args = array(
    'post_type'      => array( 'cars', 'products' ),
    'posts_per_page' => 6,
    'meta_query' => array(
      array(
        'key'     => 'offers',
        'value' => '1',
      ),
    )
  );
  
  $query = new WP_Query( $args );
  if ( $query->have_posts() ):
    $link = get_field('page_installment', 'option');
  ?>

  <section class="section-cars mt-5">
      <div class="cars-listing">
        <div class="container">
          <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown animated">عروض السيارات</h2>
          </div>
          <div class="row">
          <?php
              while ( $query->have_posts() ):
                $query->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
                $author_id = get_the_author_ID();
                $avatar = get_field('user_logo', 'user_'. $author_id);
                $image_offer = get_field('image_offer');
                ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
              <div class="car-box car-offer">
                <div class="offer-block">عرض خاص</div>
                <div class="car-box-img">
                  <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($image_offer)? $image_offer:$img_url; ?>" alt="<?= get_the_title(); ?>"></a>
                </div>
                <div class="overlay">
                <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
                  <div class="information">
                    <p class="pricing">
                      <span class="price"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                      <span class="new-price"><?= the_field('price_offer'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                    </p>
                    <p>
                      <span class="author">
                        <span><?= the_author_meta( 'display_name', $author_id ); ?></span>
                        <a class="logo-author" href="<?php echo get_author_posts_url($author_id); ?>"><img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php
              endwhile; 
            ?>      
            <?php wp_reset_postdata(); ?>
          </div>
          <div class="link"><a class="btn btn-primary" href="<?= $link; ?>">شاهد جميع السيارات</a></div> 
        </div>
      </div>
  </section>
<?php endif; ?>

<section id="brands" class="mt-5">
  <div class="section-header">
    <h2 class="section-title text-center wow fadeInDown animated">اهم العلامات التجاريه</h2>
  </div>
  <div class="container mt-3">
    <div class="row">
      <?php 
        foreach ($terms  as $term): 
        $image = get_field('icon_term', $term);
          $term_link = get_term_link( $term );
          if ( is_wp_error( $term_link ) ) {
              continue;
          }
          if($image):
        ?>
        <div class="col-md-4 col-sm-4 col-xs-4">
          <div class="card">
            <div class="card-img-top text-center px-5 mt-3">
              <a href="<?= $term_link; ?>"><img src="<?= $image; ?>" class="img-fluid" alt="<?= $term->name; ?>"></a>
              <span class="counter"><?= $term->count; ?> <b>سيارة</b></span>
            </div>
          </div>
        </div>
      <?php 
        else:
          ?>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="card">
              <div class="card-img-top img-placeholder text-center px-5 mt-3">
                <a href="<?= $term_link; ?>"><span><?= $term->name; ?></span></a>
                <span class="counter"><?= $term->count; ?> <b>سيارة</b></span>
              </div>
            </div>
          </div>
          <?php
          endif;
        endforeach; ?>
    </div>
    <div class="link"><a class="btn btn-primary m-auto" href="<?= $term_page_link; ?>">شاهد المزيد </a></div> 
  </div>
</section>

<?php if( have_rows('cars_by_category') ): ?>
  <section class="section-cars">
    <?php 
      while( have_rows('cars_by_category') ) : the_row();
        $headline = get_sub_field('headline_cars_by_category');
        $cars = get_sub_field('category_cars');

        $category_cars = get_sub_field('category_cars_taxonomy');
        $link = get_sub_field('link_cars_by_category');

        $args = array(
          'post_type'      => array( 'cars', 'products' ),
          'posts_per_page' => 6,
          'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'products-tag',
                'field'    => 'term_id',
                'terms'    => array($category_cars),
                'operator' => 'IN',
            ),
          ),
        );
        $query = new WP_Query( $args );

      ?>
      <div class="cars-listing">
        <div class="container">
          <h3><?= $headline; ?></h3>
          <div class="row">

          <?php
            if ( $cars ):
              foreach( $cars as $car ): 
                $img_url = get_the_post_thumbnail_url($car->ID,'medium');
                $author_id =  get_post_field( 'post_author', $car->ID );
                // $author_id = get_the_author_ID($car->ID);
                $avatar = get_field('user_logo', 'user_'. $author_id);
                ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
              <div class="car-box">
                <div class="car-box-img">
                  <a class="link-img" href="<?= get_permalink($car->ID); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title($car->ID); ?>"></a>
                </div>
                <div class="car-box-content">
                  <h4 class="text-uppercase"><?= get_the_title($car->ID); ?></h4>
                  <div class="information">
                    <span class="price"><?= the_field('price', $car->ID); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                    <span class="author">
                      <a class="logo-author" href="<?php echo get_author_posts_url($author_id); ?>"><img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
                    </span>
                  </div>
                </div>
                <div class="overlay">
                  <div class="specifications">
                    <?php 
                    $rows = get_field('specifications', $car->ID);
                    if( $rows ) {
                      $first_row = $rows[0];
                      $first_text = $first_row['text_specifications'];
                      $first_icon = $first_row['icon_specifications'];
                      $two_row = $rows[1];
                      $two_text = $two_row['text_specifications'];
                      $two_icon = $two_row['icon_specifications'];
                    }
                    ?>

                    <?php if($first_row): ?>
                      <div class="spec-icon">
                        <i class="<?=  $first_icon ?> text-primary mr-1"></i>
                        <span><?=  $first_text; ?></span>
                      </div>
                    <?php endif; ?>

                    <?php if($two_row): ?>
                      <div class="spec-icon">
                        <i class="<?=  $two_icon; ?> text-primary mr-1"></i>
                        <span><?=  $two_text; ?></span>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php
              endforeach;
            else:
              ?>      
            <?php
            if ( $query->have_posts() ):
              while ( $query->have_posts() ):
                $query->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
                $author_id = get_the_author_ID();
                $avatar = get_field('user_logo', 'user_'. $author_id);
                ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
              <div class="car-box">
                <div class="car-box-img">
                  <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title(); ?>"></a>
                </div>
                <div class="car-box-content">
                  <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
                  <div class="information">
                    <span class="price"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                    <span class="author">
                      <a class="logo-author" href="<?php echo get_author_posts_url($author_id); ?>"><img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
                    </span>
                  </div>
                </div>
                <div class="overlay">
                  <div class="specifications">
                    <?php 
                    $rows = get_field('specifications' );
                    if( $rows ) {
                      $first_row = $rows[0];
                      $first_text = $first_row['text_specifications'];
                      $first_icon = $first_row['icon_specifications'];
                      $two_row = $rows[1];
                      $two_text = $two_row['text_specifications'];
                      $two_icon = $two_row['icon_specifications'];
                    }
                    ?>

                    <?php if($first_row): ?>
                      <div class="spec-icon">
                        <i class="<?=  $first_icon ?> text-primary mr-1"></i>
                        <span><?=  $first_text; ?></span>
                      </div>
                    <?php endif; ?>

                    <?php if($two_row): ?>
                      <div class="spec-icon">
                        <i class="<?=  $two_icon; ?> text-primary mr-1"></i>
                        <span><?=  $two_text; ?></span>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php
              endwhile;
            endif;
              ?>      
            <?php wp_reset_postdata(); ?>
        <?php endif;?>
          </div>
          <?php if($link): ?>
            <div class="link"><a class="btn btn-primary" href="<?= $link; ?>">شاهد جميع السيارات</a></div> 
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; ?>
  </section>
<?php endif; ?>


  <section id="hero-text" class="wow fadeIn">
    <div class="container">`
      <div class="row">
        <div class="col-sm-3 text-right">
          <img src="<?= the_field('ads_left'); ?>" alt="<?= the_field('headline_ads'); ?>">
        </div>

        <div class="col-sm-6 text-center">
          <h2><?= the_field('headline_ads'); ?></h2>
          <p><?= the_field('content_ads'); ?></p>
        </div>

        <div class="col-sm-3 text-right">
          <img src="<?= the_field('ads_right'); ?>" alt="<?= the_field('headline_ads'); ?>">
        </div>
      </div>
    </div>
  </section>

  <!--/#hero-text-->
  <section id="services">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center wow fadeInDown"><?= the_field('headline_services'); ?></h2>
        <div class="text-center wow fadeInDown"><?= the_field('content_services'); ?></div>
      </div>
      <div class="row">
        <div class="features">
        <?php
            if( have_rows('steps_about_us') ):
              while( have_rows('steps_about_us') ) : the_row();
            ?>
              <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms">
                <div class="media service-box">
                  <div class="hexagon">
                    <div class="inner">
                      <i class="<?= get_sub_field('icon_step'); ?>"></i>
                    </div>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading text-center"><?= get_sub_field('headline_step'); ?></h4>
                  </div>
                </div>
              </div>
            <?php
              endwhile;
            endif;
            ?>
        </div>
      </div>
      <!--/.row-->
    </div>
    <!--/.container-->
  </section>
  <!--/#services-->

  <section id="about">
    <div class="container">

      <div class="section-header">
        <h2 class="section-title text-center wow fadeInDown"><?= the_field('headline_about_us'); ?></h2>
      </div>

      <div class="row">
        <div class="col-sm-6 wow fadeInRight">
          <h3 class="column-title"><?= the_field('sub_sheadline_about_us'); ?></h3>
          <?= the_field('content_about_us'); ?>
        </div>
        <div class="col-sm-6 wow fadeInLeft">
          <img class="img-responsive" src="<?= the_field('image_about_us'); ?>" alt="">
        </div>
      </div>
    </div>
  </section>

  <section id="portfolio">

    <section id="gallery-1" data-section="gallery-1" class="content-block section-wrapper gallery-1 data-section">

      <div class="container">

        <div class="section-header">
          <h2 class="section-title text-center wow fadeInDown animated"
            style="visibility: visible; animation-name: fadeInDown;"><?= the_field('products_headline'); ?></h2>
          <p class="text-center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;"><?= the_field('products_text'); ?></p>
        </div>
       
        <!-- /.gallery-filter -->

        <div class="row">
          <div id="isotope-gallery-container">
            <?php 
            $args = array(
              'post_type' => array( 'cars', 'products' ),
              'posts_per_page' => '9',
              'meta_query' => array(
                array(
                  'key'     => 'featured_car',
                  'value' => '1',
                ),
              )              
            );
            $query = new WP_Query( $args );
          
            if ( $query->have_posts() ):
              while ( $query->have_posts() ):
                $query->the_post();
                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium'); 
                // Returns Array of Term ID's for "my_taxonomy".
                $term_list = wp_get_post_terms( get_the_ID(), 'products-brand', array( 'fields' => 'ids' ) );
            ?>
              <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper car-<?= $term_list[0]; ?> creative">
                <div class="gallery-item">
                  <div class="gallery-thumb">
                    <img src="<?= ($featured_img_url)? $featured_img_url:$placeholder; ?>" class="img-responsive" alt="1st gallery Thumb">
                    <div class="image-overlay"></div>
                    <a href="<?= get_permalink(); ?>" class="gallery-link"><i class="fa fa-link"></i></a>
                  </div>
                  <div class="gallery-details">
                    <div class="editContent">
                      <h5><?= the_title(); ?></h5>
                    </div>
                  </div>
                </div>
              </div>
            <?php 
              endwhile; 
            endif; 
            wp_reset_postdata(); 
            ?>

          </div>
          <!-- /.isotope-gallery-container -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!--// End Gallery 1-2 -->
  </section>

  <!--/#portfolio-->
  <section id="client-slider" class="my-5" style="display:none;">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="text-center">عملائنا</h1>
      </div>
    </div>
    <div class="container mt-3">
      <div class="row owl-carousel">
        <?php $images = get_field('our_clients'); ?>
        <?php foreach( $images as $image ): ?>
          <div class="card">
            <div class="card-img-top text-center px-5 mt-3">
              <img src="<?= $image; ?>" class="img-fluid" alt="logo clients">
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="testimonial">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

          <div id="carousel-testimonial" class="carousel slide text-center" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            <?php
            $counter = 0;
            if( have_rows('testimonial') ):
              while( have_rows('testimonial') ) : the_row();
              $counter++;
            ?>
              <div class="item <?= ($counter == 1)?'active':''; ?>">
                <p><img class="img-thumbnail" src="<?= the_sub_field('image_of_testimonial'); ?>" alt="<?= the_sub_field('name_of_testimonial'); ?>"></p>
                <h4><?= the_sub_field('name_of_testimonial'); ?></h4>
                <p><?= the_sub_field('text_of_testimonial'); ?></p>
              </div>
              <?php endwhile; ?>
            <?php endif; ?>
            </div>

            <!-- Controls -->
            <div class="btns">
              <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="next">
                <span class="fa fa-angle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="prev">
                <span class="fa fa-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/#testimonial-->


  <section id="contact-us">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center wow fadeInDown"><?= the_field('contact_us_headline'); ?></h2>
        <p class="text-center wow fadeInDown"><?= the_field('contact_us_text'); ?></p>
        <p><a href="<?= the_field('contact_us_link'); ?>">تواصل معنا</a></p>
      </div>
    </div>
  </section>
  <!--/#contact-us-->
<?php
get_footer();
?>
