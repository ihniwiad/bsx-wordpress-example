<?php get_header(); ?>

<div class="row" data-id="page-references">
	<div class="col-sm-12 blog-main">

		<?php

			$args = array(
				'post_type' => 'references'
			);

			$references_list = new WP_Query( $args );

			if ( $references_list->have_posts() ) : while ( $references_list->have_posts() ) : $references_list->the_post();
			    
				$meta = get_post_meta( $post->ID, 'references_fields', true ); 

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

						<section>
							<h3>
								Custom field data
							</h3>
							<div>
								<table class="table table-striped">
									<thead class="thead-dark">
										<tr>
											<th class="w-25" scope="col">KEY</th>
											<th scope="col">VALUE</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">text</th>
											<td><?php if ( isset( $meta['text'] ) ) echo $meta['text']; ?></td>
										</tr>
										<tr>
											<th scope="row">textarea</th>
											<td><?php if ( isset( $meta['textarea'] ) ) echo $meta['textarea']; ?></td>
										</tr>
										<tr>
											<th scope="row">checkbox</th>
											<td><?php if ( isset( $meta['checkbox'] ) ) echo $meta['checkbox']; ?></td>
										</tr>
										<tr>
											<th scope="row">select</th>
											<td><?php if ( isset( $meta['select'] ) ) echo $meta['select']; ?></td>
										</tr>
										<tr>
											<th scope="row">image</th>
											<td><?php if ( isset( $meta['image'] ) ) echo $meta['image']; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</section>

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
			endwhile; endif; wp_reset_postdata();
		?>

	</div>
    <!-- /.col-sm-12.blog-main -->

</div>
<!-- /.row -->


<?php get_footer(); ?>