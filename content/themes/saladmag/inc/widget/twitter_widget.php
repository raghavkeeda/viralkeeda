<?php
add_action( 'widgets_init', 'twitter_widgets' );

function twitter_widgets() {
	register_widget( 'twitter_widget' );
}

class twitter_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
			
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'twitter_feed', 
			'description' => __('Display twitter feed.', 'jelly_text_main')
		);
    	parent::__construct('twitter-widget', __('jellywp: Twitter Widget', 'jelly_text_main'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'Twitter widget' : $instance['title'], $instance, $this->id_base);
		$twitter_username = apply_filters('widget_title', empty($instance['twitter_username']) ? '' : $instance['twitter_username'], $instance, $this->id_base);
        if (!$items = absint($instance['items'])){$items = 6;}
		
		$consumer_key = of_get_option("twitter_api_key");
		$consumer_secret = of_get_option("twitter_api_secret");
		$access_token = of_get_option("twitter_access_token");;
		$access_token_secret = of_get_option("twitter_access_token_secret");

        echo $before_widget;

if($instance["title"]!=""){
        echo $before_title;
        echo $instance["title"];
        echo $after_title;
		}
		
		if(!empty($items) && !empty($twitter_username))
		{
			// Begin get user timeline
			include_once (get_template_directory() . "/inc/addon/twitter.lib.php");
			$obj_twitter = new Twitter($twitter_username); 
			$obj_twitter->consumer_key = $consumer_key;
			$obj_twitter->consumer_secret = $consumer_secret;
			$obj_twitter->access_token = $access_token;
			$obj_twitter->access_token_secret = $access_token_secret;
			
			$tweets = $obj_twitter->get($items);

			if(!empty($tweets))
			{
			
				echo '<ul class="twitter_widget_feed">';
				
				foreach($tweets as $tweet)
				{
					echo '<li>';
					
					if(isset($tweet['text']))
					{
						echo $tweet['text'];
					}
					
					echo '</li>';
				}
				
				echo '</ul>';
			}
		}
		
		
		echo $after_widget;
		}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_username'] = strip_tags($new_instance['twitter_username']);
		$instance['items'] = strip_tags($new_instance['items']);
		 
        return $instance;
	}


	
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Twitter widget';
		$twitter_username = isset($instance['twitter_username']) ? esc_attr($instance['twitter_username']) : 'envato';
		$items = isset($instance['items']) ? absint($instance['items']) : 3;
		
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'jelly_text_main'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                        
       <p>
				<label for="<?php echo $this->get_field_id('twitter_username'); ?>">Twitter Username: <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $twitter_username; ?>" /></label>
			</p>
            
       <p>
				<label for="<?php echo $this->get_field_id('items'); ?>">Items (default 5): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo $items; ?>" /></label>
			</p>
                 
        
<?php
	}
}
?>
