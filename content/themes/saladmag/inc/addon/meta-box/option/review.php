<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'jellywp_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'standard',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Review and Post option', 'jelly_text_main' ),

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => true,

	
	
	
	// List of meta fields
	'fields' => array(
	
	array(
			'name' => 'Enable full width post',
			'id'   => "full_width{$prefix}checkbox",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),

		
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => __( 'Review Description', 'jelly_text_main' ),
			'id'   => "review_{$prefix}wysiwyg",
			'type' => 'wysiwyg',
			// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
			'raw'  => false,
			'std'  => __( ' ', 'jelly_text_main' ),

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => false,
			),
		),
		// review 1
		array(
			'name' => __( 'Review Title 1', 'jelly_text_main' ),
			'id' => "review_option1{$prefix}text",
			'desc' => __( '', 'jelly_text_main' ),
			'type' => 'text',
			'std' => __( ' ', 'jelly_text_main' )
		),
		array(
			'name' => __( 'Review Score 1', 'jelly_text_main' ),
			'id'   => "review_option1{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => __( '', 'jelly_text_main' ),
			'suffix' => __( '', 'jelly_text_main' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 2
		array(
			'name' => __( 'Review Title 2', 'jelly_text_main' ),
			'id' => "review_option2{$prefix}text",
			'desc' => __( '', 'jelly_text_main' ),
			'type' => 'text',
			'std' => __( ' ', 'jelly_text_main' )
		),
		
		array(
			'name' => __( 'Review Score 2', 'jelly_text_main' ),
			'id'   => "review_option2{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => __( '', 'jelly_text_main' ),
			'suffix' => __( '', 'jelly_text_main' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 3
		array(
			'name' => __( 'Review Title 3', 'jelly_text_main' ),
			'id' => "review_option3{$prefix}text",
			'desc' => __( '', 'jelly_text_main' ),
			'type' => 'text',
			'std' => __( ' ', 'jelly_text_main' )
		),
		
		array(
			'name' => __( 'Review Score 3', 'jelly_text_main' ),
			'id'   => "review_option3{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => __( '', 'jelly_text_main' ),
			'suffix' => __( '', 'jelly_text_main' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 4
		
			array(
			'name' => __( 'Review Title 4', 'jelly_text_main' ),
			'id' => "review_option4{$prefix}text",
			'desc' => __( '', 'jelly_text_main' ),
			'type' => 'text',
			'std' => __( ' ', 'jelly_text_main' )
		),
		
		array(
			'name' => __( 'Review Score 4', 'jelly_text_main' ),
			'id'   => "review_option4{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => __( '', 'jelly_text_main' ),
			'suffix' => __( '', 'jelly_text_main' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 5
		array(
			'name' => __( 'Review Title 5', 'jelly_text_main' ),
			'id' => "review_option5{$prefix}text",
			'desc' => __( '', 'jelly_text_main' ),
			'type' => 'text',
			'std' => __( ' ', 'jelly_text_main' )
		),
		
		array(
			'name' => __( 'Review Score 5', 'jelly_text_main' ),
			'id'   => "review_option5{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => __( '', 'jelly_text_main' ),
			'suffix' => __( '', 'jelly_text_main' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
			

	)
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function jellywp_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'jellywp_register_meta_boxes' );
