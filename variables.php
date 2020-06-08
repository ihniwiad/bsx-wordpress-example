<?php 

// paths

$serverName = $_SERVER[ 'SERVER_NAME' ];
$homeUrl = get_bloginfo( 'url' ) . '/';

$rootPath = get_bloginfo( 'template_directory' ).'/';
$resourcesPath = 'resources/';

$relativeAssetsPath = 'assets/';
$assetsPath = $rootPath . $relativeAssetsPath;
$rootRelatedAssetsPath = explode( $homeUrl, $assetsPath )[ 1 ];


// include classes file
//include './classes/include-classes.php';


// include classes
if ( class_exists( 'BsxPhotoswipe001' ) ) {
	$BsxPhotoswipe = new BsxPhotoswipe001;
}


// logo

$headerLogoFilePath = $assetsPath.'img/ci/logo/logo.svg';
$headerLogoAlt = 'Example Logo';
$headerLogoWidth = 136;
$headerLogoHeight = 27;

$footerLogoFilePath = $headerLogoFilePath;
$footerLogoAlt = $headerLogoAlt;
$footerLogoWidth = $headerLogoWidth;
$footerLogoHeight = $headerLogoHeight;


// dev mode
$isDevMode = false;
if ( isset( $_GET[ 'dev' ] ) && $_GET[ 'dev' ] == '1' ) {
	$isDevMode = true;
}

