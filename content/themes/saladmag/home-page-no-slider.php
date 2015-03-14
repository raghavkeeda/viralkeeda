<?php
/*
  Template Name: Home page no slider header
 */
?>

<?php get_header(); ?>
   

<?php get_header(); ?>
   


<!-- Start content -->

<div class="row main_content">
<div class="content_wraper">
   <!-- Start content -->
     <div class="eight columns" id="content">
            
			  <?php if (have_posts()) {
				   while (have_posts()) { the_post();
			   the_content();
			   }}
            ?>


  </div>
  <!-- End content -->
  
  
    <!-- Start sidebar -->
	<div class="four columns" id="sidebar">
<?php
 if (have_posts()) : while (have_posts()) : the_post();
 $GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);
 endwhile;
 endif;
				$custom_sidebar = $GLOBALS['sbg_sidebar'][0];
				
				
				
				foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 
				if($custom_sidebar) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}					
?>
  </div>
  <!-- End sidebar -->
  <div class="clearfix"></div>
  </div>
  
  </div>

<?php get_footer(); ?>
