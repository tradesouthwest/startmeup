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

            <div class="post-content">
				<header class="excerpt-header">
                    
                    <?php the_title(
                        sprintf( '<h2 class="post-title h4"><a href="%s" rel="bookmark">', 
                            esc_attr( esc_url( get_permalink() ) ) 
                            ), '</a></h2>' ); ?>

                </header>
					 <div class="inner_content">

                <?php if ( is_home() || ( is_category() || is_archive() ) ) { ?>
                    
                    <?php if ( has_post_thumbnail() ) { ?>
                    
                    <div class="maxheight-sm">

                        <?php //do_action( 'tinydancer_excerpt_attachment' ); ?>
thimbnail
                    </div>

                    <?php the_excerpt(); ?>
                    <?php } else { ?>

                        <?php the_excerpt(); ?>

                    <?php 
                    } // Ends if has thumbnail ?>

                    <div class="after-excrpt">
                    
                    <p class="after-cats"><span><small><?php esc_html_e('Categorized as: ', 'tinydancer'); ?></small></span> <small><em><?php the_category( ' &bull; ' ); ?></em></small></p>
               
                    </div>
                    
                    <?php } else { ?>
                
                    <?php the_content( '', true ); ?>
                
                <?php 
                } // Ends is blog or archive ?>

                </div>
			</div>
		</article>

		<?php 
        endwhile; ?>
			<?php 
			endif; ?>

	</section>
        <aside class="blog-sidebar">
    
            <?php get_sidebar(); ?>

        </aside>
</main>
<?php get_footer(); ?>