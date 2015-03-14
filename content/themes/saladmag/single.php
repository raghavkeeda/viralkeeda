<?php get_header(); ?>
 <?php $GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);?>
<!-- begin content -->            
<section id="content_main" class="clearfix">
<div class="row main_content">


        <div class="<?php $full= get_post_custom_values('full_widthjellywp_checkbox'); if($full[0]==1){echo "twelve";}else{echo "eight";}?> columns" id="content">
         <div class="widget_container content_page"> 
         
           
                               <!-- start post -->
                    <div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" itemscope="" itemtype="http://schema.org/Review">
                                    
                        <?php if (have_posts()) { while (have_posts()) { the_post(); ?>
                                <?php
                                $categories = get_the_category();
                                $tags = get_the_tags();
                                $post_id = get_the_ID();
                                ?>

                               <div class="single_post_title">
                               <h1 itemprop="name" class="entry-title single-post-title"><?php the_title(); ?></h1>
                                <?php echo jellywp_single_post_meta($post_id);?>
                               </div>
                               <div class="clearfix"></div>
                               
                              <?php if(of_get_option('blog_feautre_image') == 1) { ?>
                              <?php $blog_feautre_image = wp_get_attachment_url( get_post_thumbnail_id($post_id, 'full') ); ?> 
                              <?php if(!empty($blog_feautre_image)) { ?>
                              <img src="<?php echo $blog_feautre_image; ?>" alt="<?php the_title(); ?>" />
                              <?php }}?>
                               
                                <div class="post_content"><?php the_content(); ?></div> 
                                <?php 
 	$defaults_link = array(
		'before'           => '<div class="pagination">' . __( 'Continued On Page:' ),
		'after'            => '</div>',
		'link_before'      => '<span class"box">',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page' ),
		'previouspagelink' => __( 'Previous page' ),
		'pagelink'         => '%',
		'echo'             => 1,
		'highlight'   => 'b'
	);

wp_link_pages( $defaults_link ); ?>
      
                                   <?php  if(of_get_option('disable_post_review') !=1){?>
                               <?php if(total_score_post(get_the_ID())){?>
                                <div class="reviewbox">
                                <div class="review_header"><h3> <span itemprop="itemreviewed"><?php _e('Reviews', 'jelly_text_main'); ?></span></h3></div>
                                  <ul class="progress-bar">
                             
                               <li class="title-score"><span class="review_bar-title"><?php $text1= get_post_custom_values('review_option1jellywp_text'); echo $text1[0]; ?></span><span class="review_score"><?php $text1= get_post_custom_values('review_option1jellywp_slider'); echo $text1[0]; ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php $rate1= get_post_custom_values('review_option1jellywp_slider'); echo $rate1[0] * 10; ?>%"></div>
                                    </li>
                                    
                               <li class="title-score"><span class="review_bar-title"><?php $text2= get_post_custom_values('review_option2jellywp_text'); echo $text2[0]; ?></span><span class="review_score"><?php $text2= get_post_custom_values('review_option2jellywp_slider'); echo $text2[0]; ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php $rate2= get_post_custom_values('review_option2jellywp_slider'); echo $rate2[0] * 10; ?>%"></div>
                                    </li>
                                    
                                    
                                  <li class="title-score"><span class="review_bar-title"><?php $text3= get_post_custom_values('review_option3jellywp_text'); echo $text3[0]; ?></span><span class="review_score"><?php $text3= get_post_custom_values('review_option3jellywp_slider'); echo $text3[0]; ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php $rate3= get_post_custom_values('review_option3jellywp_slider'); echo $rate3[0] * 10; ?>%"></div>
                                    </li>
                                
                                 <li class="title-score"><span class="review_bar-title"><?php $text4= get_post_custom_values('review_option4jellywp_text'); echo $text4[0]; ?></span><span class="review_score"><?php $text4= get_post_custom_values('review_option4jellywp_slider'); echo $text4[0]; ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php $rate4= get_post_custom_values('review_option4jellywp_slider'); echo $rate4[0] * 10; ?>%"></div>
                                    </li>         
                                    
                                   <li class="title-score"><span class="review_bar-title"><?php $text5= get_post_custom_values('review_option5jellywp_text'); echo $text5[0]; ?></span><span class="review_score"><?php $text5= get_post_custom_values('review_option5jellywp_slider'); echo $text5[0]; ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php $rate5= get_post_custom_values('review_option5jellywp_slider'); echo $rate5[0] * 10; ?>%"></div>
                                    </li>
                                    
                                    
                                              
                           <?php $total_review = total_score_post(get_the_ID())?>
                          
                              
                              <li class="review_bar total-review-bar">
                                  <div class="total_review_bar-content"><?php echo round($total_review / 5 ,1);?> <p class="score-label">Score</p></div>
                                  <span class="review_bar-title"> <?php if($review_summer = get_post_custom_values('review_jellywp_wysiwyg')){?>
                                <div class="review-summery">
                                 <?php echo $review_summer[0]; ?>
                                  </div>
                                  <?php }?></span>
                                  </li>
                              
                                </ul>
                                
                <div itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
                  <meta itemprop="worstRating" content = "1">
                  <meta itemprop="ratingValue" content = "<?php echo round($total_review / 10 ,1);?>">
                  <meta itemprop="bestRating" content = "5">
                </div>	
								
                             <div class="clearfix"></div>   
                                
                                     
                                 </div>
                                 
                                <?php }}?>

                                
                                
                                <hr class="none" />
                                 <?php  if(of_get_option('disable_post_tag') !=1){?>
                                <div class="tag-cat">                                                               
                                   <?php if (!empty($tags)){ ?><?php the_tags('', ' '); ?> <?php } ?>                                                          
                                </div>
                            <?php }?>
                                
              <div class="clearfix"></div>
                                
                 <?php  if(of_get_option('disable_post_share') !=1){?>         
                          
                            <div class="share-post">
                                 <ul>                                                
<!-- <li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="" data-lang="en">tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li> 

<li><script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php echo get_permalink(); ?>" data-counter="right"></script></li>     

<li style="width:80px;"><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script><a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;media=<?php $fullimage = wp_get_attachment_url( get_post_thumbnail_id($post_id, 'full') ); if(!empty($fullimage)) {echo $fullimage;}?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="http://assets.pinterest.com/img/PinExt.png" title="Pin It"/></a></li> -->
                              <li>
<div id="fb-root"></div>
<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="<?php echo get_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
</li>                                   
<li>
<div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
			<script type='text/javascript'>
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
</li>             
              </ul>
             <div class="clearfix"></div>
             
              </div>
                   <?php }?>         
                           
                            <div class="postnav">
                                       
                            <span class="left">
                                <?php
                                $next_post = get_next_post();
								
                                if (!empty($next_post)){
									
                                    ?>
                                   <i class="fa fa-angle-double-left"></i>
                                    <a href="<?php echo get_permalink($next_post->ID); ?>" id="prepost"><span><?php _e('Previous Post', 'jelly_text_main'); ?></span><?php echo $next_post->post_title; ?></a>

                                <?php } ?>
                                </span>
                                
                                <span class="right">

                                <?php
								
                                $prev_post = get_previous_post();
                                if (!empty($prev_post)){
								
                                    ?>
                                    <i class="fa fa-angle-double-right"></i>
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>" id="nextpost"><span><?php _e('Next Post', 'jelly_text_main'); ?></span><?php echo $prev_post->post_title; ?></a>
                                <?php } ?>
                                </span>
                                
                                
                                
                            </div>
               
                            <hr class="none">
                        
                        
                            
                             <?php  if(of_get_option('disable_post_author_box') !=1){?>     
                            <div class="auth">
                            <div class="author-info">                                       
                                 <div class="author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'), 90); ?></div> 
                                    <div class="author-description"><h5><a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></h5>
                                <p><?php echo get_the_author_meta('description'); ?></p>
                                
                                      <ul class="author-social clearfix">
                              
                               
                                <?php if ((get_the_author_meta('url')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('url'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/website.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('email')) != ''){ ?>
                               <li><a href="mailto:<?php echo get_the_author_meta('email'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/email.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('linkedin')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('linkedin'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/link.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('rss')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('rss'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/rss.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('pinterest')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('pinterest'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/pin.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('devianart')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('devianart'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/d-art.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('dribble')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('dribble'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/dribble.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('behance')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('behance'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/behance.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('youtube')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('youtube'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png"></a></li>
                               <?php }?>
                                
								<?php if ((get_the_author_meta('instagram')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('instagram'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/instagram.png"></a></li>
                               <?php }?>
                              
                                <?php if ((get_the_author_meta('twitter')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('twitter'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('facebook')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('facebook'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('googleplus')) != ''){ ?>
                               <li><a href="<?php echo get_the_author_meta('googleplus'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/google-plus.png"></a></li>
                               <?php }?>
                               </ul>
                                </div>
                                 </div>
                            </div>
                            <?php } ?>
                            
                            <?php } ?>
                            
                        <?php } // end of the loop.   ?>                    

                  
 <?php  if(of_get_option('disable_post_related') !=1){?>  
                    <div class="related-posts">
                      
                      <div class="widget-title"><h2><?php _e('Related articles', 'jelly_text_main'); ?></h2></div>
                      <div class="clearfix"></div>
                       

                        <?php
                        $jellywp_tags = null;
                        if (!empty($tags)) {
                            foreach ($tags as $tag) {
                                $jellywp_tags[] = $tag->term_id;
                            }
                        };
                        $arg_tag = array('tag__in' => $jellywp_tags, 'showposts' => 3, 'post__not_in' => array($post_id));
                        $post_query = null;
                        $post_query = new WP_Query($arg_tag);
						$post_count = 0;
                        echo "<ul>";


                        while ($post_query->have_posts()) {
                            $post_query->the_post();
							$post_id = get_the_ID();
							$last = '';
							if (++$post_count  == 3) {
				$last = 'class="last-post"';
			}
                            ?>
                            <li <?php echo $last; ?>>
                                <?php            						
                                echo '<a  class="entry-thumb feature-link" href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '">';
                               if ( has_post_thumbnail()) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'feature-grid' );
							    ?>
 <img src="<?php echo $image[0]; ?>" />
<?php }else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/feature-grid.jpg'.'">';} ?>
 </a>
                               
                                   <h4> <a class="title related-title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>">
									<?php the_title(); ?>
                                   </a></h4>
                                 
                             
                              
                            </li>
                            <?php
                        }

                        wp_reset_query();

                        echo "</ul>";
                        ?>

                    </div>                  
              <?php } ?>
               
               
               			
					<hr class="none" />

                    <!-- comment -->
                    
                   <?php echo do_shortcode('[fbcomments]'); ?> 
                    </div>
                  <!-- end post --> 


            
            
        <div class="brack_space"></div>
        </div>
        </div>
        
       <?php $full= get_post_custom_values('full_widthjellywp_checkbox'); if($full[0]==1){}else{?>
            <div class="four columns" id="sidebar">  
<?php
				$custom_sidebar = $GLOBALS['sbg_sidebar'][0];
				
				$post_sidebar = of_get_option('post_sidebar','');	
				if(!empty($post_sidebar)) {
					$custom_sidebar = $post_sidebar;
				};				
				
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

?><div class="brack_space"></div>
          
       </div>
       <?php }?>
      
       
       
        
    
</div>
 </section>
<!-- end content --> 
<?php get_footer(); ?>


