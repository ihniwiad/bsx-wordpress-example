<?php 

include 'variables.php';

?>

			<?php include 'template-parts/html-footer.php'; ?>

			<div class="to-top-wrapper" data-fn="to-top-wrapper">
				<a class="btn btn-secondary btn-only-icon" href="#top"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sr-only"></span></a>
			</div>
		
		</div>

		<?php 
			// photoswipe shadowbox template

			if ( class_exists( 'BsxPhotoswipe001' ) ) {
				$BsxPhotoswipe = new BsxPhotoswipe001;
				if ( method_exists( $BsxPhotoswipe, 'printPhotoswipeShadowboxTemplate' ) ) {
					$BsxPhotoswipe->printPhotoswipeShadowboxTemplate();
				}
			}

		?>
		
		<script src="<?php echo $assetsPath ?>js/vendor<?php if ( ! $isDevMode ) { ?>.min<?php } ?>.js" defer></script>
		<script src="<?php echo $assetsPath ?>js/scripts<?php if ( ! $isDevMode ) { ?>.min<?php } ?>.js" defer></script>

		<?php 
			if ( isset( $_GET[ 'wpadmin' ] ) && $_GET[ 'wpadmin' ] == '0' ) {
				echo '<style>#wpadminbar { display: none; }</style>';
			}
		?>
		<?php wp_footer(); ?>
		
	</body>
	
</html>