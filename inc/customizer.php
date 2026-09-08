<?php 
/**
 * Register Hero Section Customizer Controls
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function hello_theme_customizer( $wp_customize ) {

	// 1. Add Hero Section Panel/Section
	$wp_customize->add_section(
		'hello_section',
		array(
			'title'       => __( 'Hello Section', 'hello-theme' ),
			'priority'    => 30,
			'description' => __( 'Customize the layout.', 'hello-theme' ),
		)
	);

	// 2. Title Control
	$wp_customize->add_setting(
		'hero_title',
		array(
			'default'           => get_bloginfo( 'name' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'hero_title',
		array(
			'label'    => __( 'Hero Title', 'hello-theme' ),
			'section'  => 'hero_section',
			'type'     => 'text',
		)
	);
}
add_action( 'customize_register', 'hello_theme_customizer' );

// Sanitization Callback for Select image or video Control example.
function hello_theme_sanitize_bg_type( $input ) {
	$valid = array( 'none', 'image', 'video' );
	return in_array( $input, $valid, true ) ? $input : 'none';
}	