<section id="content_main" class="clearfix">
<div class="row main_content">

  <div class="eight columns" id="content">
        <div class="widget_container content_page">  
            
            
              
    <?php
                    if (is_search()) {
                        echo '<h3 class="categories-title title">';
                        _e('Search for: ', 'jelly_text_main');
                        the_search_query();
                        echo '</h3>';
                    }else if(is_category() ) {
							echo '<h3 class="categories-title title">';
							_e('Category: ', 'jelly_text_main');
							 single_cat_title('', true);
							echo '</h3>';
					} else if(is_author() ) {
							echo '<h3 class="categories-title title">';
							_e('Author: ', 'jelly_text_main');
							 the_author();
							echo '</h3>';
					}else if(is_tag() ) {
							echo '<h3 class="categories-title title">';							
							_e('Tag: ', 'jelly_text_main');
							 the_tags('');
							echo '</h3>';
					}
   ?>
                    <div class="post_list_medium_widget">
                    <div>
                    
                    <?php if (have_posts()){ 
						$row_count=0; 
						while (have_posts()){ the_post(); 
                        $row_count++;
						 $post_id = get_the_ID();
						 //get all post categories
            $categories = get_the_category(get_the_ID());
				?>
                            <div <?php if(!of_get_option('disable_css_animation')==1){?><?php post_class('feature-two-column medium-two-columns appear_animation'); ?><?php }else{?> <?php post_class('feature-two-column medium-two-columns'); ?> <?php }?><?php if($row_count % 2 != 0){echo ' id="margin-left-post-'.$row_count.'"';}?>>
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
 <h3 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
<?php echo jellywp_post_meta(get_the_ID()); ?>
<p><?php echo jellywp_post_excerpt(get_the_excerpt('')); ?> </p>
 </div>
    </div>

                        <?php } ?>
                    <?php }else{ ?>       
                        <?php
                        if (is_search()) {
                            _e('No result found', 'jelly_text_main');
                        }
                        ?>                   
                    <?php } ?>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
                   <?php jellywp_pagination(); ?>  
            
                  
  </div></div>
        
 
          <div class="four columns" id="sidebar">
<?php

			
				
				 $ge_sidebar = '';
				if(is_category() ) {
						
						$category = get_the_category();						
						
						$cn_sidebar ='';
						foreach($category as $ca_id) {
							if(empty($cn_sidebar)) { $cn_sidebar = of_get_option('cat_'.$ca_id->term_id);}								
							
						}
						
						if(empty($cn_sidebar)) {
							$ge_sidebar = of_get_option('category_sidebar','');
						} else { $ge_sidebar = $cn_sidebar; }
						
						
					}else if(is_tag() ) {
						
						$tags = get_the_tags();						
						
						$cn_sidebar ='';
						foreach($tags as $tg_id) {
							if(empty($cn_sidebar)) { $cn_sidebar = of_get_option('tag_'.$tg_id->term_id);}								
						}
						 
						if(empty($cn_sidebar)) {
							$ge_sidebar = of_get_option('tag_sidebar','');
						} else { $ge_sidebar = $cn_sidebar; }
					}				
					
					
					
				$custom_sidebar ='';
				if(!empty($ge_sidebar)) {	$custom_sidebar = $ge_sidebar;	};				
				
				foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 
				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
					
					
?>  
       </div>
       
    <div class="clearfix"></div>
        

</div>
 </section>
<!-- end content --> 