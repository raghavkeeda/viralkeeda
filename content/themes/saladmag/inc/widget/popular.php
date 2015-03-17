<?php
add_action( 'widgets_init', 'popular_widgets' );

function popular_widgets() {
	register_widget( 'popular_widget' );
}


class popular_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function  __construct() {
		$widget_ops = array( 'classname' => 'post_list_widget', 'description' => __( 'Display a list of popular posts', 'jelly_text_main' ) );
		parent::__construct('popular_widget', __('jellywp: popular post', 'jelly_text_main'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('Popular Posts', $instance['title'] );
		$num_posts = $instance['num_posts'];
		echo $before_widget;
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
		// global $wpdb;
		// $my_row=$wpdb->get_results(
		// 	"select meta_value,term_taxonomy_id from `wp_postmeta`, `wp_term_relationships` where post_id=object_id And meta_key Like 'wpb_post_views_count' And post_id=189")
		// $Current_Category_Id=;
		// $No_of_Posts_Current_Category=$wpdb->get_var(
		// 	"SELECT count(id) From 
		// 	`wp_posts`,`wp_term_relationships` 
		// 	Where id=object_id 
		// 	and term_taxonomy_id=$Current_Category_Id");

		// $total_post_views = $wpdb->get_var(
		//  "SELECT Sum(meta_value)
		//  FROM `wp_postmeta` 
		//  WHERE meta_key 
		//  like 'wpb_post_views_count'" );
		// echo $total_post_views . "ewfwer";
		// 	$recent_posts = new WP_Query(array(
		// 		'showposts' => $num_posts,
		// 		'orderby' => 'comment_count',
		// 		'ignore_sticky_posts' => 1
		// 	));
			
			$today = getdate();
			$args = array(
			          'meta_key'     => 'wpb_post_views_count',
			          'meta_value'   => '1',
			          'meta_compare' => '>=',
			          'orderby'    => 'meta_value_num',
			          'ignore_sticky_posts' => 1,
			          'paged' => $paged,
			          'date_query' => array(
			                array(
			                        'year'  => $today['year'],
			                        'month' => $today['mon'],
			                        'day'   => $today['mday'],
			    ),
			),
			);
			$recent_posts = new WP_Query( $args );

			?>
				<div class="widget_container">
				<ul class="feature-post-list popular-post-widget">
			<?php while($recent_posts->have_posts()){ 
			$recent_posts->the_post();
			$post_id = get_the_ID(); 
			//get all post categories
            $categories = get_the_category(get_the_ID());
			?>

                         <li>
<a  href="<?php the_permalink(); ?>" class="feature-image-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('small-feature');}
else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/small-feature.jpg'.'">';} ?>
</a>
  <div class="item-details">
   <h3 class="feature-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
   <?php echo jellywp_post_meta(get_the_ID()); ?>
   <?php  if(of_get_option('disable_post_category') !=1){
					if ($categories) {
						echo '<span class="meta-category-small">';
						foreach( $categories as $tag) {
							$tag_link = get_category_link($tag->term_id);
							$titleColor = categorys_title_color($tag->term_id, "category", false);
						 echo '<a class="post-category-color" style="background-color:'.$titleColor.'" href="'.$tag_link.'">'.$tag->name.'</a>';					
						}
						echo "</span>";
						}
			 }?>
   <?php echo total_score_post_front(get_the_ID());?>
 </div>
   <div class="clearfix"></div>
   </li>
            

		<?php } wp_reset_query(); ?>
</ul>		
</div>			
<?php
		echo $after_widget;
	}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];
		return $instance;
	}


	function form($instance)
	{
		$defaults = array('title' => __( 'Popular Posts', 'jelly_text_main' ) , 'num_posts' => 4, 'show_comments' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'jelly_text_main' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:', 'jelly_text_main' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" type="text" value="<?php echo $instance['num_posts']; ?>" />
		</p>		
	<?php 
	}
}
?>