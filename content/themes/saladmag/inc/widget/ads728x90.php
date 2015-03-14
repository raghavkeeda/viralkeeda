<?php
add_action('widgets_init','jellywp_ads728x90_load_widgets');

function jellywp_ads728x90_load_widgets(){
		register_widget("jellywp_ads728x90_widget");
}

class jellywp_ads728x90_widget extends WP_widget{

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function jellywp_ads728x90_widget(){
		$widget_ops = array( 'classname' => 'jellywp_ads728x90_widget', 'description' => __( 'Ads 728x90' , 'jelly_text_main') );
		parent::__construct('jellywp_ads728x90_widget', __('jellywp: Ads 728x90', 'jelly_text_main'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget($args,$instance){
		extract($args);		

		$link = $instance['link'];
		$image = $instance['image'];
		?>
		<div class="widget">
			<div class="ads728x90-thumb">
				<a href="<?php if($link != ""){echo $link;}else{echo "#";} ?>">
					<img src="<?php if($image != ""){echo $image;}else{echo get_template_directory_uri()."/img/728x90_magento.jpg";} ?>" alt="" />
				</a>
			</div> 	
		</div> 
		<?php
	}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];
		
		return $instance;
	}




	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'ADS 728', 'jelly_text_main'), 'link' => '' , 'image' => '' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Link Url:' , 'jellywp' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $instance['link']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e( 'Image Url:' , 'jellywp' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $instance['image']; ?>" />
		</p>
		<?php

	}
}
?>