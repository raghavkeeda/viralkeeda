<?php
/*
  Template Name: Page Fullwidth
 */
?>
<?php get_header(); ?>
<section id="content_main" class="clearfix">
<div class="row main_content">
<!-- begin content -->        
<div <?php post_class('page-full twelve columns'); ?> id="post-<?php the_ID(); ?>">  
 <div class="content_page_padding">    

                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <h1 class="single-post-title page-title"><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                    <?php endwhile; // end of the loop.    ?>
                <?php endif; ?>
      </div>
      <div class="brack_space"></div>
      </div>
  </div> 
  </section>
<?php get_footer(); ?>