<?php
add_action( 'widgets_init', 'carousel_widgets' );

function carousel_widgets() {
	register_widget( 'carousel_widget' );
}

class carousel_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
			
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'carousel_post', 
			'description' => __('Display a list of carousel post.', 'jelly_text_main')
		);
    	parent::__construct('rec-carousel-posts', __('jellywp: Carousel Posts', 'jelly_text_main'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'Carousel Articles' : $instance['title'], $instance, $this->id_base);
        if (!$number = absint($instance['number'])){$number = 6;}
        if (!$cats = $instance["cats"]){$cats = '';}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}

        $post_cat_args = array(
            'showposts' => $number,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );

        $post_cat_widget = null;
        $post_cat_widget = new WP_Query($post_cat_args);


        echo $before_widget;

if($instance["title"]!=""){
        echo $before_title;
        echo $instance["title"];
        echo $after_title;
		}

        // Post list in widget
		?><div class="owl_slider slider-large content-sliders owl-carousel sidebar <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>">
        <?php
 
        while ($post_cat_widget->have_posts()) {
            $post_cat_widget->the_post();
			$post_id = get_the_ID();
			//get all post categories
            $categories = get_the_category(get_the_ID());
            ?>
 
                          <div class="item_slide">
              <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>

<?php echo total_score_post_front(get_the_ID());?> 
</a>
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

<div class="item_slide_caption">
						                            
                        	 <h1 class="carousel-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a> </h1>
                             
                            
						</div>

</div>

 
            <?php
        }

        wp_reset_query();

		echo "</div>\n";
        echo $after_widget;
    }

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['cats'] = $new_instance['cats'];
		$instance['number'] = absint($new_instance['number']);
		$instance['number_offset'] = absint($new_instance['number_offset']);
		 
        return $instance;
	}


	
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Carousel Posts';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
		
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'jelly_text_main'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'jelly_text_main'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
         <p><label for="<?php echo $this->get_field_id('number_offset'); ?>"><?php _e('Offset posts:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_offset'); ?>" name="<?php echo $this->get_field_name('number_offset'); ?>" type="text" value="<?php echo $number_offset; ?>" size="3" /></p> 
        
         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Choose your category:', 'jelly_text_main');?> 
            
                <?php
                   $categories=  get_categories('hide_empty=0');
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
        </p>
        
<?php
	}
}
?>
