<?php
/**
 * Index template Mostly used for blog page.
 *
 * @package Hello Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <section id="sitecontent" class="index-page-body">

        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope 
                itemtype="https://schema.org/Article">
            <?php 
            if ( is_home() || ( is_category() || is_archive() ) ) { ?>

            <div class="post-content">
				<header class="excerpt-header">
                    
                    <?php the_title(
                        sprintf( '<h2 class="post-title h4"><a href="%s" rel="bookmark">', 
                            esc_attr( esc_url( get_permalink() ) ) 
                            ), '</a></h2>' ); ?>
                    
                    <?php 
                    if ( has_post_thumbnail() ) { ?>
                    
                        <figure class="linked-attachment-container-sm">
                            <div class="inner-featured-image">
                            <?php 
                            the_post_thumbnail( 'startmeup-featured', array( 
                                'itemprop' => 'image', 
                                'class'  => 'startmeup-featured',
                                'alt'  => get_the_title()
                                ) 
                            ); ?>
                            </div>
                        </figure>
                    
                    <?php 
                    } // end if post thumbnail ?>

                </header>
	
                        <div class="inner_content">

                            <?php 
                            the_excerpt(); ?>
                            
                            <div class="after-excrpt">
                    
                                <p class="after-cats"><span><small><?php esc_html_e('Categorized as: ', 'tinydancer'); ?></small></span> <small><em><?php the_category( ' &bull; ' ); ?></em></small>
                                 / <small><em class="excerpt_footer-date">
                                <?php printf( esc_attr( get_the_date() ) ); ?></em></small></p>
               
                            </div>

                <?php 
                } else {  // display full content if not archive etc. 
                ?>
                
                    <?php the_content( '', true ); ?>
                
                <?php 
                } // Ends is blog or archive 
                ?>

                </div>
			</div>

		</article>

		<?php 
        endwhile; ?>

            <?php 
            // Blog posts pagination goes AFTER the loop ends
            if ( function_exists( 'startmeup_blog_pagination' ) ) {
                startmeup_blog_pagination();
            } ?>

        <?php else : ?>
        <div class="post-content">
            
            <?php echo esc_url( home_url('/') ); ?>
        
        </div>

        <?php 
        endif; ?>

	</section>
        <aside class="blog-sidebar">
    
            <?php get_sidebar(); ?>

        </aside>
</main>
<?php get_footer(); ?>