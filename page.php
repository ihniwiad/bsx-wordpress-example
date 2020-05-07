<?php get_header(); ?>

<main id="main">

    <section>

		<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/single-page', get_post_format() );

			endwhile; endif;
		?>

    </section>
    <!-- /section (h1) -->

</main>

<?php get_footer(); ?>