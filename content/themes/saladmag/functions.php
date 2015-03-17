<?php
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/option/');
    require_once dirname(__FILE__) . '/inc/option/options-framework.php';
}

//load file
require_once dirname(__FILE__) .'/inc/inc.php';

/*  ----------------------------------------------------------------------------
    Category metadata
 */

require_once("inc/addon/Tax-meta-class/Tax-meta-class.php");
if (is_admin()){
  /*
   * configure your meta box
   */
  $config = array(
    'id' => 'demo_meta_box',          // meta box id, unique per meta box
    'title' => 'Demo Meta Box',          // meta box title
    'pages' => array('category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
    //Category color
    $my_meta->addColor('jellywp_color', array('name'=> __('Category color ','tax-meta')));
    $my_meta->Finish();
}

/* -------------------------------------------------------------------------*
 * 								GET TITLE COLOR								*
 * -------------------------------------------------------------------------*/
 
function categorys_title_color($id, $type="category", $echo=true) {
 	if($type == "category" && $id!="popular" && $id!="latest") {
		$my_meta = new Tax_Meta_Class('');
		$titleColor = $my_meta->get_tax_meta($id, 'jellywp_color');
		$my_meta->Finish();
	}else if ($type=="page") {
		$titleColor = "#".get_post_meta($id, "jellywp_color",true); 
	}

	
	if($echo!=false) {
		echo $titleColor;
	}else{
		return $titleColor;
	}
}

// max content width
if ( ! isset( $content_width ) ){ $content_width = 960; }

//register menu
function jellywp_register_menu() {
    register_nav_menus(
            array(
                'Main_Menu' => 'Main menu',
                'Top_Menu' => 'Top menu',
                'Footer_Menu' => 'Footer menu'
            )
    );
}
add_action('init', 'jellywp_register_menu');
add_filter( 'widget_text', 'do_shortcode' );
add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );

// Post thumbnail support
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	add_image_size('slider-large', 1110, 510, true);
	add_image_size('slider-normal', 670, 460, true);
	add_image_size('feature-grid', 250, 242, true);
	add_image_size('small-grid', 171, 108, true);
	add_image_size('medium-feature', 400, 255, true);
	add_image_size('small-feature', 75, 75, true);
	add_image_size('slider-feature', 735, 450, true);
}

// Author contact info
function extra_contact_info($contactmethods) {
$contactmethods['rss'] = 'Rss feed';
$contactmethods['linkedin'] = 'Linkedin';
$contactmethods['pinterest'] = 'Pinterest';
$contactmethods['devianart'] = 'Devianart';
$contactmethods['dribble'] = 'Dribble';
$contactmethods['behance'] = 'Behance';
$contactmethods['youtube'] = 'Youtube';
$contactmethods['instagram'] = 'Instagram';
$contactmethods['twitter'] = 'Twitter';
$contactmethods['googleplus'] = 'Googleplus';
$contactmethods['facebook'] = 'Facebook';
return $contactmethods;
}
add_filter('user_contactmethods', 'extra_contact_info');

