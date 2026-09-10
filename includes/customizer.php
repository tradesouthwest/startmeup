<?php
/**
 * Startmeup Theme Customizer
 */
function startmeup_customize_register( $wp_customize ) {

    // Add Blog Layout Section
    $wp_customize->add_section( 'startmeup_blog_options', array(
        'title'       => __( 'Blog Layout Options', 'startmeup' ),
        'priority'    => 30,
        'description' => __( 'Customize the appearance of the blog archive page.', 'startmeup' ),
    ) );

    // Add Setting for Blog Layout
    $wp_customize->add_setting( 'startmeup_blog_layout', array(
        'default'           => 'single-column',
        'sanitize_callback' => 'startmeup_sanitize_blog_layout',
        'type'              => 'theme_mod',
    ) );

    // Add Control for Blog Layout
    $wp_customize->add_control( 'startmeup_blog_layout', array(
        'label'       => __( 'Blog Post Display', 'startmeup' ),
        'section'     => 'startmeup_blog_options',
        'type'        => 'radio',
        'choices'     => array(
            'single-column'  => __( 'Single Column (Stacked)', 'startmeup' ),
            'three-columns'  => __( '3-Column Grid', 'startmeup' ),
        ),
    ) );
}
add_action( 'customize_register', 'startmeup_customize_register' );

/**
 * Sanitize Radio Input Selection
 */
function startmeup_sanitize_blog_layout( $input ) {
    $valid = array(
        'single-column' => __( 'Single Column (Stacked)', 'startmeup' ),
        'three-columns' => __( '3-Column Grid', 'startmeup' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }

    return 'single-column';
}

/**
 * Enqueue Theme Customizer Preview JavaScript (Vanilla JS)
 */
function startmeup_customize_preview_js() {
    wp_enqueue_script(
        'startmeup-customizer-preview',
        get_template_directory_uri() . '/includes/smu-customizer.js',
        array( 'customize-preview' ),
        '1.0.0',
        true
    );
}
add_action( 'customize_preview_init', 'startmeup_customize_preview_js' );