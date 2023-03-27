<?php
/**
 * The theme header.
 * 
 * @package bootstrap-basic4
 */

$container_class = apply_filters('bootstrap_basic4_container_class', 'container');  
if (!is_scalar($container_class) || empty($container_class)) {
    $container_class = 'container';
}
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


  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M435QTM9ES"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-M435QTM9ES');
  </script>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-K9C75P9');</script>
  <!-- End Google Tag Manager -->

  <!-- Meta Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '382207210761797');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=382207210761797&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->


    <script>
    !function (w, d, t) {
      w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
    
      ttq.load('CGGAQ4JC77U2RIRLI5GG');
      ttq.page();
    }(window, document, 'ttq');
    </script>

  <!--end WordPress head-->
  <style>
    .navbar-action a {
        margin-left: 30px;
        height: 88px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-right: 20px;
        padding-left: 20px;
        background: #d97e00;
        box-sizing: border-box;
        border-left: 1px solid #f8f8f8;
        color: #fff;
        font-size: 26px;
    }

    .navbar-action {
        float: right;
    }

    @media only screen and (max-width: 769px) {
      .navbar-action {
        width: 30%;
      }

      .navbar-header {
        width: 70%;
        float: left;
      }
      
      .navbar-right {
        float: right;
        width: 100%;
      }
    }


  </style>
</head>

<body <?php body_class(); ?>>
<header id="header">
    <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
           <?php 
            if(get_field('logo', 'option')): 
            $image = get_field('logo', 'option');
            ?>
            <div class="logoSection">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                  title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                  <img class="img-fluid" src="<?= $image['url']; ?>"
                    alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
                  <span class="sr-only"> <?=get_bloginfo('name') ?> </span>
                </a>
            </div>
           <?php else: ?>
          <div class="logoSection">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
              <img class="img-fluid" src="<?=get_theme_file_uri().'/assets/img/logo.png' ?>"
                alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
              <span class="sr-only"> <?=get_bloginfo('name') ?> </span>
            </a>
          </div>
          <?php endif; ?>
        </div>
        <div class="navbar-action">
          <a href="<?php echo esc_url(home_url('/dashboard')); ?>">
            <i class="fa fa-user"></i>
          </a>
        </div>

        <div class="navbar-right">
          <?php 
		  
          wp_nav_menu(
            array(
              'depth' => '2',
              'theme_location' => 'primary', 
              'container' => false, 
              'menu_id' => 'bb4-primary-menu',
              'menu_class' => 'nav navbar-nav', 
              'walker' => new \BootstrapBasic4\BootstrapBasic4WalkerNavMenu()
            )
          ); 
          ?>          
        </div>
      </div>
      <!--/.container-->
    </nav>
    <!--/nav-->
  </header>
  <!--/header-->
