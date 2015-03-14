<?php
/**
 * bbPress Forum Template 
 */
?>
<?php get_header(); ?>
<?php $GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);  ?>

<section id="content_main" class="clearfix">
<div class="row main_content">

   <!-- Start content -->
    <div class="eight columns" id="content">
 <div <?php post_class('widget_container content_page'); ?>> 
          
          
		<?php if ( ! have_posts() ) : ?>
		<div id="post-0" class="post not-found post-listing">
			<h1 class="post-title"><?php _e( 'Not Found', 'tie' ); ?></h1>
			<div class="entry">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tie' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('post-listing'); ?>>
			<div class="post-inner">
				<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php the_title(); ?></span></h1>
				<div class="entry">
					<?php the_content(); ?>
				</div><!-- .entry /-->
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile;?>
           
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


