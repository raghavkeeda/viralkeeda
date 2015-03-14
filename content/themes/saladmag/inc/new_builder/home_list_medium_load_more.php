<?php
class home_post_list_medium_load_more extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Home list post load more',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('home_post_list_medium_load_more', $block_options);
	}
	
	
	//create form
	function form($instance) {
        $titles = isset($instance['titles']) ? esc_attr($instance['titles']) : 'Home post list load more';
        $number_show = isset($instance['number_show']) ? absint($instance['number_show']) : 4;
        $show_style_1 = isset($instance['show_style_1']) ? (bool) $instance['show_style_1'] : false;
		?>
        <p><label for="<?php echo $this->get_field_id('titles'); ?>"><?php _e('Title:', 'jelly_text_main'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('titles'); ?>" name="<?php echo $this->get_field_name('titles'); ?>" type="text" value="<?php echo $titles; ?>" /></p>

        
        <p><label for="<?php echo $this->get_field_id('number_show'); ?>"><?php _e('Number of posts to show:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_show'); ?>" name="<?php echo $this->get_field_name('number_show'); ?>" type="text" value="<?php echo $number_show; ?>" size="3" /></p>
          
            
 
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Choose your category:', 'jelly_text_main'); ?> 

                <?php
                $categories = get_categories('hide_empty=0');
                echo "<br/>";
                foreach ($categories as $cat) {
                    $option = '<input type="checkbox" id="' . $this->get_field_id('cats') . '[]" name="' . $this->get_field_name('cats') . '[]"';
                    if (isset($instance['cats'])) {
                        foreach ($instance['cats'] as $cats) {
                            if ($cats == $cat->term_id) {
                                $option = $option . ' checked="checked"';
                            }
                        }
                    }
                    $option .= ' value="' . $cat->term_id . '" />';
                    $option .= '&nbsp;';
                    $option .= $cat->cat_name;
                    $option .= '<br />';
                    echo $option;
                }
                ?>
            </label>	
		<?php
		
	}
		
	
	//create block
	function block($instance) {
		
		    extract($instance);

        $titles = apply_filters('widget_title', empty($instance['titles']) ? 'Recent Posts' : $instance['titles'], $instance, $this->id_base);
    
        $show_style_1 = isset($instance['show_style_1']) ? $instance['show_style_1'] : false;
        if (!isset($instance["cats"])){$cats = '';}
        ?>
        <div class="widget post_list_medium_widget">
        <?php if (!empty($instance['titles'])) {?><div class="widget-title"><h2><?php echo $instance["titles"];?></h2></div><?php }?>
		<div class="widget_container" id="content_masonry">
        
        <?php
		if ( get_query_var('paged') ) {
							$paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
							$paged = get_query_var('page');
						} else {
							$paged = 1;
						}
		query_posts( array ( 'paged' => $paged, 'orderby' => 'date', 'order' => 'DESC', 'showposts' => $number_show, 'category__in' => $cats, 'ignore_sticky_posts' => 1 ) );	
		if (have_posts()){
       while (have_posts()){
		   the_post(); 
		   $post_id = get_the_ID();
		   //get all post categories
            $categories = get_the_category(get_the_ID());
                  ?>   

    <div class="post_list_medium_widget loop-post-content"> 
    <div class="feature-post-list">    
    <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
</a>
					
                   <?php echo jellywp_post_type(); ?>
                   
             <?php echo total_score_post_front(get_the_ID());?> 		                         
              <?php  if(of_get_option('disable_post_category') !=1){
					if ($categories) {
						echo '<span class="meta-category">';
						foreach( $categories as $tag) {
							$tag_link = get_category_link($tag->term_id);
							$titleColor = categorys_title_color($tag->term_id, "category", false);
						 echo '<a class="post-category-color" style="background-color:'.$titleColor.'" href="'.$tag_link.'">'.$tag->name.'</a>';					
						}
						echo "</span>";
						}
			 }?>                                 
      
                     </div>

<div class="post_loop_content">
 <h3 class="image-post-title feature_2col"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
<?php echo jellywp_post_meta(get_the_ID()); ?>
<p><?php echo jellywp_post_excerpt(get_the_excerpt('')); ?> </p>
</div>
 </div>
    </div>
         
              
                <?php }}?>
     
        </div>
        
        <div class="pagination-more" style = "visibilty:hidden;">
            <div class="more-previous"><?php next_posts_link( __( 'Load More Post', 'jelly_text_main') ); ?></div>
            </div>
        
        </div>
     
        <?php
        wp_reset_query();	
		
	}
	
	    function update($new_instance, $old_instance) {
        return $new_instance;
    }

	
}