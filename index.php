<?php 
	$removeLeftMenu = get_post_meta(get_the_ID(),'remove_right_menu', true);
?>
<?php include("head.php"); ?>

<body <?php body_class($class); ?>>

	<?php include("header.php"); ?>

	<div id="main">

		<div class="content">
			<?php
				/* Start the Loop.
				 *
				 * In Twenty Ten we use the same loop in multiple contexts.
				 * It is broken into three main parts: when we're displaying
				 * posts that are in the gallery category, when we're displaying
				 * posts in the asides category, and finally all other posts.
				 *
				 * Additionally, we sometimes check for whether we are on an
				 * archive page, a search page, etc., allowing for small differences
				 * in the loop on each template without actually duplicating
				 * the rest of the loop that is shared.
				 *
				 * Without further ado, the loop:
				 */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<?php 
				 /** FLAGS DEL TEMA MAGIARYM **/
				 $quienesSomos = get_post_custom_values('quienes-somos-side'); 
			?>

			<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

				<?php if ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'twentyten' ) )  ) : ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					<?php else : ?>
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
						</div><!-- .entry-content -->
					<?php endif; ?>

						<div class="entry-utility">
							<?php twentyten_posted_on(); ?>
							<span class="meta-sep">|</span>
							<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
							<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-utility -->
					</div><!-- #post-## -->

			<?php /* How to display all other posts. */ ?>

				<?php else : ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if (!is_page()) { ?>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php } ?>

				<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
				<?php else : ?>
						<?php if ($quienesSomos): ?>
							<div class="quienes-somos__label">
							</div>	
							<div class="quienes-somos__side">
								<?php echo $quienesSomos[0] ?>
								<div class="quienes-somos__footer"></div>
							</div>	
							<div class="quienes-somos__rulin">
								<?php echo get_post_custom_values('rulin')[0]; ?>
							</div>
							<div class="quienes-somos__meterete">
								<?php echo get_post_custom_values('meterete')[0]; ?>
							</div>
						<?php endif; ?>
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->
				<?php endif; ?>

						<div class="entry-utility">
							<?php
								$tags_list = get_the_tag_list( '', ', ' );
								if ( $tags_list ):
							?>
								<span class="tag-links">
									<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
								</span>
								<span class="meta-sep">|</span>
							<?php endif; ?>
						</div><!-- .entry-utility -->
					</div><!-- #post-## -->

				<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

			<?php endwhile; // End the loop. Whew. ?>

		</div>

		<?php //if (!$removeLeftMenu) include("sidebar.php"); ?>		

	</div>


</body>

</html>
