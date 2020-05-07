<?php get_header(); ?>

<div class="row" data-id="page-custom">
	<div class="col-sm-8 blog-main">

		<?php

			$args = array(
				'post_type' => 'custom',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);

			$custom_query = new WP_Query( $args );
			
			while ( $custom_query->have_posts() ) : $custom_query->the_post();

				?>

					<div class="blog-post" data-id="page-custom">

						<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<p class="blog-post-meta">
							<?php the_date(); ?> by 
							<a href="#"><?php the_author(); ?></a> 
							&bull; 
							<a href="<?php comments_link(); ?>">
								<?php 
									printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( get_comments_number() ) ); 
								?>
							</a>
						</p>

						<?php if ( has_post_thumbnail() ) {?>

							<div class="row">
								<div class="col-3 col-md-2">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
								</div>
								<div class="col-9 col-md-10">
									<?php the_excerpt(); ?>
								</div>
							</div>
							
						<?php } else { ?>

							<?php the_excerpt(); ?>

						<?php } ?>

					</div>
					<!-- /.blog-post -->

				<?php

			endwhile;

		?>

	</div>
    <!-- /.col-sm-8.blog-main -->

    <?php get_sidebar(); ?>

</div>
<!-- /.row -->


<?php get_footer(); ?>