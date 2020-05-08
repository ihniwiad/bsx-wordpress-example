<?php 
	// template part of bsx-example including atf style

	$isDevMode = false;
	if ( isset( $_GET[ 'dev' ] ) && $_GET[ 'dev' ] == '1' ) {
		$isDevMode = true;
	}

	if ( $isDevMode ) {
		print('
<style>
body {
  font-size: 1rem;
  line-height: 1.5;
  margin: 0;
  color: transparent; }

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0; }

.atf-component-001 {
  background: #FF003B; }

.bsx-appnav-navbar-nav ul {
  display: none; }

@media (min-width: 992px) {
  .bsx-appnav-desktop-hidden {
    display: none !important; } }

@media (max-width: 991.98px) {
  .bsx-appnav-mobile-hidden {
    display: none !important; } }

@media (max-width: 991.98px) {
  .bsx-appnav-navbar-toggler {
    position: relative;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    min-width: 2rem;
    min-height: 1.25em;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background: transparent;
    border: none;
    padding-top: 1em;
    padding-bottom: 1em;
    font-size: 1rem;
    color: transparent; }
    .bsx-appnav-navbar-toggler::before {
      content: "";
      position: absolute;
      left: 0.66667em;
      right: 0.66667em;
      height: 1.25em;
      margin-top: 0.125em;
      background: #dee2e6;
      border-radius: 0.625em; } }

@media (min-width: 992px) {
  .bsx-appnav-navbar-toggler {
    display: none; } }

.bsx-appnav-navbar-brand {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  margin-left: auto;
  margin-right: auto;
  padding: .33rem .75rem;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  font-size: 1.25rem;
  line-height: inherit;
  white-space: nowrap;
  max-width: 40vw; }
  .bsx-appnav-navbar-brand:hover, .bsx-appnav-navbar-brand:focus {
    text-decoration: none; }
  .bsx-appnav-navbar-brand img {
    max-width: 100%;
    height: auto; }

.bsx-appnav-navbar {
  padding-top: 0;
  padding-bottom: 0;
  background-color: rgba(255, 255, 255, 0.94);
  -webkit-box-shadow: 0 1px 0 0 rgba(0, 0, 0, 0.1), 0 0 15px 0 rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 0 0 rgba(0, 0, 0, 0.1), 0 0 15px 0 rgba(0, 0, 0, 0.05); }
  .bsx-appnav-navbar.bsx-appnav-fixed-top {
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030; }
    @media (max-width: 991.98px) {
      .bsx-appnav-navbar.bsx-appnav-fixed-top {
        position: absolute; } }
    @media (min-width: 992px) {
      .bsx-appnav-navbar.bsx-appnav-fixed-top {
        position: fixed; } }

@media (max-width: 991.98px) {
  .bsx-appnav-navbar {
    display: block; } }

@media (min-width: 992px) {
  .bsx-appnav-navbar {
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center; }
    .bsx-appnav-navbar .bsx-appnav-navbar-nav {
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
      -ms-flex-direction: row;
      flex-direction: row; } }

.bsx-appnav-navbar-container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row; }

@media (max-width: 991.98px) {
  .bsx-appnav-navbar-collapse {
    display: none; } }

@media (min-width: 992px) {
  .bsx-appnav-navbar-collapse {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    width: 100%; } }

.bsx-appnav-navbar-nav {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  padding-left: 0;
  margin-top: 0;
  margin-bottom: 0;
  list-style: none; }
  .bsx-appnav-navbar-nav li a {
    display: block;
    padding: 0.66667em 0.66667em; }
  .bsx-appnav-navbar-nav > li > a {
    position: relative;
    min-width: 2rem;
    min-height: 1.25em;
    color: transparent; }
    @media (min-width: 992px) {
      .bsx-appnav-navbar-nav > li > a {
        padding-top: 1em;
        padding-bottom: 1em; } }
    .bsx-appnav-navbar-nav > li > a::before {
      content: "";
      position: absolute;
      left: 0.66667em;
      right: 0.66667em;
      height: 1.25em;
      margin-top: 0.125em;
      background: #dee2e6;
      border-radius: 0.625em; }

@media (min-width: 992px) {
  .bsx-appnav-navbar-nav.bsx-main-navbar-nav {
    margin-right: auto; } }

.bsx-appnav-navbar-nav.bsx-allmedia-dropdown-nav {
  display: -webkit-inline-box;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row; }
  .bsx-appnav-navbar-nav.bsx-allmedia-dropdown-nav > li > a {
    padding-top: 1em;
    padding-bottom: 1em; }

[class*="banner-vh-"] {
  background-color: #dee2e6;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center; }

.banner-inner {
  width: 100%; }

body.ielte11 [class*="banner-vh-"] {
  height: 10px; }

[class*="banner-vh-"],
body.ielte11 [class*="banner-vh-"] {
  min-height: 18rem; }

body.ioslte7 [class*="banner-vh-"] > .banner-inner {
  min-height: 20px; }

.banner-vh-1,
body.ielte11 [class*="banner-vh-1"] {
  min-height: 100vh; }

body.ioslte7 .banner-vh-1 {
  min-height: 280px; }

@media (min-height: 480px) {
  body.ioslte7 .banner-vh-1 {
    min-height: 480px; } }

@media (min-height: 648px) {
  body.ioslte7 .banner-vh-1 {
    min-height: 648px; } }

@media (min-height: 904px) {
  body.ioslte7 .banner-vh-1 {
    min-height: 904px; } }

@media (max-height: 900px) {
  .banner-vh-2,
  body.ielte11 [class*="banner-vh-2"] {
    min-height: calc(100vh - 100px); } }

@media (min-height: 901px) {
  .banner-vh-2,
  body.ielte11 [class*="banner-vh-2"] {
    min-height: 800px; } }

@media (min-height: 600px) {
  body.ioslte7 .banner-vh-2 {
    min-height: 430px; } }

@media (min-height: 768px) {
  body.ioslte7 .banner-vh-2 {
    min-height: 550px; } }

@media (min-height: 850px) {
  body.ioslte7 .banner-vh-2 {
    min-height: 610px; } }

@media (min-height: 1000px) {
  body.ioslte7 .banner-vh-2 {
    min-height: 720px; } }

@media (max-height: 900px) {
  .banner-vh-3,
  body.ielte11 [class*="banner-vh-3"] {
    min-height: calc(100vh - 200px); } }

@media (min-height: 901px) {
  .banner-vh-3,
  body.ielte11 [class*="banner-vh-3"] {
    min-height: 700px; } }

@media (min-height: 600px) {
  body.ioslte7 .banner-vh-3 {
    min-height: 360px; } }

@media (min-height: 768px) {
  body.ioslte7 .banner-vh-3 {
    min-height: 460px; } }

@media (min-height: 850px) {
  body.ioslte7 .banner-vh-3 {
    min-height: 510px; } }

@media (min-height: 1000px) {
  body.ioslte7 .banner-vh-3 {
    min-height: 600px; } }

/*# sourceMappingURL=atf.css.map */

</style>
		');
	}
	else {
		print('
<style>
body{font-size:1rem;line-height:1.5;margin:0;color:transparent}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}.atf-component-001{background:#ff003b}.bsx-appnav-navbar-nav ul{display:none}@media (min-width:992px){.bsx-appnav-desktop-hidden{display:none!important}}@media (max-width:991.98px){.bsx-appnav-mobile-hidden{display:none!important}}@media (max-width:991.98px){.bsx-appnav-navbar-toggler{position:relative;-webkit-box-sizing:content-box;box-sizing:content-box;min-width:2rem;min-height:1.25em;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;background:0 0;border:none;padding-top:1em;padding-bottom:1em;font-size:1rem;color:transparent}.bsx-appnav-navbar-toggler::before{content:"";position:absolute;left:.66667em;right:.66667em;height:1.25em;margin-top:.125em;background:#dee2e6;border-radius:.625em}}@media (min-width:992px){.bsx-appnav-navbar-toggler{display:none}}.bsx-appnav-navbar-brand{display:-webkit-box;display:-ms-flexbox;display:flex;margin-left:auto;margin-right:auto;padding:.33rem .75rem;-webkit-box-align:center;-ms-flex-align:center;align-items:center;font-size:1.25rem;line-height:inherit;white-space:nowrap;max-width:40vw}.bsx-appnav-navbar-brand:focus,.bsx-appnav-navbar-brand:hover{text-decoration:none}.bsx-appnav-navbar-brand img{max-width:100%;height:auto}.bsx-appnav-navbar{padding-top:0;padding-bottom:0;background-color:rgba(255,255,255,.94);-webkit-box-shadow:0 1px 0 0 rgba(0,0,0,.1),0 0 15px 0 rgba(0,0,0,.05);box-shadow:0 1px 0 0 rgba(0,0,0,.1),0 0 15px 0 rgba(0,0,0,.05)}.bsx-appnav-navbar.bsx-appnav-fixed-top{top:0;right:0;left:0;z-index:1030}@media (max-width:991.98px){.bsx-appnav-navbar.bsx-appnav-fixed-top{position:absolute}}@media (min-width:992px){.bsx-appnav-navbar.bsx-appnav-fixed-top{position:fixed}}@media (max-width:991.98px){.bsx-appnav-navbar{display:block}}@media (min-width:992px){.bsx-appnav-navbar{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.bsx-appnav-navbar .bsx-appnav-navbar-nav{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}}.bsx-appnav-navbar-container{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}@media (max-width:991.98px){.bsx-appnav-navbar-collapse{display:none}}@media (min-width:992px){.bsx-appnav-navbar-collapse{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;width:100%}}.bsx-appnav-navbar-nav{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;padding-left:0;margin-top:0;margin-bottom:0;list-style:none}.bsx-appnav-navbar-nav li a{display:block;padding:.66667em .66667em}.bsx-appnav-navbar-nav>li>a{position:relative;min-width:2rem;min-height:1.25em;color:transparent}@media (min-width:992px){.bsx-appnav-navbar-nav>li>a{padding-top:1em;padding-bottom:1em}}.bsx-appnav-navbar-nav>li>a::before{content:"";position:absolute;left:.66667em;right:.66667em;height:1.25em;margin-top:.125em;background:#dee2e6;border-radius:.625em}@media (min-width:992px){.bsx-appnav-navbar-nav.bsx-main-navbar-nav{margin-right:auto}}.bsx-appnav-navbar-nav.bsx-allmedia-dropdown-nav{display:-webkit-inline-box;display:-ms-inline-flexbox;display:inline-flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}.bsx-appnav-navbar-nav.bsx-allmedia-dropdown-nav>li>a{padding-top:1em;padding-bottom:1em}[class*=banner-vh-]{background-color:#dee2e6;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.banner-inner{width:100%}body.ielte11 [class*=banner-vh-]{height:10px}[class*=banner-vh-],body.ielte11 [class*=banner-vh-]{min-height:18rem}body.ioslte7 [class*=banner-vh-]>.banner-inner{min-height:20px}.banner-vh-1,body.ielte11 [class*=banner-vh-1]{min-height:100vh}body.ioslte7 .banner-vh-1{min-height:280px}@media (min-height:480px){body.ioslte7 .banner-vh-1{min-height:480px}}@media (min-height:648px){body.ioslte7 .banner-vh-1{min-height:648px}}@media (min-height:904px){body.ioslte7 .banner-vh-1{min-height:904px}}@media (max-height:900px){.banner-vh-2,body.ielte11 [class*=banner-vh-2]{min-height:calc(100vh - 100px)}}@media (min-height:901px){.banner-vh-2,body.ielte11 [class*=banner-vh-2]{min-height:800px}}@media (min-height:600px){body.ioslte7 .banner-vh-2{min-height:430px}}@media (min-height:768px){body.ioslte7 .banner-vh-2{min-height:550px}}@media (min-height:850px){body.ioslte7 .banner-vh-2{min-height:610px}}@media (min-height:1000px){body.ioslte7 .banner-vh-2{min-height:720px}}@media (max-height:900px){.banner-vh-3,body.ielte11 [class*=banner-vh-3]{min-height:calc(100vh - 200px)}}@media (min-height:901px){.banner-vh-3,body.ielte11 [class*=banner-vh-3]{min-height:700px}}@media (min-height:600px){body.ioslte7 .banner-vh-3{min-height:360px}}@media (min-height:768px){body.ioslte7 .banner-vh-3{min-height:460px}}@media (min-height:850px){body.ioslte7 .banner-vh-3{min-height:510px}}@media (min-height:1000px){body.ioslte7 .banner-vh-3{min-height:600px}}
</style>
		');
	}