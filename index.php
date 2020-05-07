<?php get_header(); ?>



<section>

    <div class="container below-navbar-content">

        <h1>Blog</h1>

        <div class="row" data-id="index">
            <main class="col-sm-8 blog-main" id="main">

                <?php
                    if ( have_posts() ) : 

                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/content', get_post_format() );
                        endwhile;

                        ?>
                        <nav>
                            <ul class="pager">
                                <li><?php next_posts_link( 'Previous' ); ?></li>
                                <li><?php previous_posts_link( 'Next' ); ?></li>
                            </ul>
                        </nav>
                        <?php 

                    endif;
                ?>

            </main>
            <!-- /.blog-main -->

            <?php get_sidebar(); ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</section>
<!-- /section (h1) -->



<?php get_footer(); ?>