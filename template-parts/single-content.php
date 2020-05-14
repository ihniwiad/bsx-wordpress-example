<div class="container below-navbar-content" data-id="single-content">

	<h2 class="blog-post-title"><?php the_title(); ?></h2>

	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>


	<?php 

		// references_fields

		$meta = get_post_meta( $post->ID, 'references_fields', true );

		if ( isset( $meta ) ) {

	?>

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

	<?php 
		}

		// /references_fields
	?>


	<div class="p">
		<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large', [ 'class' => 'img-fluid' ] );
		} ?>
	</div>

	<?php the_content(); ?>

</div>
<!-- /.container.below-navbar-content -->