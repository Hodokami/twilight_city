<?php
	
	if ( get_theme_mod('related-posts-on', true) ) : 
	 
	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Posts query arguments.
	$query = array(
		'post__not_in' => array( get_the_ID() ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 3,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'neira_lite_related_posts_args', $query );

	// The post query
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) : $i = 1; ?>

		<div class="entry-related clear">
			<h3><?php esc_html_e('You May', 'neira-lite'); ?> <span><?php esc_html_e('Also Like', 'neira-lite'); ?></span></h3>
			<div class="related-loop clear">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<?php
					$class = ( 0 == $i % 3 ) ? 'hentry last' : 'hentry';
					?>
					<div class="<?php echo esc_attr( $class ); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>">
								<div class="thumbnail-wrap">
									<?php 
										the_post_thumbnail('neira_lite_related_post');
									?>
								</div><!-- .thumbnail-wrap -->
							</a>
						<?php else : ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>" rel="bookmark">
								<div class="thumbnail-wrap">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/no-thumbnail.png" alt="<?php esc_attr_e( 'No Picture', 'neira-lite');?>"/>
								</div><!-- .thumbnail-wrap -->
							</a>
						<?php endif; ?>				
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a></h2>
					</div><!-- .grid -->
				<?php $i++; endwhile; ?>
			</div><!-- .related-posts -->
		</div><!-- .entry-related -->

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

	endif;
?>