<?php 

	// prepare header config 
	$headerConfig = array(
		'logo' => array(
			'filePath' => $headerLogoFilePath,
			'alt' => $headerLogoAlt,
			'width' => $headerLogoWidth,
			'height' => $headerLogoHeight
		)
	);

	// print header
	/*
	if ( class_exists( 'BsxAppNavExampleNav001' ) ) {
		$BsxAppNavigation = new BsxAppNavExampleNav001;
		if ( method_exists( $BsxAppNavigation, 'printExampleHeader' ) ) {
			$BsxAppNavigation->printExampleHeader( $headerConfig );
		}
	}
	*/

	/*

			<header class="bsx-appnav-navbar bsx-appnav-fixed-top" data-fn="anchor-offset-elem" data-tg="sticky-container-below">

				<nav class="bsx-appnav-navbar-container">

					<button class="bsx-appnav-navbar-toggler" id="toggle-navbar-collapse" type="button" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" data-fn="toggle" data-fn-target="[data-tg='navbar-collapse']" data-tg="dropdown-multilevel-excluded">
						<span class="sr-only">Menu</span>
						<i class="fa fa-navicon" aria-hidden="true"></i>
					</button>

					<a class="bsx-appnav-navbar-brand" href="#">
						<img src="<?php echo $headerLogoFilePath ?>" alt="<?php echo $headerLogoAlt ?>" width="<?php echo $headerLogoWidth ?>" height="<?php echo $headerLogoHeight ?>">
					</a>

					<!--

					TODO: mark current nav item for sr
						<span class="sr-only">(current)</span>

					-->

					<div class="bsx-appnav-navbar-collapse" id="navbarNavDropdown" data-tg="navbar-collapse">

						<?php 
							if ( class_exists( 'BsxAppNavExampleNav001' ) ) {
								$BsxAppNavigation = new BsxAppNavExampleNav001;
								if ( method_exists( $BsxAppNavigation, 'printLargeExampleNav' ) ) {
									$BsxAppNavigation->printLargeExampleNav();
								}
							}
						?>

					</div>

					<div class="bsx-appnav-collapse-backdrop" data-fn="remote-event" data-fn-target="#toggle-navbar-collapse" data-tg="dropdown-multilevel-excluded"></div>

					<?php 
						if ( class_exists( 'BsxAppNavExampleNav001' ) ) {
							$BsxAppNavigation = new BsxAppNavExampleNav001;
							if ( method_exists( $BsxAppNavigation, 'printExampleIconNav' ) ) {
								$BsxAppNavigation->printExampleIconNav();
							}
						}
					?>

				</nav>
			
			</header>
			
	*/
?>

<header class="bsx-appnav-navbar bsx-appnav-fixed-top" data-fn="anchor-offset-elem" data-tg="sticky-container-below">

	<nav class="bsx-appnav-navbar-container">

		<button class="bsx-appnav-navbar-toggler" id="toggle-navbar-collapse" type="button" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" data-fn="toggle" data-fn-target="[data-tg='navbar-collapse']" data-tg="dropdown-multilevel-excluded">
			<span class="sr-only">Menu</span>
			<i class="fa fa-navicon" aria-hidden="true"></i>
		</button>

		<a class="bsx-appnav-navbar-brand" href="<?php echo get_bloginfo( 'url' ) . '/'; ?>">
			<img src="<?php echo $headerLogoFilePath ?>" alt="<?php echo $headerLogoAlt ?>" width="<?php echo $headerLogoWidth ?>" height="<?php echo $headerLogoHeight ?>">
		</a>

		<!--

		TODO: mark current nav item for sr
			<span class="sr-only">(current)</span>

		-->

		<div class="bsx-appnav-navbar-collapse" id="navbarNavDropdown" data-tg="navbar-collapse">



			
			<ul class="bsx-appnav-navbar-nav bsx-main-navbar-nav" aria-labelledby="navbarDropdownMenuLink-0">




                <!-- Bsx_Walker_Page -->

                <?php 
                    wp_list_pages(
                        array(
                            'match_menu_classes' => true,
                            'show_sub_menu_icons' => true,
                            'title_li' => false,
                            'walker'   => new Bsx_Walker_Page(),
                        )
                    );
                ?>

				<!--
			    <li class="bsx-appnav-desktop-hidden">
			        <a class="" href="#"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<span class="sr-only">Home</span></a>
			    </li>
				<li class="">
					<a class="bsx-appnav-dropdown-toggle" id="navbarDropdownMenuLink-a0" href="#" data-fn="dropdown-multilevel" aria-haspopup="true" aria-expanded="false">Lorem ipsum</a>
					<ul class="" aria-labelledby="navbarDropdownMenuLink-a0">
						<li class="bsx-appnav-back-link">
							<a class="" href="#" aria-label="Menüebene schließen" data-label="Zurück" data-fn="dropdown-multilevel-close"></a>
						</li>
						<li class="">
							<a class="bsx-appnav-dropdown-toggle" id="navbarDropdownMenuLink-a0a" href="#" data-fn="dropdown-multilevel" aria-haspopup="true" aria-expanded="false">Aliquam lorem</a>
							<ul class="" aria-labelledby="navbarDropdownMenuLink-a0a">
								<li class="bsx-appnav-back-link">
									<a class="" href="#" aria-label="Menüebene schließen" data-label="Zurück" data-fn="dropdown-multilevel-close"></a>
								</li>
								<li>
									<a class="" href="#">Ante in</a>
								</li>
								<li class="">
									<a class="" href="#">Dapibus</a>
								</li>
								<li>
									<a class="" href="#">Viverra quis</a>
								</li>
								<li>
									<a class="" href="#">Feugiat a</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				-->



			</ul>




		</div>

		<div class="bsx-appnav-collapse-backdrop" data-fn="remote-event" data-fn-target="#toggle-navbar-collapse" data-tg="dropdown-multilevel-excluded"></div>

		<?php 
			if ( class_exists( 'BsxAppNavExampleNav001' ) ) {
				$BsxAppNavigation = new BsxAppNavExampleNav001;
				if ( method_exists( $BsxAppNavigation, 'printExampleIconNav' ) ) {
					$BsxAppNavigation->printExampleIconNav();
				}
			}
		?>

	</nav>

</header>


