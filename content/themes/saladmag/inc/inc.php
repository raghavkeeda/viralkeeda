<?php
//widget
require_once dirname( __FILE__ ).'/widget/comments.php';
require_once dirname( __FILE__ ).'/widget/tab.php';
require_once dirname( __FILE__ ).'/widget/tab-post.php';
require_once dirname( __FILE__ ).'/widget/tab-post-large.php';
require_once dirname( __FILE__ ).'/widget/facebook.php';
require_once dirname( __FILE__ ).'/widget/flickr.php';
require_once dirname( __FILE__ ).'/widget/ads300x250.php';
require_once dirname( __FILE__ ).'/widget/ads728x90.php';
require_once dirname( __FILE__ ).'/widget/popular.php';  
require_once dirname( __FILE__ ).'/widget/recent.php';
require_once dirname( __FILE__ ).'/widget/recent1.php';
require_once dirname( __FILE__ ).'/widget/recent-large.php';
require_once dirname( __FILE__ ).'/widget/carousel.php';
require_once dirname( __FILE__ ).'/widget/twitter_widget.php';
require_once dirname( __FILE__ ).'/widget/video-widget.php';

//Shortcode
require_once dirname(__FILE__) . '/shortcode/shortcode.php';
//Twitteroauth
require_once dirname(__FILE__) . '/addon/twitteroauth.php';
//Metabox
require_once dirname(__FILE__) . '/addon/meta-box/meta-box.php';
//page builder
require_once dirname(__FILE__) . '/addon/aqua-page-builder-master/aq-page-builder.php';
//sidebar
require_once dirname(__FILE__) . '/addon/sidebar_generator.php';
//mega menu post
require_once dirname(__FILE__) . '/addon/menu_option.php';
// TGM
require_once dirname(__FILE__) . '/addon/tgm-plugin-activation/class-tgm-plugin-activation.php';
require_once dirname(__FILE__) . '/addon/tgm-plugin-activation/required_plugins.php';
?>
