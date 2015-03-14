<?php
/*
  The main template file for display page
 */
?>
<?php get_header(); ?>
<?php $GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);  ?>

<section id="content_main" class="clearfix">
<div class="row main_content">

   <!-- Start content -->
    <div class="eight columns" id="content">
 <div <?php post_class('widget_container content_page'); ?>> 
          
          
           <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <h1 class="single-post-title page-title"><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                                
                                 
                        <?php endwhile; // end of the loop.  ?>
                    <?php endif; ?>
           
<div class="brack_space"></div>
        </div>

  </div>
  <!-- End content -->
   
    <!-- Start sidebar -->
	<div class="four columns" id="sidebar"> 

                <?php
				
				if(isset($GLOBALS['sbg_sidebar'][0])){
					$custom_sidebar = $GLOBALS['sbg_sidebar'][0];
					
					$page_sidebar = of_get_option('page_sidebar','');	
					if(!empty($page_sidebar)) {
						$custom_sidebar = $page_sidebar;
					}
				
					foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $dyn_side = $sidebar['id'];
						}
					} 
				}			

				if(isset($dyn_side)) {
					
					if (is_active_sidebar($dyn_side)) { dynamic_sidebar($dyn_side);}
	
				} else{
					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar'); }
				}					
				
				
?>
  </div>
  <!-- End sidebar -->

          

</div>
 </section>
<!-- end content --> 

<?php get_footer(); ?>


