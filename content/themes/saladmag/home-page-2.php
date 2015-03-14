<?php
/*
  Template Name: Home page slider with grid
 */
?>

<?php get_header(); ?>

<div class="row">
  <div class="twelve columns">
  
  
  <div class="slide-large-wrapper">
      <div class="owl_slider slider-large owl-carousel">
               

    <?php
	$cats="";
	$number_slider= of_get_option('slider_number');
	$category_slider= of_get_option('slider_category_select');
	
	$cats = '';
	if(!empty($category_slider)) {
		
	foreach($category_slider as $key=>$value) { if($value == 1) { $cats[] = $key; } }	
	}
	
	
	$post_array = array(
            'showposts' => $number_slider,
            'category__in' => $cats,
			'ignore_sticky_posts' => 1
        );	
        $jellywp_widget = new WP_Query($post_array);
		$i=0;
		 while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
			$i++;
			$post_id = get_the_ID();
			//get all post categories
            $categories = get_the_category(get_the_ID());
			?>
        
 

                <div class="item_slide">
               <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-normal');}
else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/slider-normal.jpg'.'">';} ?>
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
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title()?></a> </h1>
                                                          
<?php echo jellywp_post_type(); ?>
<?php echo jellywp_post_meta(get_the_ID()); ?>
                            
						</div>
                 </div>
               
    <?php }?>        
                
            
                   
              </div>
 </div>
 
       <?php
	$cats_right="";
	$category_slider_right= of_get_option('category_on_right_slider');
	if (of_get_option('number_offset_post_right')){$number_offset_post_right = of_get_option('number_offset_post_right');}else{$number_offset_post_right = 0;}
	
	$cats_right = '';
	if(!empty($category_slider_right)) {
		
	foreach($category_slider_right as $key=>$value) { if($value == 1) { $cats_right[] = $key; } }	
	}
	
	
	$post_array = array(
            'showposts' => 4,
            'category__in' => $cats_right,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset_post_right
        );	
        $jellywp_widget = new WP_Query($post_array);
		$i=0;
		 while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
			$i++;
			$post_id = get_the_ID();
			//get all post categories
            $categories = get_the_category(get_the_ID());
			?>            
     <div class="grid_3 grid grid_nomargin">
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
<?php echo total_score_post_front(get_the_ID());?>  
                    <?php echo jellywp_post_type(); ?>
                                     
                </div>
     </div>
    <?php }?>   
        
        
        
     
    </div>
    </div>


   

<?php if(of_get_option('disable_home_carousel') !=1){?>
<div class="row">
  <div class="twelve columns carousel_header_wrapper">
 <div class="widget-title"><h2><?php echo of_get_option('carousel_post_title');?></h2></div>  
  
 <div class="owl_carousel carousel_header">
 
 
       <?php
	$category_carousel_post="";
	$number_of_carousel= of_get_option('number_carousel');
	$category_carousel= of_get_option('carousel_post');
	if (of_get_option('number_offset_carousel_post')){$number_offset_carousel_post = of_get_option('number_offset_carousel_post');}else{$number_offset_carousel_post = 0;}
	
	if(!empty($category_carousel)) {
		
	foreach($category_carousel as $key=>$value) { if($value == 1) { $category_carousel_post[] = $key; } }	
	}
	
	
	$post_array = array(
            'showposts' => $number_of_carousel,
            'category__in' => $category_carousel_post,
			'ignore_sticky_posts' => 1,
			'offset' => $number_offset_carousel_post
        );	
        $jellywp_widget = new WP_Query($post_array);
		$i=0;
		 while ($jellywp_widget->have_posts()) {
            $jellywp_widget->the_post();
			$i++;
			$post_id = get_the_ID();
			//get all post categories
            $categories = get_the_category(get_the_ID());
			?>         
 <div class="item <?php if(!of_get_option('disable_css_animation')==1){echo "appear_animation";}?>">
 <div class="mediaholder medium image_post feature-item">
                     <a  href="<?php the_permalink();?>" class="feature-link" title="<?php the_title_attribute();?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
</a>
<?php echo total_score_post_front(get_the_ID());?> 
					
                    <?php echo jellywp_post_type(); ?>
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
 <div class="detailholder medium">
 <div class="wrap">

  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="inside carousel_title">
                        <?php the_title(); ?>
                    </a>
<?php echo jellywp_post_meta(get_the_ID()); ?>
  <p><?php echo jellywp_carousel_excerpt(get_the_excerpt('')); ?> </p>
 </div>
 
 
 </div>
 </div>
 <?php }?>     

 
  </div>
  </div>
</div>

<?php }?>

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
