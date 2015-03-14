<?php
add_action( 'widgets_init', 'jellywp_recent_comments_widgets' );

function jellywp_recent_comments_widgets() {
	register_widget( 'jellywp_recent_comments_widget' );
}

class jellywp_recent_comments_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function jellywp_recent_comments_widget() {
		$widget_ops = array( 'classname' => 'post_list_widget comment_widget', 'description' => __('Displays recent comments.', 'jelly_text_main') );
		$this->WP_Widget( 'jellywp_recent_comments_widget', __('jellywp: Recent Comments', 'jelly_text_main'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget( $args, $instance ) {
		
		extract( $args );
	    $title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
  
       ?>
       <?php
	   $entries_display = $instance['entries_display']; ?>
	    <div class="widget_container">
        <ul class="post_list">
            <?php 
                $args = array(
                       'status' => 'approve',
                        'number' => $entries_display
					);	
				
				$postcount=0;
                $comments = get_comments($args);
				
                foreach($comments as $comment) :
						$postcount++;								
                        $commentcontent = strip_tags($comment->comment_content);			
                        if (strlen($commentcontent)> 50) {
                            $commentcontent = mb_substr($commentcontent, 0, 49) . "...";
                        }
                        $commentauthor = $comment->comment_author;
                        if (strlen($commentauthor)> 30) {
                            $commentauthor = mb_substr($commentauthor, 0, 29) . "...";			
                        }
                        $commentid = $comment->comment_ID;
                        $commenturl = get_comment_link($commentid); ?>
                      <li class="clearfix">
							<a class="img_thumbnail"><?php echo get_avatar( $comment, '65' ); ?></a>
									
                                  <h4 class="list_title"><a class="post-title <?php if($postcount==1) { ?> first<?php } ?>" href="<?php echo $commenturl; ?>"> <?php echo $commentauthor; ?></a></h4>
						           <br />
								<p class="post-meta">
									 <?php echo $commentcontent; ?>
											         </p>
                                                    
                     </li>
            <?php endforeach; ?>
        </ul>
        </div>
		
	   <?php
		
		echo $after_widget;
	}



	function form( $instance ) {
		$defaults = array('title' => 'Recent Comments', 'entries_display' => 5);
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'jellywp'); ?></label>
        <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><?php _e('How many entries to display?', 'jellywp'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>
 		
	<?php
	}
}
?>