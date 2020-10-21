<?php 

include 'variables.php';
//include 'classes/include-classes.php';

?>

<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?><?php if ( $isDevMode ) echo ' data-dev="'.$isDevMode.'"' ?> data-id="<?php echo get_the_ID(); ?>">

	<head>
	
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- 
		<?php // <title>bsx Wordpress Template</title> ?>
		-->

		<!-- preload fonts -->
		<?php include 'template-parts/fonts-preloads.php'; ?>

		<!-- atf style -->
		<?php include 'template-parts/atf-style.php'; ?>
		
		<!-- css -->
		<?php
			// get css file version using absolute file path
			$cssFileName = 'css/style.min.css';
			$cssFilePath = $rootRelatedAssetsPath . $cssFileName;
			$cssVersion = file_exists( $cssFilePath ) ? filemtime( $cssFilePath ) : 'null';

			// make path using relative path & version
			$currentCssFilePath = $assetsPath . $cssFileName . '?v=' . $cssVersion;
			if ( $isDevMode ) {
				$currentCssFilePath = str_replace ( '.min', '' , $currentCssFilePath );
			}
		?>
		<link rel="preload" href="<?php echo $currentCssFilePath ?>" as="style">
		<link href="<?php echo $currentCssFilePath ?>" rel="stylesheet">

		<!-- favicons -->
	    <link rel="icon" type="image/png" href="<?php echo $assetsPath ?>img/ci/icon/favicon-16x16.png" sizes="16x16">
	    <link rel="icon" type="image/png" href="<?php echo $assetsPath ?>img/ci/icon/favicon-32x32.png" sizes="32x32">
	    <link rel="icon" type="image/png" href="<?php echo $assetsPath ?>img/ci/icon/favicon-96x96.png" sizes="96x96">

	    <link rel="apple-touch-icon" href="<?php echo $assetsPath ?>img/ci/icon/apple-touch-icon-120x120.png">
	    <link rel="apple-touch-icon" href="<?php echo $assetsPath ?>img/ci/icon/apple-touch-icon-152x152.png" sizes="152x152">
	    <link rel="apple-touch-icon" href="<?php echo $assetsPath ?>img/ci/icon/apple-touch-icon-167x167.png" sizes="167x167">
	    <link rel="apple-touch-icon" href="<?php echo $assetsPath ?>img/ci/icon/apple-touch-icon-180x180.png" sizes="180x180">

        <?php wp_head();?>
		
	</head>
	
	<body>

		<a class="sr-only sr-only-focusable" href="#main">Skip to main content</a>
	
		<div class="wrapper" id="top">

			<?php include 'template-parts/html-header.php'; ?>