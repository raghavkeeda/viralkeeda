<?php
class home_post_two_columns extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Home post two columns',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('home_post_two_columns', $block_options);
	}
	
	
	//create form
	function form($instance) {
        $titles = isset($instance['titles']) ? esc_attr($instance['titles']) : 'Home columns1';
        $title1 = isset($instance['title1']) ? esc_attr($instance['title1']) : 'Home columns2';
        $number_show = isset($instance['number_show']) ? absint($instance['number_show']) : 5;
		$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
		$number_offset1 = isset($instance['number_offset1']) ? absint($instance['number_offset1']) : 0;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'jelly_text_main'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('titles'); ?>" name="<?php echo $this->get_field_name('titles'); ?>" type="text" value="<?php echo $titles; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title for right column:','jelly_text_main'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo $title1; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number_show'); ?>"><?php _e('Number of posts to show:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_show'); ?>" name="<?php echo $this->get_field_name('number_show'); ?>" type="text" value="<?php echo $number_show; ?>" size="3" /></p>
            
         <p><label for="<?php echo $this->get_field_id('number_offset'); ?>"><?php _e('Offset col1 posts:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_offset'); ?>" name="<?php echo $this->get_field_name('number_offset'); ?>" type="text" value="<?php echo $number_offset; ?>" size="3" /></p>  
            
            <p><label for="<?php echo $this->get_field_id('number_offset1'); ?>"><?php _e('Offset col2 posts:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_offset1'); ?>" name="<?php echo $this->get_field_name('number_offset1'); ?>" type="text" value="<?php echo $number_offset; ?>" size="3" /></p>         

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

        <p>
            <label for="<?php echo $this->get_field_id('cats1'); ?>"><?php _e('Choose your category:', 'jelly_text_main'); ?> 

                <?php
                $categories = get_categories('hide_empty=0');
                echo "<br/>";
                foreach ($categories as $cat) {
                    $option = '<input type="checkbox" id="' . $this->get_field_id('cats1') . '[]" name="' . $this->get_field_name('cats1') . '[]"';
                    if (isset($instance['cats1'])) {
                        foreach ($instance['cats1'] as $cats) {
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
		
	
	//create block
	function block($instance) {		
		    extract($instance);
        $titles = apply_filters('widget_title', empty($instance['titles']) ? 'Recent Posts' : $instance['titles'], $instance, $this->id_base);
        $title1 = apply_filters('widget_title', empty($instance['title1']) ? 'Recent Posts' : $instance['title1'], $instance, $this->id_base);
        
        if (!$number_show = absint($instance['number_show'])){$number_show = 5;}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}
		if (isset($instance['number_offset1'])==''){$number_offset1 = 0;}else{$number_offset1 = absint($instance['number_offset1']);}
        if (!isset($instance["cats"])){$cats = '';}
		if (!isset($instance["cats1"])){$cats1 = '';}
     

        // array to call recent posts.

        $jellywp_args = array(
            'showposts' => $number_show,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset
        );

        $jellywp_args1 = array(
            'showposts' => $number_show,
            'category__in' => $cats1,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset1
			);

        $jellywp_widget = null;
        $jellywp_widget = new WP_Query($jellywp_args);



        echo '<div class="widget two_columns_post">';

        $i = 0;
        while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
            $i++;        
			$post_id = get_the_ID(); 
			//get all post categories
            $categories = get_the_category(get_the_ID());
            if ($i == 1) {				
                ?>   

                <div class="feature-two-column margin-left-post">
                   <?php if (!empty($instance['titles'])) {?><div class="widget-title"><h2><?php echo $instance["titles"];?></h2></div><?php }?>
                    <div class="two_col_builder two-content-wrapper medium-two-columns <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>">
                    
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
						foreach( $categories as $tag1) {
							$tag_link1 = get_category_link($tag1->term_id);
							$titleColor1 = categorys_title_color($tag1->term_id, "category", false);
						 echo '<a class="post-category-color" style="background-color:'.$titleColor1.'" href="'.$tag_link1.'">'.$tag1->name.'</a>';					
						}
						echo "</span>";
						}
			 }?>
                   
                    
                     </div>

<div class="wrap_box_style_main feature-custom-below">
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
  <?php echo jellywp_post_meta(get_the_ID()); ?>	
 <p><?php echo jellywp_post_excerpt(get_the_excerpt('')); ?> </p>
   </div>
    </div>
           
                                       
 <div class="wrap_box_style_ul <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>"> 
    <?php echo '<ul class="feature-post-list">'; }else{?>
                 
               

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

  

    <?php }} echo " </ul>";?>
     </div>      
       
        </div>

        <?php
        wp_reset_query();

        // column right      

        $jellywp_widget1 = null;
        $jellywp_widget1 = new WP_Query($jellywp_args1);

        $i = 0;
        while ($jellywp_widget1->have_posts()) {
            $jellywp_widget1->the_post();
            $i++;
			$post_id = get_the_ID();
			//get all post categories
            $categories = get_the_category(get_the_ID());
            if ($i == 1) {				
                ?>   

                <div class="feature-two-column">
                  <?php if (!empty($instance['title1'])) {?><div class="widget-title"><h2><?php echo $instance["title1"];?></h2></div><?php }?>
                     <div class="two_col_builder two-content-wrapper medium-two-columns <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>">
                     
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

<div class="wrap_box_style_main feature-custom-below">
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
  <?php echo jellywp_post_meta(get_the_ID()); ?>	
 
 <p><?php echo jellywp_post_excerpt(get_the_excerpt('')); ?> </p>
 </div>
 </div>
  <div class="wrap_box_style_ul <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>"> 
                   <?php echo '<ul class="feature-post-list">'; }else{?>

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
    <?php }} echo " </ul>";?>
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
