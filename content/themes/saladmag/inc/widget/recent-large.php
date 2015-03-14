<?php
add_action('widgets_init', 'recent_large__widgets');

function recent_large__widgets() {
    register_widget('recent_large_widgets');
}

class recent_large_widgets extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

    function __construct() {
        $widget_ops = array(
            'classname' => 'main_post_style clearfix',
            'description' => __('Display post list on menu or widget.', 'jelly_text_main')
        );
        parent::__construct('recent-post-large-style', __('jellywp: Recent post large', 'jelly_text_main'), $widget_ops);
    }

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
    function widget($args, $instance) {

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);
    
        if (!$number = absint($instance['number'])){$number = 4;}
        if (!$cats = $instance["cats"]){$cats = '';}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}

        // array to call recent posts.

        $jellywp_args = array(
            'showposts' => $number,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );

        $jellywp_widget = null;
        $jellywp_widget = new WP_Query($jellywp_args);

        echo $before_widget;

        // Widget title

        echo $before_title;
        echo $instance["title"];
        echo $after_title;

        // Post list in widget

       ?>
		<div class="widget_container">
        <?php
        while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
			$post_id = get_the_ID();
			//get all post categories
            $categories = get_the_category(get_the_ID());
          
           
                ?>   

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

<div class="wrap_box_style_main image-post-title">
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
<?php echo jellywp_post_meta(get_the_ID()); ?>
</div> 
    </div>
 
            
               
            
                <?php }?>
            
 
        
        </div>
      
        <?php
        wp_reset_query();


        echo $after_widget;
    }

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['cats'] = $new_instance['cats'];
        $instance['number'] = absint($new_instance['number']);
		$instance['number_offset'] = absint($new_instance['number_offset']);

        return $instance;
    }


    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 4;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'jelly_text_main'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
 <p><label for="<?php echo $this->get_field_id('number_offset'); ?>"><?php _e('Offset posts:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_offset'); ?>" name="<?php echo $this->get_field_name('number_offset'); ?>" type="text" value="<?php echo $number_offset; ?>" size="3" /></p> 

   <p>
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
        </p>

        <?php
    }

}
?>
