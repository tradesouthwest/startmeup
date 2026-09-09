<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "main" tag.
 *
 * @package hello theme
 * @since   1.0
 */

?><!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" aria-label="first content" 
        href="#sitecontent">
        <?php esc_html_e( 'Skip to content', 'hello-theme' ); ?>
    </a>
        <header class="page-header">
            <div class="site-logo">
            <?php 
            if( has_custom_logo() ) : ?>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                   rel="bookmark"><?php echo wp_kses_post( force_balance_tags( startmeup_theme_custom_logo() ) ); ?></a>
           
            <?php 
                endif; ?>

                <div class="page-header-inner">
                    <div class="hgroup-header">
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <div class="site-description">
                            
                            <?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?>
                    
                        </div>
                    </div>
                </div>
            </div>
        <!-- nav or top section can go here -->
            <nav class="page-nav-wrapper" aria-label="Primary" style="[for toggle]">
                <div id="page_nav" class="nav-wrapper">

                    <div class="nav-button-wrapper">
                        <div id="nav_button" class="nav-button-top">
                            <label><span>|</span><span>|</span><span>|</span>
                            <input type="hidden" name="open_menu" class="open-menu" value="false">
                            <input id="open_menu" type="checkbox" name="open_menu" 
                            class="open-menu" role="button" ></label>
                        </div>
                    </div>
                    
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'primary-menu',
                        'depth'          => 3,
                        'container'     => 'div',
                        'menu_class'   => 'page-nav',
                        'fallback_cb' => 'wp_page_menu',
                    )
                ); ?>
                    </details>
                </div>
            </nav>
        </header>
        