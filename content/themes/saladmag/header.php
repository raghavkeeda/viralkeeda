<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
      <!-- Basic Page Needs
  	  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php bloginfo('name'); ?>  <?php wp_title('-'); ?></title>
        <!-- Mobile Specific Metas
  		================================================== -->
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Favicons
        ================================================== -->
        <?php $favor_icon = of_get_option('favicon_uploader'); ?>
            <link rel="shortcut icon" href="<?php if (!empty($favor_icon)){echo $favor_icon;}else{echo get_template_directory_uri().'/img/favicon.png';} ?>" type="image/x-icon" />       
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>    
<?php 
		if (! is_404() ) { 			
			$thumbnail_id = get_post_thumbnail_id();
			if( !empty($thumbnail_id) ){
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '440x280' );
				echo '<meta property="og:image" content="' . $thumbnail[0] . '"/>';		
			}		
		}
wp_head(); ?>                  	
<!-- end head -->
</head>
<body <?php body_class();?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php 
if(of_get_option('full_or_boxed_layout')!= 'full_image_option'){
if(of_get_option('background_body_option')== 'big_image'){?>
<img alt="full screen background image" src="<?php echo of_get_option('background_large_image');?>" id="full-screen-background-image" />
<?php }}?>

<div id="content_nav">
        <div id="nav">
		<?php $top_menu = array('theme_location' => 'Top_Menu', 'container' => '', 'menu_class' => 'menu-top-menu-sf', 'menu_id' => '', 'fallback_cb' => false); wp_nav_menu($top_menu);?>
    	<?php $main_menu = array('theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => '', 'menu_id' => '', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
   </div>
    </div>    
<?php if(of_get_option('full_or_boxed_layout') == 'box_image_option'){ if(of_get_option('background_option') == 'background_image'){?>
<div class="full-background"><img  src="<?php echo of_get_option('background_large_image');?>" alt="" /></div>
<?php }}?>

<div id="sb-site" class="<?php if(of_get_option('full_or_boxed_layout') == 'full_image_option'){echo "body_wraper_full";}else{echo "body_wraper_box";}?>">      			

<!-- Start header -->
<header class="header-wraper">

<div class="header_top_wrapper">
<?php $main_top = array('theme_location' => 'Top_Menu', 'container' => '', 'menu_class' => 'sf-top-menu', 'menu_id' => 'menu-top', 'fallback_cb' => false);?>
<div class="row <?php if($main_top == "" || !of_get_option('disable_top_menu')==0){echo "no-top";}?>">
<div class="six columns header-top-left-bar">

  <a class="open toggle-lef sb-toggle-left navbar-left" href="#nav">
				<div class="navicon-line"></div>
				<div class="navicon-line"></div>
				<div class="navicon-line"></div>
				</a>
<?php if(!of_get_option('disable_top_menu')==1){?>
              
  <div class="mainmenu"> 
<?php wp_nav_menu($main_top);?>
<div class="clearfix"></div>
</div>
<?php }?>
  
</div>

<div class="six columns header-top-right-bar">
<?php if(!of_get_option('disable_top_search')==1){?>
      <div id="search_block_top">
	<form id="searchbox" action="<?php echo home_url(); ?>" method="GET" role="search">
		<p>
			<input type="text" id="search_query_top" name="s" class="search_query ac_input" value="" placeholder="<?php _e('Search here', 'jelly_text_main'); ?>">
            <a class="button_search" href="javascript:document.getElementById('searchbox').submit();"></a>
	</p>
	</form>
    <span>Search</span>
    <div class="clearfix"></div>
</div>
<?php }?>
<?php if(!of_get_option('disable_top_header_date')==1){?>
<div class="clock">
<i class="fa fa-clock-o"></i>
<div id="Date">
<?php
/*setlocale(LC_TIME, "pt_BR");
$currDate = strftime("%e %B, %Y, %H:%M");
echo $currDate;*/
?>

<?php echo date('l j F Y');  //setlocale(LC_TIME, "de_DE"); echo strftime('%A %d %B %Y');?></div>
  <ul>
      <li id="hours"></li>
      <li class="point">:</li>
      <li id="min"></li>
      <li class="point">:</li>
      <li id="sec"></li>
  </ul>
</div>
<?php }?>

<div class="clearfix"></div>
</div>

</div>
</div>

 
        
 <div class="header_main_wrapper">
        <div class="row">
	<div class="<?php if (is_active_sidebar('banner-sidebar')) { echo'four columns header-top-left'; } else { echo'twelve columns logo-position';}?>">
    
      <!-- begin logo -->
                           
                           
                                <a href="<?php echo home_url(); ?>">
                                    <?php $logo = of_get_option('logo_uploader'); ?>
                                    <?php if (!empty($logo)): ?>   
                                        <img src="<?php echo $logo; ?>" alt="<?php bloginfo('description'); ?>"/>
                                    <?php else: ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('description'); ?>"/>
                                    <?php endif; ?>
                                </a>
                            
                            <!-- end logo -->
    </div>
    <?php if (is_active_sidebar('banner-sidebar')){ ?>
	<div class="eight columns header-top-right">  
  <?php dynamic_sidebar('banner-sidebar');?>
    </div>
    <?php }?>    
</div>

</div>

                
<!-- end header, logo, top ads -->

              
<!-- Start Main menu -->
<div id="menu_wrapper" class="menu_wrapper <?php if(!of_get_option('disable_sticky_menu')==1){echo "menu_sticky";}?>">
<div class="row">
	<div class="main_menu twelve columns"> 

                            <!-- main menu -->
                           
  <div class="menu-primary-container main-menu"> 
<?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => 'sf-menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
 <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="https://www.facebook.com/viralkeeda" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
 
 <div id="search_block_top">
  <form id="searchbox" action="<?php echo home_url(); ?>" method="GET" role="search">
    <p>
      <input type="text" id="search_query_top" name="s" class="search_query ac_input" value="" placeholder="<?php _e('Search here', 'jelly_text_main'); ?>">
            <a class="button_search" href="javascript:document.getElementById('searchbox').submit();"></a>
  </p>
  </form>
    <span>Search</span>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>                             
                            <!-- end main menu -->
                                                           
                          
                        </div>
                                           
                    </div>   
                    </div>
                    
<?php if ( is_page_template('home-page-background.php') ) {}else{?>
<div class="news_ticker_wrapper">
<div class="row">
<div class="nine columns">
<?php if(!of_get_option('disable_newsticker')==1){?>
  <div id="ticker">
  <div class="tickerfloat_wrapper"><div class="tickerfloat"><?php _e('Latest Update', 'jelly_text_main'); ?><i class="fa fa-caret-right"></i></div></div>
   <div class="marquee" id="mycrawler">
       <?php
	$category_news_ticker_post="";
	$number_of_news_ticker= of_get_option('number_news_ticker');
	$category_news_ticker= of_get_option('news_ticker_category');
	
	if(!empty($category_news_ticker)) {
		
	foreach($category_news_ticker as $key=>$value) { if($value == 1) { $category_news_ticker_post[] = $key; } }	
	}
	
	
	$post_array = array(
            'showposts' => $number_of_news_ticker,
            'category__in' => $category_news_ticker_post,
			'ignore_sticky_posts' => 1
        );	
        $jellywp_widget = new WP_Query($post_array);
		$i=0;
		 while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
			$i++;
			$post_id = get_the_ID();
			?>    
       <div><i class="fa fa-angle-double-right"></i><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
        <?php } wp_reset_query();?>
        
        </div>
        </div>
 <?php }?>     
</div>

    <div class="three columns">
    <?php if(!of_get_option('disable_social_icons')==1){?> 
    <ul class="social-icons-list top-bar-social">
     <?php if(of_get_option('facebook')!=''){?> <li><a href="<?php echo of_get_option('facebook');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png" alt="<?php _e('Facebook', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('twitter')!=''){?><li><a href="<?php echo of_get_option('twitter');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.png" alt="<?php _e('Twitter', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('google_plus')!=''){?><li><a href="<?php echo of_get_option('google_plus');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/google-plus.png" alt="<?php _e('Google Plus', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('youtube')!=''){?><li><a href="<?php echo of_get_option('youtube');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png" alt="<?php _e('Youtube', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('pinterest')!=''){?><li><a href="<?php echo of_get_option('pinterest');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/pin.png" alt="<?php _e('Pinterest', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('behance')!=''){?><li><a href="<?php echo of_get_option('behance');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/behance.png" alt="<?php _e('Behance', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('vimeo')!=''){?><li><a href="<?php echo of_get_option('vimeo');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/vimeo.png" alt="<?php _e('Vimeo', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('instagram')!=''){?><li><a href="<?php echo of_get_option('instagram');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/instagram.png" alt="<?php _e('Instagram', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('linkedin')!=''){?><li><a href="<?php echo of_get_option('linkedin');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/link.png" alt="<?php _e('linkedin', 'jelly_text_main'); ?>"></a></li><?php }?>
    <?php if(of_get_option('blogger')!=''){?> <li><a href="<?php echo of_get_option('blogger');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/blogger.png" alt="<?php _e('Blogger', 'jelly_text_main'); ?>"></a></li><?php }?>
    <?php if(of_get_option('deviantart')!=''){?> <li><a href="<?php echo of_get_option('deviantart');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/d-art.png" alt="<?php _e('Deviantart', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('dribble')!=''){?><li><a href="<?php echo of_get_option('dribble');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/dribble.png" alt="<?php _e('Dribble', 'jelly_text_main'); ?>"></a></li><?php }?>
    <?php if(of_get_option('dropbox')!=''){?> <li><a href="<?php echo of_get_option('dropbox');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/dropbox.png" alt="<?php _e('Dropbox', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('rss')!=''){?><li><a href="<?php echo of_get_option('rss');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/rss.png"></a></li><?php }?>
     <?php if(of_get_option('skype')!=''){?><li><a href="<?php echo of_get_option('skype');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/skype.png" alt="<?php _e('Skype', 'jelly_text_main'); ?>"></a></li><?php }?>
     <?php if(of_get_option('stumbleupon')!=''){?><li><a href="<?php echo of_get_option('stumbleupon');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/stumbleupon.png" alt="<?php _e('Stumbleupon', 'jelly_text_main'); ?>"></a></li><?php }?>
    <?php if(of_get_option('wordpress')!=''){?> <li><a href="<?php echo of_get_option('wordpress');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/wordpress.png" alt="<?php _e('WordPress', 'jelly_text_main'); ?>"></a></li><?php }?>
    <?php if(of_get_option('yahoo')!=''){?> <li><a href="<?php echo of_get_option('yahoo');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/yahoo.png" alt="<?php _e('Yahoo', 'jelly_text_main'); ?>"></a></li><?php }?>
     </ul>  
      <?php }?>
    </div>

</div>
</div>
<?php }?>

            </header>

