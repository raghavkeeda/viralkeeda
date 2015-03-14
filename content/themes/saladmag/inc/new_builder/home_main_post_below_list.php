<?php
class home_post_below_list extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Home post with below post',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('home_post_below_list', $block_options);
	}
	
	
	//create form
	function form($instance) {
        $titles = isset($instance['titles']) ? esc_attr($instance['titles']) : 'Home with below post';
        $number_show = isset($instance['number_show']) ? absint($instance['number_show']) : 7;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
		?>
        <p><label for="<?php echo $this->get_field_id('titles'); ?>"><?php _e('Title:', 'jelly_text_main'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('titles'); ?>" name="<?php echo $this->get_field_name('titles'); ?>" type="text" value="<?php echo $titles; ?>" /></p>

        
        <p><label for="<?php echo $this->get_field_id('number_show'); ?>"><?php _e('Number of posts to show:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_show'); ?>" name="<?php echo $this->get_field_name('number_show'); ?>" type="text" value="<?php echo $number_show; ?>" size="3" /></p>
            
             <p><label for="<?php echo $this->get_field_id('number_offset'); ?>"><?php _e('Offset posts:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_offset'); ?>" name="<?php echo $this->get_field_name('number_offset'); ?>" type="text" value="<?php echo $number_offset; ?>" size="3" /></p>    
 
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
		
      	if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}
        if (!isset($instance["cats"])){$cats = '';}

        // array to call recent posts.

        $jellywp_args = array(
            'showposts' => $number_show,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );
		


        $jellywp_widget = null;
        $jellywp_widget = new WP_Query($jellywp_args);

        ?>
        <div class="widget post_list_medium_widget">
        <?php if (!empty($instance['titles'])) {?><div class="widget-title"><h2><?php echo $instance["titles"];?></h2></div><?php }?>
		<div class="widget_container">
        <div class="post_list_medium">
        <?php
		$i = 0;
        while ($jellywp_widget->have_posts()) {
           $i++;
		   $post_id = get_the_ID();
		   $jellywp_widget->the_post();
		   //get all post categories
            $categories = get_the_category(get_the_ID());
           	if ($i == 1) {			
                ?>   
	

<div class="feature-two-column margin-left-post <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>">
                                <div class="two-content-wrapper">
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
</div>
    </div>

<div class="feature-two-column <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?> feature-custom">
                                <div class="two-content-wrapper feature-custom-below">
 <h3 class="image-post-title top-none"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
 <?php echo jellywp_post_meta(get_the_ID()); ?>
 <p><?php echo jellywp_post_excerpt(get_the_excerpt('')); ?> </p>
 <a href="<?php the_permalink(); ?>" class="medium btn default read_more"><?php _e('Read More', 'jelly_text_main'); ?></a>
</div>
    </div>


     <div class="clear margin-buttons"></div>
                <?php }else{?>					
				
				<div class="grid_3 grid <?php echo 'margin'.$i;?> <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>">
     <div class="image_post feature-item box-1">
                    <a  href="<?php the_permalink(); ?>"  class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('feature-grid');}
else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/feature-grid.jpg'.'">';} ?>
</a>
                   
                    <div class="caption-overlay">
  					
  
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="inside">
                        <h3><?php the_title(); ?></h3>
                    </a>
                    
                    </div>
                    
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
                    
                     <?php echo jellywp_post_type(); ?>
                     
                  
                </div>
     </div>
				
				<?php }}?>
                
                
              
                
      </div>
        </div>
        </div>
     
        <?php
        wp_reset_query();	
		
	}
	
	    function update($new_instance, $old_instance) {
        return $new_instance;
    }

	
}
