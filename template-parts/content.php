
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if (is_search()) {  ?> 

    <div class="entry-summary">
        <?php the_excerpt(); ?> 
        <div class="clearfix"></div>
    </div>

  <?php } else { ?> 

  <?php 
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    $author_id = get_the_author_meta( 'ID' ); 
  ?>
    <header class="entry-header">
      <img src="<?= $featured_img_url; ?>" alt="<?php the_title(); ?>">      
      <p><time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time></p>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    
    <div class="entry-content pb-5 mb-5">
      <?php the_content(); ?> 
      <?php if(get_field('author_image')): ?>
        <div class="author">
          <div class="media">
            <img src="<?= get_field('author_image'); ?>" class="mr-3" alt="<?= get_field('author_name'); ?>">
            <div class="media-body">
              <h5 class="mt-0"><?= get_field('author_name'); ?></h5>
              <p><?= get_field('author_title'); ?></p>
            </div>
            <div class="bio">
              <?= get_field('author_bio'); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php get_template_part('template-parts/nextprevious', 'post'); ?>
    </div>

    <?php } //endif; ?> 
</article>