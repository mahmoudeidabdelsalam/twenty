<?php
/** 
 * The search template.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();

?> 
                <main id="main" class="col-md-<?php echo \BootstrapBasic4\Bootstrap4Utilities::getMainColumnSize(); ?> site-main" role="main">
                    <?php
                    if (have_posts()) {
                    ?> 

                    <header class="page-header">
                        <p class="page-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'teslatradeltd'); ?></a> > <?php _e('Search Results', 'teslatradeltd'); ?></p>
                    </header><!-- .page-header -->




                    <div class="page-content row-with-vspace">
                        <?php get_template_part('template-parts/partial', 'search-form'); ?> 
                    </div><!-- .page-content -->



                    <?php  printf(__('Search Results for: %s', 'bootstrap-basic4'), '<span>' . get_search_query() . '</span>'); ?>


                    <?php
                        while (have_posts()) {
                            the_post();
                            get_template_part('template-parts/content', get_post_format());
                        }// endwhile;

                        $Bsb4Design = new \BootstrapBasic4\Bsb4Design();
                        $Bsb4Design->pagination();
                        unset($Bsb4Design);
                    } else {
                        get_template_part('template-parts/section', 'no-results');
                    }// endif;
                    ?> 
                </main>
<?php

get_footer();