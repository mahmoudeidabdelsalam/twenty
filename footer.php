<?php
/** 
 * The theme footer.
 * 
 * @package bootstrap-basic4
 */
?>
    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 col-xs-12 text-left">
            <img style="max-width: 120px" src="<?= get_field('logo_footer', 'option'); ?>" alt="logo footer">
          </div>

          <div class="col-sm-8 col-xs-12 text-right">
            <p><?= get_field('copy_right', 'option'); ?></p>
            <ul class="social-icons">
              <?php
              if( have_rows('social_media', 'option') ):
                while( have_rows('social_media', 'option') ) : the_row();
              ?>
                <li>
                  <a href="<?= get_sub_field('link_social_media'); ?>"><i class="<?= get_sub_field('icon_social_media'); ?>"></i></a>
                </li>
              <?php
                endwhile;
              endif;
              ?>
            </ul>
          </div>


        </div>
      </div>
    </footer>

    <a href="https://wa.me/<?= the_field('whatsapp', 'option'); ?>" class="whatsapp-btn whatsapp" target="_blank">
      <img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/whatsapp.png' ?>" alt="<?=get_bloginfo('name', 'display'); ?>" title="<?= get_bloginfo('name'); ?>" />
      <span>تواصل مع 20</span>
    </a>

    <a href="tel:<?= the_field('phone', 'option'); ?>" class="phone-btn phone" target="_blank">
      <img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/phone.png' ?>" alt="<?=get_bloginfo('name', 'display'); ?>" title="<?= get_bloginfo('name'); ?>" />
      <span>تواصل مع 20</span>
    </a>

    <style>
      .whatsapp-btn span {
        display: block;
        color: #fff;
        text-shadow: 0 0 5px #000;
      }
      .whatsapp-btn {
        text-align: center;
      }

      footer#footer .row {
        display: flex;
        align-items: center;
        flex-flow: row-reverse;
        justify-content: space-between;
      }
    </style>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K9C75P9"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php wp_footer(); ?> 
  </body>
</html>