function jellywp_sidebar_register() {
    register_sidebar(array(
        'name' => __('General Sidebar', 'jelly_text_main'),
        'id' => 'general-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '<div class="margin-bottom"></div></div>',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));
	
 
    register_sidebar(array(
        'name' => __('Header sidebar', 'jelly_text_main'),
        'id' => 'banner-sidebar',
        'before_widget' => '',
        'after_widget' => "",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer1 Sidebar', 'jelly_text_main'),
        'id' => 'footer1-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer2 Sidebar', 'jelly_text_main'),
        'id' => 'footer2-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer3 Sidebar', 'jelly_text_main'),
        'id' => 'footer3-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    )); 
}
add_action('init', 'jellywp_sidebar_register');

function setup_language(){
    load_theme_textdomain('jelly_text_main', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'setup_language');

//count review
function jellywp_single_post_meta($post_id) {
                     
                               echo'<p class="post-meta meta-main-img">';
                              if(of_get_option('disable_post_date') !=1){ echo '<span class="post-date updated"><i class="fa fa-clock-o"></i>'.get_the_date('M d, Y').'</span>';}
                                 if(of_get_option('disable_post_author') !=1){echo '<span class="vcard post-author meta-user"><span class="fn"><i class="fa fa-user"></i>'; echo the_author_posts_link().'</span></span>';}
                              if(of_get_option('disable_post_category') !=1){ echo '<span class="meta-cat"><i class="fa fa-book"></i>'; echo the_category(', ').'</span>';}
                             if(of_get_option('disable_post_comment_meta') !=1){ echo '<span class="meta-comment">'; echo comments_popup_link(__('<i class="fa fa-comments"></i>0', 'jelly_text_main'), __('<i class="fa fa-comments"></i> 1', 'jelly_text_main'), __('<i class="fa fa-comments"></i>%', 'jelly_text_main')).'</span>'; }
                            echo '<span class="post-date updated"><i class="fa fa-eye"></i>'.wpb_get_post_views($post_id).'</span>';
                                     echo'</p>';	
}

function jellywp_post_meta($post_id) {
							
                               echo'<p class="post-meta meta-main-img">';
                               if(of_get_option('disable_post_author') !=1){ echo '<span class="post-author"><i class="fa fa-user"></i>'; echo the_author_posts_link().'</span>';}
								if(of_get_option('disable_post_date') !=1){echo '<span class="post-date"><i class="fa fa-clock-o"></i>'.get_the_date('M d, Y').'</span>';}
								 /* if(of_get_option('disable_post_comment_meta') !=1){ echo '<span class="meta-comment">'; echo comments_popup_link(__('<i class="fa fa-comments"></i>0', 'jelly_text_main'), __('<i class="fa fa-comments"></i> 1', 'jelly_text_main'), __('<i class="fa fa-comments"></i>%', 'jelly_text_main')).'</span>';}*/
                                     echo'</p>';	
}


//count review
function total_score_post($post_id) {
   $review_value1 = get_post_custom_values('review_option1jellywp_slider', $post_id);
   $review_value2 = get_post_custom_values('review_option2jellywp_slider', $post_id);
   $review_value3 = get_post_custom_values('review_option3jellywp_slider', $post_id);
   $review_value4 = get_post_custom_values('review_option4jellywp_slider', $post_id);
   $review_value5 = get_post_custom_values('review_option5jellywp_slider', $post_id);
   $total_review= $review_value1[0] + $review_value2[0] + $review_value3[0] + $review_value4[0] + $review_value5[0];
  if($total_review != 0){
	 return $total_review;
	}
	else{
	return 0;	
	}
}

//count review
function total_score_post_front($post_id) {
   $review_value1 = get_post_custom_values('review_option1jellywp_slider', $post_id);
   $review_value2 = get_post_custom_values('review_option2jellywp_slider', $post_id);
   $review_value3 = get_post_custom_values('review_option3jellywp_slider', $post_id);
   $review_value4 = get_post_custom_values('review_option4jellywp_slider', $post_id);
   $review_value5 = get_post_custom_values('review_option5jellywp_slider', $post_id);
   $total_review = $review_value1[0] + $review_value2[0] + $review_value3[0] + $review_value4[0] + $review_value5[0];
  $sum_review= round($total_review /5 ,1);
  if($sum_review != 0){if(of_get_option('disable_post_review') !=1){ 
	return '<div class="ratings-wrapper"><div class="rating-bg">
	 <div class="rating" style="width:'.($total_review * 10) /5 .'%"></div>
	 </div></div>';
	}}
	else{
	
	}
}

//Embed video url
function embed_video_url($video_url, $video_width = 500, $video_height = 300){
		if( empty($video_width) && empty($video_height) ){ $video_width = 500; $video_height = 300;}
		if(strpos($video_url,'youtube')){youtube_url($video_url, $video_width, $video_height);}
		else if(strpos($video_url,'youtu.be')){youtube_url($video_url, $video_width, $video_height, 'youtu.be');}
		else if(strpos($video_url,'vimeo')){vimeo_url($video_url, $video_width, $video_height);}
}

//Youtube url
function youtube_url($video_url, $video_width = 500, $video_height = 300, $video_type = 'youtube', $return = false){
		if( $video_type == 'youtube' ){preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$video_url,$video_id);}
		else{preg_match('/youtu.be\/([^\\?\\&]+)/', $video_url,$video_id);}
		$video_attr = "";
		if( strpos($video_url, 'autoplay=1') > 0 ) $video_attr = "&autoplay=1";
		if( strpos($video_url, 'rel=0') > 0 ) $video_attr = $video_attr . "&rel=0";
		if( !$return ){echo '<iframe src="http://www.youtube.com/embed/' . $video_id[1] . '?wmode=transparent' . $video_attr . '" width="' . $video_width . '" height="' . $video_height . '" ></iframe>';}
		else{return '<iframe src="http://www.youtube.com/embed/' . $video_id[1] . '?wmode=transparent' . $video_attr . '" width="' . $video_width . '" height="' . $video_height . '" ></iframe>';}
	}

//Vimeo url
function vimeo_url($video_url, $video_width = 500, $video_height = 300, $return = false){
		preg_match('/https?:\/\/vimeo.com\/(\d+)$/', $video_url, $video_id);
		if( !$return ){echo '<iframe src="http://player.vimeo.com/video/' . $video_id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $video_width . '" height="' . $video_height . '"></iframe>';}
		else{return '<iframe src="http://player.vimeo.com/video/' . $video_id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $video_width . '" height="' . $video_height . '"></iframe>';}
}
	


if ( ! function_exists( 'jellywp_comment' ) ) :
function jellywp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'jelly_text_main'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'jelly_text_main'), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'jelly_text_main') . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
					
						sprintf( __( '%1$s at %2$s', 'jelly_text_main'), get_comment_date(), get_comment_time() )
					);
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'jelly_text_main'); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'jelly_text_main'), '<p class="edit-link">', '</p>' ); ?>
			</section>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'jelly_text_main'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>
	<?php
		break;
	endswitch; 
}
endif;
?>
<?php add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
return 'class="page"';
}
if ( ! function_exists( 'jellywp_pagination' ) ) {
function jellywp_pagination($pages = '', $range = 2){
		     $showitems = ($range * 2)+1;  

		     global $paged;
		     if(empty($paged)) $paged = 1;

		     if($pages == '')
		     {
		         global $wp_query;
		         $pages = $wp_query->max_num_pages;
		         if(!$pages)
		         {
		             $pages = 1;
		         }
		     }   

		     if(1 != $pages)
		     {
		         echo "<div class='pagination'>";
				echo get_previous_posts_link( __('Previous Page', 'jelly_text_main') );
		         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link(1)."'>&laquo;</a>";
		         if($paged > 1 && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		         for ($i=1; $i <= $pages; $i++)
		         {
		             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		             {
		                 echo ($paged == $i)? "<span class='current box'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive box' >".$i."</a>";
		             }
		         }

		         if ($paged < $pages && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
		         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($pages)."'>&raquo;</a>";
				echo get_next_posts_link( __('Next Page', 'jelly_text_main'));
		        echo "</div>\n";
		     }
		}
}

	 /* Post */
	 
add_theme_support( 'post-formats', array('gallery', 'quote', 'video', 'audio' ) );
function jellywp_post_type()
{
    if(has_post_format( 'quote' )){
        $post_type_image = '<span class="overlay_icon fa fa-quote-left"></span>';
    }elseif(has_post_format( 'gallery' )){
        $post_type_image = '<span class="overlay_icon fa fa-picture-o"></span>';
    }elseif(has_post_format('video')){
         $post_type_image = '<span class="overlay_icon fa fa-play-circle-o"></span>';
    }elseif(has_post_format('audio')){
         $post_type_image = '<span class="overlay_icon fa fa-volume-up"></span>';
    }else{
        $post_type_image ='';
    } 
    return $post_type_image;    
}

    /* Excerpt */
function jellywp_carousel_excerpt($text){
$chars_limit = 100;
$chars_text = strlen($text);
$text = $text." ";
$text = substr($text,0,$chars_limit);
$text = substr($text,0,strrpos($text,' '));
if ($chars_text > $chars_limit){$text = $text."...";}
return $text;
}

function jellywp_post_excerpt($text){
$chars_limit = 140;
$chars_text = strlen($text);
$text = $text." ";
$text = substr($text,0,$chars_limit);
$text = substr($text,0,strrpos($text,' '));
if ($chars_text > $chars_limit){$text = $text."...";}
return $text;
}	
	/* Scripts */

function add_html5 () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->
    ';
}
add_action('wp_head', 'add_html5');	  

function jellywp_enqueue_style() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', false, '1.6' );
	wp_enqueue_style( 'gumby', get_template_directory_uri().'/css/gumby.css', false, '1.6' ); 
	wp_enqueue_style( 'carousel', get_template_directory_uri().'/css/owl.carousel.css', false, '1.6' ); 
	wp_enqueue_style( 'theme', get_template_directory_uri().'/css/owl.theme.css', false, '1.6' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), false, '1.6' );   
	wp_enqueue_style( 'mediaelementplayer', get_template_directory_uri().'/css/mediaelementplayer.css', false, '1.6' ); 
	wp_enqueue_style( 'responsive', get_template_directory_uri().'/css/responsive.css', false, '1.6' ); 
	wp_enqueue_style( 'custom-style', get_template_directory_uri().'/custom_style.php', false, '1.6','all' ); 
}
       
function jellywp_enqueue_script() {
	wp_enqueue_script( 'jquery', get_template_directory_uri().'/js/jquery-1.10.1.min.js', false, '1.6', true );
	wp_enqueue_script( 'marquee', get_template_directory_uri().'/js/marquee.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri().'/js/owl.carousel.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'pageslide', get_template_directory_uri().'/js/jquery.pageslide.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'mediaelement-and-player', get_template_directory_uri().'/js/mediaelement-and-player.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'fluidvids', get_template_directory_uri().'/js/fluidvids.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'sticky', get_template_directory_uri().'/js/jquery.sticky.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'infinitescroll', get_template_directory_uri().'/js/jquery.infinitescroll.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'custom', get_template_directory_uri().'/js/custom.js', array('jquery'), '1.6', true );
	
}
add_action( 'wp_enqueue_scripts', 'jellywp_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'jellywp_enqueue_script' );

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
?>