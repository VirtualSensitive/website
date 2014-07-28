<?php
//Setup location of WordPress
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];


//Access WordPress
require_once( $path_to_wp.'/wp-load.php' );
header ("Content-Type:text/css");

function rb_cssall(){
	$prefixes = array('    ', '   -moz-', '-webkit-', '     -o-', '    -ms-');
	$arg_list = func_get_args();
	$property = array_shift($arg_list);
	foreach($prefixes as $prefixe){
		echo $prefixe.$property.':';
		foreach($arg_list as $arg){
			echo ' '.$arg;
		}
		echo ";\n";
	}
}

function rgbcolor($hexcolor){
	$rc = substr($hexcolor,0,2);
	$gc = substr($hexcolor,2,2);
	$bc = substr($hexcolor,4,2);
	return hexdec($rc).', '.hexdec($gc).', '.hexdec($bc);
}

if(!$Rb_demo){
	$rb_ColorFirst = '#'.rb_opt('colorFirst','');
	$rb_ColorFirstAlpha = 'rgba('.rgbcolor(rb_opt('colorFirst','')).', .5)';
	$rb_BackgroundColor = '#'.rb_opt('colorBackground','');
	$rb_ColorFont = '#'.rb_opt('colorFont','');

	$rb_NormalFont = rb_opt('contentFontCollation','');
	$rb_HeaderFont = rb_opt('headerFontCollation','');

	$rb_imagesDir = "images/";
}else{
	echo '@ImagesDir: "images/";'."\n";
		$rb_imagesDir = '@{ImagesDir}';
	echo '@ColorFirst : '. "#".rb_opt('colorFirst','').";\n";
		$rb_ColorFirst = '@ColorFirst';
	echo '@ColorFirstAlpha : '. 'rgba('.rgbcolor(rb_opt('colorFirst','')).", .5);\n";
		$rb_ColorFirstAlpha = '@ColorFirstAlpha';
	echo '@BackgroundColor : '. "#".rb_opt('colorBackground','').";\n";
		$rb_BackgroundColor = '@BackgroundColor';
	echo '@ColorFont : '. "#".rb_opt('colorFont','').";\n";
		$rb_ColorFont = '@ColorFont';

	$rb_NormalFont = rb_opt('contentFontCollation','');
	$rb_HeaderFont = rb_opt('headerFontCollation','');

	echo '@NormalFont : '. rb_opt('contentFontCollation','').";\n";
		$rb_NormalFont = '@NormalFont';
	echo '@HeaderFont : '. rb_opt('headerFontCollation','').";\n";
		$rb_HeaderFont = '@HeaderFont';

}
?>
/* Federal Premium WordPress Theme */

body {
	background: #fff;
	color:<?php echo $rb_ColorFont; ?>;
}

.content-white {
	background: #fff;
}
.pageSection{
	background: #fff;
	padding-top:55px;
	margin-top:-80px;
}

section.firstcolor{
	background-color:<?php echo $rb_ColorFirst; ?>;
}

.page-link-next-prev{
	margin-top:30px
}
.page-link-next-prev a{
	display:inline-block;
}

.page-link-next-prev .prev{
	margin-right:30px;
}

.page-link-next-prev .prev:before{
	font-family:FontAwesome;
	content:"\f177";
	font-size:14px;
	padding-right:10px;
}
.page-link-number{
	margin:20px 0 10px 0;
}

.page-link-number a{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	display:inline-block;
	border:1px solid #EFEFEF;
	padding:3px 10px;
	color:<?php echo $rb_ColorFont; ?>;
}
.page-link-number a:hover{
	background:<?php echo $rb_ColorFirst; ?>;
	color:#fff;
}



/* color */
.bg-color {
	background-color: <?php echo $rb_ColorFirst; ?> !important;
}

.navbar-toggle .icon-bar {
	background-color: <?php echo $rb_ColorFirst; ?>;
}

.thumbnail-portfolio .like span {
	color: <?php echo $rb_ColorFirst; ?> !important;
}

.tp-bannertimer {
	background: <?php echo $rb_ColorFirst; ?> !important;
	z-index: 20 !important;
}

.top-navigation-inner .menu-top li a:hover,.font-color {
	color: <?php echo $rb_ColorFirst; ?>;
}

.nav-tabs>li.active>a,.nav-tabs>li.active>a:hover,.nav-tabs>li.active>a:focus {
	background: <?php echo $rb_ColorFirst; ?>;
	border: 0;
	border-bottom: 1px solid <?php echo $rb_ColorFirst; ?>;
	color: #fff;
	border-radius: 0;
}

.hi-icon-effect-3a .hi-icon {
	color:<?php echo $rb_ColorFirst; ?>;
	/*background-color: rgba(0,0,0,0.6);*/
}

.hi-icon-effect-3 .hi-icon {
	box-shadow: 0 0 0 4px #fff;
}
.hi-icon-effect-3 .hi-icon:after {
	background-color: #fff;
}
.hi-icon-effect-3 .hi-icon:hover {
	box-shadow: 0 0 0 4px #fff;
}
.hi-icon-wrap{
	padding:0;
}
.hi-icon-wrap h3{
	margin:20px 0 0 0;
}
.processbar h3{
	margin-top:20px;
}

.thumbnails .label .date {
	color: <?php echo $rb_ColorFirst; ?>;
	line-height: 24px;
}

.button-portfolio a:hover {
	border: 5px solid <?php echo $rb_ColorFirst; ?>;
}

.owl-controls .owl-page.active span,.single-blog .icon-type {
	background: <?php echo $rb_ColorFirst; ?> !important;
}

.widget-tags a:hover,
.frame-blog .date,
.frame-blog .readmore a.readmore,
.widget_tag_cloud a:hover
 {
	font-family: <?php echo $rb_HeaderFont; ?>;
	background: <?php echo $rb_ColorFirst; ?> !important;
	color: #fff;
}

.pin-contact .label:hover {
	background: <?php echo $rb_ColorFirst; ?>;
	border-color: #fff;
}

.pagination a.active {
	background: <?php echo $rb_ColorFirst; ?> !important;
	color: #fff;
}
.pagination span.current {
	background: <?php echo $rb_ColorFirst; ?> !important;
	color: #fff;
}

.button-q:link,
.button-q:visited{
	font-family: <?php echo $rb_NormalFont; ?>;
	background: #fff !important;
	color:#000;
	padding:10px 30px;
	border-radius:20px;

	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}
.button-q:hover,
.button-q:active{
	background: <?php echo $rb_ColorFirst; ?> !important;
	color: #fff !important;
}

#submit {
	font-family: <?php echo $rb_HeaderFont; ?>;
	background: <?php echo $rb_ColorFirst; ?> !important;
	color: #fff !important;
	padding: 10px 20px;
	opacity: 0.6;
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.button-q:hover, #submit:hover {
	color: #fff;
	opacity: 1.0;
}

.thumbnail-services {
	text-align: center;
	font-size: 20px;
}

.box-services:hover i {
	color: <?php $rb_ColorFirst; ?> !important;
}

.thumbnail-services span {
	font-size: 25px;
}

.box-services:hover .thumbnail-services span {
	color: <?php $rb_ColorFirst; ?>;
}

.box-services:hover .thumbnail-services {}

.hover-font-color:hover {
	color: <?php echo $rb_ColorFirst; ?> !important;
}

.option-social {
	border-color: <?php echo $rb_ColorFirst; ?> !important;
}

.hi-icon-effect-3b:hover h3 {
	color: <?php echo $rb_ColorFirst; ?>;
}

.thumbnail-portfolio .figcaption {
	background: <?php echo $rb_ColorFirst; ?>;
}

/* Set Default */
.mouse-pointer {
	cursor: pointer;
}

.font-medium-large-size {
	font-size: 20px;
	font-weight: 500;
	line-height: 30px;
}

.around-white,.around-white .heading,.around-white .description {
	color: #fff !important;
}

.around-white .heading:after {
	border-color: #fff !important;
}
header .heading{
	margin-top:20px;
}
.heading h2{
	font-size: 36px;
}

img {
	max-width: 100%;
}

.menu-top{
	margin:0;
	padding:0;
}

.menu-top ul,
.menu-top li{
	list-style-type: none;
}

a,a:hover {
	font-family: <?php echo $rb_HeaderFont; ?>;
	font-family: <?php echo $rb_HeaderFont; ?>;
	text-decoration: none;
}
a:focus{
	outline: none;
	text-decoration:none;
}

h1,h2,h3,h4,h5,h6 {
	font-family: <?php echo $rb_HeaderFont; ?>;
	margin-top:0;
}
h1,h2,h3{ font-weight:700; }
h4,h5,h6{ font-weight:500; }

p,
.sidebar-nav *
 {
	font-family: <?php echo $rb_HeaderFont; ?>;
	font-size: 14px;
	line-height: 21px;
	font-weight: 300;
	color:<?php echo $rb_ColorFont; ?>;
}
.around-white p{
	color:#fff;
}
.sidebar-nav > ul > li:first-child > div:first-child  .first-wa{
	margin-top:0;
}


.font-white {
	color: #fff;
}

.border-white {
	border: 4px solid #fff;
	border-radius: 50%;
}

/* Alignments */
.left {
	float: left;
}

.right {
	float: right;
}

.text-left {
	text-align: left;
}

.position-fixed {
	position: fixed;
	width: 100%;
}

.center {
	text-align: center;
}

/* Font */
.font-soft {
	font-weight: 300;
}

.font-soft-normal {
	font-weight: 400 !important;
}

.font-normal {
	font-weight: 500 !important;
}

.font-hard {
	font-weight: 700;
}

.font-large {
	font-size: 30px;
}

.heading {
	font-family: <?php echo $rb_HeaderFont; ?>;
	font-weight: 500;
	position: relative;
	margin-bottom: 40px;
	color: <?php echo $rb_ColorFont ?>;
}

.heading:after {
	border-bottom: 1px solid <?php echo $rb_ColorFont; ?>;
	width: 30px;
	position: absolute;
	bottom: -20px;
	left: 50%;
	margin-left: -15px;
	content: "";
}

.description {
	font-family: <?php echo $rb_NormalFont; ?>;
	color: <?php echo $rb_ColorFont; ?>;
}

.font-raleway {
	font-family: <?php echo $rb_HeaderFont; ?>;
}

/* Background */
.mbYTP_wrapper {
	z-index: -1 !important;
}

.header-slide {
	background-size: cover;
	background-attachment: fixed;
}

.Owl-Slider {
	position: relative;
	z-index: 2;
}

.Owl-Slider .item .content {
	position: absolute;
	top: 30%;
	width: 100%;
	z-index: 2;
}

.rev_slider_wrapper{
	z-index:2;
}

.tp-banner {
	width: 100%;
	position: relative;
}

.pattern {
	background: url('<?php echo $rb_imagesDir; ?>pattern.jpg');
	position: absolute;
	width: 100%;
	height: 100%;
}

.parallax-background {
	position:static !important;
	background-position: center center;
	background-repeat:no-repeat;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size:cover;
	background-attachment:fixed;
}

.normal-background {
	max-width: 100%;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size:cover;
	background-repeat: repeat-y;
	background-position: center center;
}


.sub-box,.box-contact {
	position: relative;
}

.around-white {
	position: relative;
	z-index: 2;
}

.pattern-overlay {
	background: url('<?php echo $rb_imagesDir; ?>pattern02.png') rgba(0,0,0,0.6);
	position: absolute;
	height: 100%;
	width: 100%;
	top: 0;
	left: 0;
	z-index: 0;
}

.tp-dottedoverlay.threexthree  { background:url('<?php echo $rb_imagesDir; ?>pattern02.png') rgba(0,0,0,0.4); }

.tp-button.federal,
.tp-button.federal:link,
.tp-button.federal:visited{
	font-family: <?php echo $rb_NormalFont; ?> !important;
	padding:10px 30px;
	box-shadow:none !important;
	background:#fff;
	color:#000 !important;
	border-radius:20px !important;
	text-shadow:none !important;
	font-weight:normal;
	letter-spacing:0px;
}

.tp-button.federal:hover,
.tp-button.federal:active{
	font-family: <?php echo $rb_NormalFont; ?> !important;
	background:<?php echo $rb_ColorFirst; ?>;
	color:#fff !important;
}

.pattern-overlay1 {
	background: url('<?php echo $rb_imagesDir; ?>overlay-pattern1.png') rgba(0,0,0,0);
	opacity:.7;
	position: absolute;
	height: 100%;
	width: 100%;
	top: 0;
	left: 0;
	z-index: 1;
}

/* Slider Owl Slider */
.Owl-Slider {
	position: relative;
}

#top_section .wrapper-black {
	background:url('<?php echo $rb_imagesDir; ?>pattern02.png') rgba(0,0,0,0.4);
	position: absolute;
	z-index: 1;
	width: 100%;
	height: 100%;
}

.thumbnail-portfolio .textholder{
	position:fixed;
	width:100%;
	height:100%;
	left:0;
	top:0;
	bottom:0;
	right:0;
	display:table;
}
.thumbnail-portfolio .textVerticalCenter{
	display:table-cell;
	vertical-align:middle;
	text-align:center;
}
.thumbnail-portfolio h3{
	<?php rb_cssall('transition', '.3s'); ?>
	position:relative;
	opacity:0;
	margin:20px 0;
	color:#fff;
}
.viewproject:link,
.viewproject:visited{
	position:relative;
	top:-20px;
	<?php rb_cssall('transition', '.3s'); ?>
	display:inline-block;
	border:1px solid #fff;
	color:#fff;
	padding:7px 30px;
	font-size:16px;
	opacity:0;
}
.thumbnail-portfolio:hover .viewproject{
	opacity:1;
	top:0px;
}
.thumbnail-portfolio:hover h3{
	opacity:1;
}
.thumbnail-portfolio:hover .categories{
	opacity:1;
	top:0px;
}
.thumbnail-portfolio:hover .voteCount,
.thumbnail-portfolio:hover .fa-heart{
	opacity:1;
	top:0;
}
.viewproject:hover,
.viewproject:active{
	background:#fff;
	color:<?php echo $rb_ColorFirst; ?>;
}
.thumbnail-portfolio .categories{
	<?php rb_cssall('transition', '.3s'); ?>
	opacity:0;
	position:relative;
	font-size:16px;
	color:#fff;
	margin:0 0 20px 0;
	padding:0;
	top:20px;
}
.thumbnail-portfolio .voteCount{
	position:relative;
	<?php rb_cssall('transition', '.3s'); ?>
	color:#fff;
	margin-left:10px;
	opacity:0;
	top:20px;
}
.thumbnail-portfolio .fa-heart{
	position:relative;
	<?php rb_cssall('transition', '.3s'); ?>
	opacity:0;
	top:20px;
}
.thumbnail-portfolio .fa-heart:before{
	color:#fff;
}
.box-down {
	padding: 10px !important;
	display: inline-block !important;
	font-family: FontAwesome;
}

.box-down:hover {
	padding: 10px !important;
	display: inline-block !important;
	font-family: FontAwesome;
}

.header-slide a {
	color: #fff;
}

/* Navigation top */
.top-navigation {
	position: relative;
	min-height: 85px;
	z-index: 9;
}

.top-navigation-inner {
	background: #fff;
	padding: 10px 0;
	z-index: 10;
	top: 0;
	margin: auto;
/* Shadow */
	-moz-box-shadow: 0 1px 2px #ccc;
	-webkit-box-shadow: 0 1px 2px #ccc;
	box-shadow: 0 1px 2px #ccc;
}

/* menu - top */
.top-navigation .menu, #header-share{
	margin-top:15px;
}

.top-navigation-inner .menu-top > li {
	float: left;
}
.top-navigation-inner .menu-top  li {
	position:relative;
}
.top-navigation-fixed{
	position:fixed;
	width:100%;
}
.top-navigation-inner .menu-top li a:link,
.top-navigation-inner .menu-top li a:visited,
.top-navigation-inner .menu-top li a:focus {
	<?php rb_cssall('transition', 'all', '.5s', 'ease-out'); ?>
	text-decoration:none;
	outline: none;
	font-family: <?php echo $rb_HeaderFont; ?>;
	display: block;
	font-weight: 500;
	color: <?php echo $rb_ColorFont; ?>;
	padding: 10px 20px;
	font-size: 13px;
}

.top-navigation-inner .menu-top li a::before{
	position: absolute;
	top: 32px;
	left: 50%;
	color: transparent;
	content: '\2022';
	text-shadow: 0 0 transparent;
	font-size: 22px;
	-webkit-transition: text-shadow 0.3s, color 0.3s;
	-moz-transition: text-shadow 0.3s, color 0.3s;
	transition: text-shadow 0.3s, color 0.3s;
	-webkit-transform: translateX(-50%);
	-moz-transform: translateX(-50%);
	transform: translateX(-50%);
	pointer-events: none;
}

.top-navigation-inner .menu-top li a:hover::before,
.current a:link::before,
.current a:visited::before,
.current a:active::before,
.current a:hover::before,
.top-navigation-inner .menu-top > li.current_page_item a:link::before,
.top-navigation-inner .menu-top > li.current_page_item a:visited::before{
	color: <?php echo $rb_ColorFirst; ?> !important;
	text-shadow: 8px 0 <?php echo $rb_ColorFirst; ?>, -8px 0 <?php echo $rb_ColorFirst; ?> !important;
}

.top-navigation-inner .menu-top li a:hover,
.top-navigation-inner .menu-top li a:active,
.current a:link,
.current a:visited,
.current a:active,
.current a:hover,
.top-navigation-inner .menu-top > li.current_page_item a:link,
.top-navigation-inner .menu-top > li.current_page_item a:visited{
	color: <?php echo $rb_ColorFirst; ?> !important;
}

#header-share{
	margin-left:20px;
}
#header-share a:link,
#header-share a:visited{
	<?php rb_cssall('transition', 'all', '.5s', 'ease-out'); ?>
	display:inline-block;
	width:30px;
	height:30px;
	border:1px solid #999;
	border-radius:50%;
	float:right;
	margin:4px 3px 0 3px;
}
#header-share a:before{
	<?php rb_cssall('transition', 'all', '.5s', 'ease-out'); ?>
	display:block;
	width:30px;
	text-align:center;
	line-height:30px;
	font-family:FontAwesome;
	color:#999;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	opacity:.5;
}
#header-share a.facebook:before{
	content:'\f09a';
}
#header-share a.twitter:before{
	content:'\f099';
}
#header-share a.google:before{
	content:'\f0d5';
}
#header-share a:hover,
#header-share a:active{
	border-color:<?php echo $rb_ColorFirst; ?>;
	color:<?php echo $rb_ColorFirst; ?>;
}
#header-share a:hover:before,
#header-share a:active:before{
	opacity:1;
	color:<?php echo $rb_ColorFirst; ?>;
}

@media only screen and (max-width: 1200px) and (min-width: 1024px){
	.top-navigation-inner .menu-top li a:link,
	.top-navigation-inner .menu-top li a:visited,
	.top-navigation-inner .menu-top li a:focus{
		padding:10px 10px;
	}
}
@media only screen and (max-width: 1024px) and (min-width: 768px){
	.top-navigation-inner .menu-top li a:link,
	.top-navigation-inner .menu-top li a:visited,
	.top-navigation-inner .menu-top li a:focus{
		padding:10px 5px;
		font-size:12px;
	}
}

.top-navigation-inner .menu-top li ul{
	display:none;
	opacity:0;
	position:absolute;
	top:55px;
	left:0px;
	width:200px;
	border:1px solid #e3e3e3;
	background:#fff;
	box-shadow: 0px 0px 5px rgba(204,204,204,.3);
	border-radius:3px;
	padding-left:0;
}

.top-navigation-inner .menu-top li ul li ul{
	left:100%;
	top:15px;
	margin-left:-10px;
}

/* Widget */
.widget,
.sidebar-nav ul > li > div{
	margin-bottom: 40px;
}

.sidebar-nav .fa-search{
	color:#CCCCCC;
}
.sidebar-nav ul,
.sidebar-nav ul li{
	list-style:none;
	margin: 0;
	padding: 0;
}

.widget-title,
h3.first-wa
 {
	font-family: <?php echo $rb_HeaderFont; ?>;
	color: <?php echo $rb_ColorFirst; ?>;
	margin-bottom: 20px;
	font-size: 18px;
	font-weight: 500;
}

.form-search {
	border: 1px solid #ccc;
	padding: 10px;
	position: relative;
}

.form-search input[type=text],.form-search input[type=text]:active,.form-search input[type=text]:focus,.form-search input[type=text]:hover {
	border: 0;
	border-color: none;
	box-shadow: none;
	outline: none;
	display: block;
	width: 100%;
}

.form-search button[type=button] {
	border: 0;
	border-color: none;
	box-shadow: none;
	outline: none;
	display: block;
	background: transparent;
	color: #ccc;
	position: absolute;
	right: 10px;
	top: 50%;
	margin-top: -10px;
}

.list-menu,
.widget_categories ul{
	padding: 0;
}

.list-menu a,
.widget_categories ul li a {
	color: #1d1d1d;
	padding: 10px 15px;
	display: block;
/* animation */
	-webkit-transition-duration: .2s;
	-moz-transition-duration: .2s;
	-ms-transition-duration: .2s;
	-o-transition-duration: .2s;
	transition-duration: .2s;
}

.list-menu a:hover,
.widget_categories ul li a:hover{
	background: <?php echo $rb_ColorFirst; ?>;
	color: #fff;
}

/* navigation tab */
.nav-tabs {
	border: 1px solid #ddd;
}

.tab-content {
	border: 1px solid #ddd;
	border-top: 0;
}

.nav-tabs > li > a:hover {
	border-radius: 0;
}

.nav-tabs > li > a {
	margin-right: 0;
	border-radius: 0;
	padding: 15px;
}

/* tab thumbnail */
.thumbnails {
	display: block;
	padding: 20px 10px;
	border-top: 1px #ddd solid;
	margin-right: 0;
	margin-left: 0;
}

.thumbnails:first-child {
	margin-top: 0;
	border-top: 0;
}

.thumbnails .label {
	color: #1d1d1d;
	font-family: <?php echo $rb_HeaderFont; ?>;
	font-size: 14px;
	font-weight: 300;
	padding: 0;
	word-break: break-all;
	white-space: normal;
	line-height: 24px;
	float: left;
	max-width: 160px;
}

.thumbnails .images {
	width: 80px;
	text-align: center;
	float: left;
}
.thumbnails .images img{
	width:50px;
}
.widget_rb_tab_widget a:link,
.widget_rb_tab_widget a:visited
{
	color:<?php echo $rb_ColorFont; ?>;
}
.widget_rb_tab_widget a:hover,
.widget_rb_tab_widget a:active
{
	color:<?php echo $rb_ColorFirst; ?>;
}

.rb-twitter-feed{
	margin-bottom:20px;
}

/* Twitter */
#jtwt .jtwt_tweet {
	margin-bottom: 30px;
	font-size: 13px;
	line-height: 20px;
	background: url('<?php echo $rb_imagesDir; ?>social-icon/twitter-small.png') no-repeat top left !important;
	padding-left: 35px !important;
	padding-top: 0 !important;
}

/* Flickr */
.widget-flickr-images {
	padding-left: -15px;
}

.widget-flickr-images .row {
	margin-left: -5px;
	margin-right: 0;
}

.widget-flickr-images img {
	height: 70px;
	width: 130px;
	padding: 5px;
}
.widget-flickr-images a:link,
.widget-flickr-images a:visited{
	<?php rb_cssall('transition-duration', '.2s'); ?>
	opacity:.5;
}
.widget-flickr-images a:hover,
.widget-flickr-images a:active{
	opacity:1;
}

/* Tags */
.widget-tags a,
.widget_tag_cloud a
 {
	font-family: <?php echo $rb_HeaderFont; ?>;
	padding: 10px;
	font-size:14px !important;
	display: inline-block;
	color: #1d1d1d;
/* animation */
	-webkit-transition-duration: .2s;
	-moz-transition-duration: .2s;
	-ms-transition-duration: .2s;
	-o-transition-duration: .2s;
	transition-duration: .2s;
}

/* Elements */
.element-pagination {
	margin-top:20px;
}

.pagination>li:first-child>a,.pagination>li:last-child>a {
	border: 0 solid #efefef;
}

.isotope-navigation .pagination>li:first-child>a,.isotope-navigation .pagination>li:last-child>a {
	border: 1px solid #efefef;
}

.pagination>li>a.active:hover {
	color: #fff;
}

.pagination>li>a,
.pagination>li>span{
	margin: 3px;
	border: 1px solid #efefef;
	font-size: 14px;
	color: <?php echo $rb_ColorFont; ?>;
}

.box-speacing {
	margin: 60px auto 30px auto;
}

.box-speacing-type-2 {
	margin: 70px auto;
	margin-bottom: 30px;
}

.box-speacing-type-min {
	margin: 40px auto;
	margin-bottom: 20px;
}

.box-speacing-type-small {
	margin: 20px auto;
	margin-bottom: 20px;
}

.box-speacing-type-minimal {
	margin: 10px auto;
	margin-bottom: 10px;
}

.speacing-box-element {
	margin: 75px auto;
}

.block-content {
	margin-top: 50px;
}

.speacing-box {
	padding-top:50px;
	/*padding-bottom:50px;*/
	padding-bottom:40px;
}

.speacing-box-form-contact {
	padding-top:50px !important;
	padding-bottom:50px !important;
}

.speacing-box-mini {
	padding: 10px 0;
	display: block;
	float: left;
	width: 100%;
}
.speacing-box-contact {
	padding: 20px 0 20px 0;
	display: block;
	float: left;
	width: 100%;
}

.speacing-box-mini div {
	margin-bottom: 10px;
}

/* contact */
#page-footer {
	position:relative;
	width: 100%;
	background-color:<?php echo $rb_BackgroundColor; ?>;
}
#page-footer p{
	color:#fff;
}

.box-contact {
	min-height: 200px;
}

.form-contact {
	max-width: 825px;
	margin: auto;
}

.form-contact input[type=text] {
	display: block;
	padding: 10px;
	border: 0;
	width: 100%;
	background: rgba(150,150,150,0.4);
	color: #fff;
}

.form-contact textarea {
	display: block;
	padding: 10px;
	border: 0;
	width: 100%;
	min-height: 150px;
	background: rgba(150,150,150,0.4);
	color: #fff;
}

.form-contact input[type=submit] {
	font-family: <?php echo $rb_HeaderFont; ?>;
	background: <?php echo $rb_ColorFirst; ?> !important;
	color: #fff;
	padding: 10px 25px;
	border: 0;
	opacity: 0.6;
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.form-contact input[type=submit]:hover {
	opacity: 1.0;
}

.copyright {
	padding: 20px;
	text-align: center;
	background: #fff;
	width: 100%;
	clear: both;
	position: relative;
	border-top: #ccc solid 1px;
	color:<?php echo $rb_ColorFont; ?> !important;
}

.pin-contact .label {
	width: 70px;
	border-radius: 50%;
	background: transparent;
	height: 70px;
	border: <?php echo $rb_ColorFirst; ?> 3px solid;
	display: inline-block;
	float: left;
/* animation */
	-webkit-transition-duration: .2s;
	-moz-transition-duration: .2s;
	-ms-transition-duration: .2s;
	-o-transition-duration: .2s;
	transition-duration: .2s;
}

.pin-contact .label span {
	color: #fff;
	font-size: 24px;
	padding: 20px 0;
	text-align: left;
}

.pin-contact .content {
	display: inline-block;
	float: left;
	margin-left: 20px;
	width: 260px;
}

.social-contact {
	padding: 40px 0;
}

.social-contact a:link,
.social-contact a:visited{
	z-index:9999;
	border-radius: 50%;
	display: inline-block;
	margin: 0 20px;
	border: transparent 3px solid;
	opacity: .7;
/* animation */
	-webkit-transition-duration: .2s;
	-moz-transition-duration: .2s;
	-ms-transition-duration: .2s;
	-o-transition-duration: .2s;
	transition-duration: .2s;
}

.social-contact a:hover,
.social-contact a:active{
	border: #fff 3px solid;
	opacity: .99;
	filter: Alpha(Opacity=100);
}

.image-hover {
	position: relative;
}

.image-hover:hover .wrapper {
	opacity: 0.7;
}

.image-hover:hover .link {
	opacity: 1;
}

.image-hover .wrapper {
	opacity: 0;
	height: 100%;
	width: 100%;
	position: absolute;
	background: #000;
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.image-hover .link {
	position: absolute;
	left: 50%;
	top: 50%;
	padding: 10px;
	border-radius: 50%;
	font-family: FontAwesome;
	color: #fff;
	opacity: 0;
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.frame-blog:first-child {
	position: relative;
	margin-top: 0;
}

.frame-blog {
	position: relative;
	margin-top: 60px;
}

.close-contact:after {
	position: absolute;
	border-bottom: 50px #fff solid;
	border-left: 100px transparent solid;
	border-right: 100px transparent solid;
	border-top: 50px transparent solid;
	left: 50%;
	content: "";
}

.close-contact {
	position: absolute;
	left: 50%;
	width: 200px;
	height: 100px;
	margin-left: -200px;
	top: -100px;
}

.close-contact .arrow {
	position: absolute;
	bottom: 10px;
	left: 100%;
	margin-left: -5px;
	color: <?php echo $rb_ColorFont; ?>;
	z-index: 9;
	font-size: 18px;
}

.close-contact .arrow span {
	cursor: pointer;
}

.BRANDS {
	text-align: center;
	padding: 0 20px;
	min-height: 120px;
	opacity: 1;
	text-align: center;
	position: relative;
	height: 150px;
	line-height: 150px;
	padding-right: 1.4433%;
	border-right:1px solid #e3e3e3;
}
.BRANDS.last-col{
	border-right:0;
}
.BRANDS.not-first-row{
	border-top:1px solid #e3e3e3;
}

.BRANDS img {
	filter: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.1111 0.1111 0.1111 0 0 0.1111 0.1111 0.1111 0 0 0.1111 0.1111 0.1111 0 0 0 0 0 1 0\'/></filter></svg>#grayscale');
/* Firefox 3.5+ */
	filter: gray;
/* IE6-9 */
	-webkit-filter: grayscale(100%);
/* Chrome 19+ & Safari 6+ */
	-webkit-transition: all .5s ease-in-out;
	-moz-transition: all .5s ease-in-out;
	-o-transition: all .5s ease-in-out;
	transition: all .5s ease-in-out;
}

.BRANDS img:hover {
	filter: none;
	-webkit-filter: grayscale(0%);
	cursor: pointer;
	-webkit-transition: all .5s ease-in-out;
	-moz-transition: all .5s ease-in-out;
	-o-transition: all .5s ease-in-out;
	transition: all .5s ease-in-out;
}

/* blog */
.single-blog {
	position: relative;
}

.sticky{
	border:1px solid <?php echo $rb_ColorFirst; ?>;
	padding:15px;
}

article.post dl dd{
	margin-bottom:20px;
}
.frame-blog .icon-type,.single-blog .icon-type {
	background: #222;
	padding: 8px 11px;
	width: 40px;
	text-align: center;
	color: #fff;
	display: inline-block;
	position: absolute;
	top: 0;
	z-index: 7;
	left: 0;
}

.frame-blog .date,.single-blog .date {
	width: 40px;
	text-align: center;
	background: #222;
	padding: 5px;
	color: #fff;
	clear: both;
	display: inline-block;
	position: absolute;
	top: 36px;
	z-index: 7;
	left: 0;
}

.frame-blog .date .month,.single-blog .date .month {
	display: block;
	font-size: 8px;
	line-height: 5px;
	padding-top: 3px;
	padding-bottom: 2px;
}

.frame-blog .date .day,.single-blog .date .day {
	text-align: center;
	display: block;
	font-weight: 500;
	font-size: 16px;
	line-height: 16px;
}

.frame-blog .content {
	border-left: 1px #aaa solid;
	min-height: 100px;
	padding-bottom: 30px;
	margin-top: 0;
	padding-left: 50px;
}

.frame-blog .content .title,.single-blog .content .title {
	padding: 20px 0;
}

.frame-blog .content .description,.single-blog .content .description {
	line-height: 26px;
	font-size: 12px;
	font-weight: 500;
}

.frame-blog .content .message p {
	color: <?php echo $rb_ColorFont; ?>;
}

.frame-blog .content .title h3,.single-blog .content .title h3 {
	margin: 0;
	font-family: <?php echo $rb_HeaderFont; ?>;
}

.frame-blog .readmore a.readmore {
	font-family: <?php echo $rb_HeaderFont; ?>;
	padding: 10px 25px;
	top: -10px;
	position: relative;
	opacity: 0.6;
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.frame-blog .readmore a.readmore:hover {
	opacity: 1.0;
}

.avatar-80 {
	border-radius: 50%;
	width: 80px;
	height: 80px;
}

.frame-blog > .readmore:after {
	position: absolute;
	content: "";
	border-top: 1px #aaa solid;
	display: block;
	width: 50px;
	left: 0;
	top: 0;
}

.frame-blog > .readmore {
	position: relative;
	padding-left: 50px;
}

.frame-blog .content.type-quote .title{
	padding: 0;
	padding-bottom: 20px;
}

.single-blog .content.type-quote .title{
	padding:0;
	padding-left: 50px;
	padding-bottom: 40px;
}

.slider_flexslider ul{ margin:0; padding:0; }
.slider_flexslider li { opacity:0; }
.carousel_flexslider { opacity:0; }


.frame-blog .video video,
.single-blog .video video{
	background-color: #CCCCCC;
}

.frame-blog .gallery .type-sound .sound,.single-blog .gallery .type-sound .sound {
	padding: 30px 70px;
	text-align: center;
	background: #ccc;
}

.frame-blog .gallery .type-sound .sound iframe,.single-blog .gallery .type-sound .sound iframe {
	border: 0;
	width: 100%;
	min-height: 166px;
}

/* detail blog */
ol.commentlist, ol.commentlist ul{
	list-style:none;
	padding-left:0;
}
.comment {
	margin-top: 40px;
}

.comment .children {
	padding-left: 40px;
}

.commentlist div.avatar {
	float: left;
	margin-right: 15px;
}

.meta {
	list-style: none;
	margin: 0 0 13px;
	padding: 0;
	overflow: hidden;
	font-size: 12px;
	line-height: 14px;
	color: <?php echo $rb_ColorFont; ?>;
}

.meta h5 {
	margin-top: 0;
	margin-bottom: 5px;
	font-size: 18px;
	font-weight: 300;
}

.meta div {
	font-size: 13px;
}

.comment-reply-link {
	margin-right: 15px;
}

.commentlist .the-comment .comment-text {
	margin-left: 69px;
}

.commentlist .the-comment {
	padding-bottom: 20px;
}

.reply {
	float: right;
	text-align: left;
}

#comment-input {
	overflow: hidden;
	margin-bottom: 13px;
}

#comment-input .input {
	padding-top: 10px;
}

#comment-input input {
	border: 1px solid #d2d2d2;
	font-size: 13px;
	color: #747474;
	-webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
	-moz-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
	box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
	padding: 8px 2%;
	float: left;
	width: 100%;
}

.comment-respond .form {
	padding-bottom: 10px;
}

#comment-input .input label,.instant-message label {
	font-weight: 300;
}

#comment-textarea {
	margin-top: 30px;
}

#comment-textarea textarea {
	border: 1px solid #d2d2d2;
	width: 100%;
	height: 150px;
	font-size: 13px;
	color: #747474;
	-webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
	-moz-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
	box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
	padding: 8px 11px;
}

.comment-respond {
	display: block;
	margin-top: 40px;
}
.woocommerce #reviews h3,
.woocommerce-page #reviews h3{
	margin-top:10px;
}
#commentform {
	margin-top: 30px;
}

#submit {
	border: 0;
	margin-top: 20px;
}

.Owl-Slider-Blog .owl-pagination {
	position: absolute;
	bottom: 10px;
	right: 40px;
}

.Owl-Slider-Blog {
	position: relative;
}

.owl-controls .owl-page span {
	background: #fff !important;
	filter: Alpha(Opacity=100);
	opacity: 1;
	width: 8px;
	height: 8px;
	border: 2px solid transparent;
}

.owl-controls .owl-page {
	padding: 5px 0;
}

.owl-controls .owl-page.active span {
	border: 2px solid #fff;
	width: 12px;
	height: 12px;
}

.testimonials-arrow{
	margin:0 20px;
}

/* About */
.slide-about {
	position: relative;
}

.about-score h3{
	font-size:60px;
	font-weight:700;
	color:<?php echo $rb_ColorFirst; ?> ;
}
.about-score h4{
	font-size:16px;
}

.hi-icon-effect-3b h3 {
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.thumbnail-icon-about i {
	border-radius: 25px;
	border: 2px solid <?php echo $rb_ColorFirst; ?>;
	font-size: 45px;
	width: 130px;
	height: 130px;
	line-height: 120px;
	text-align: center;
/* animation */
	-webkit-transition-duration: .2s;
	-moz-transition-duration: .2s;
	-ms-transition-duration: .2s;
	-o-transition-duration: .2s;
	transition-duration: .2s;
}

.thumbnail-icon-about i:hover {
	background: <?php echo $rb_ColorFirst; ?>;
	box-shadow: 5px 5px 10px <?php echo $rb_ColorFirstAlpha; ?>;
	color: #fff;
	font-size: 40px;
}

.Owl-Slider-about {
	margin: 8%;
	margin-top: 7%;
	padding-bottom: 0;
	padding-top: 5%;
	position: absolute;
	background: url('<?php echo $rb_imagesDir; ?>pattern.jpg');
	top: 0;
	width: 84%;
	height: 70%;
}

/* services */
.thumbnail-services {
	padding: 0;
	margin: 4px;
	margin-right: 20px;
	margin-bottom: 10px;
	line-height: 54px;
/* animation */
	-webkit-transition-duration: .2s;
	-moz-transition-duration: .2s;
	-ms-transition-duration: .2s;
	-o-transition-duration: .2s;
	transition-duration: .2s;
}

.box-services {
	padding-top: 10px;
}

.chart {
	position: relative;
}


.chart .percents {
	position: absolute;
	top: 50%;
	left: 0px;
	right:0px;
	text-align:center;
	width: 110px;
	height: 75px;
	border-radius: 50%;
	margin-top: -37.5px;
	margin-left: auto;
	margin-right:auto;
	padding-top: 3px;
	font-size: 40px;
	color: #d2d4d8;
	font-family: <?php echo $rb_HeaderFont; ?>;
}


/* portfolio */
.Owl-Slider-Portfolio {
	position: relative;
}

.detail-portfolio {
	position: relative;
}

.detail-portfolio i.close {
	position: absolute;
	right: 0;
	top: 0;
	font-size: 30px;
	opacity: 1;
	right:-10px;
	top:-5px;
}


.portfolio-arrow {
	position: absolute;
	background: rgba(0,0,0,0.6);
	z-index: 5;
	color: #fff;
	padding: 10px 20px;
	font-size: 24px;
}

.portfolio-arrow.fa-angle-left {
	left: 15px;
	top: 50%;
	margin-top: -30px;
}

.portfolio-arrow.fa-angle-right {
	right: 15px;
	top: 50%;
	margin-top: -30px;
}

.window-portfolio{
	display:none;
}

.window-portfolio h3 {
	margin-top: 0;
}

/* header */
.video-parallax {
	position: relative;
}

.Owl-Slider {
	position: relative;
}

.Owl-Slider .owl-pagination {
	position: relative;
	margin-top: -100px;
	top: -50px;
}

.Logo-home {
	position: absolute;
	width: 100%;
	text-align: center;
	z-index: 999;
}

.mediumlarge_light_white_center {
	font-weight: 700 !important;
}

#top_section .owl-item h1, #top_section .upper {
	text-transform: uppercase;
	font-weight: 500;
	font-size: 42px;
	color:#fff;
}

#top_section .owl-item p {
	color:#fff;
	text-transform: uppercase;
}

.navbar {
	margin-bottom: 0 !important;
}

.logo.mobile {
	padding-left: 20px;
}

.content-video {
	position: absolute;
}

.control-down {
	display: block;
	position: absolute;
	z-index: 999;
	text-align: center;
	width: 100%;
}

.control-sound {
	display: block;
	position: relative;
	z-index: 5;
	text-align: center;
}

/* ourteam */
.ourteam-box{
	position:relative;
}

.ourteam-box-thumbnail{
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
}
.ourteam-box-container{
	position:relative;
	width:100%;
	height:100%;
	padding:15px 25px;
}
.ourteam-box-thumbnail{
	background-color:#f6f6f6;
	<?php rb_cssall('transition', 'all', '.4s', 'ease-out'); ?>
	<?php rb_cssall('transform', 'scale(0.3)'); ?>
}
.ourteam-box .thumbnail-img-hidden img{
	opacity:0;
	width:100%;
	height:auto;
}
.ourteam-box .thumbnail-img-ourteam img{
	<?php rb_cssall('transition', 'all', '.4s', 'ease-out'); ?>
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
}

.ourteam-box figcaption{
	position:absolute;
	bottom:30px;
	width:100%;
	padding:0 50px 15px 0;
}
.option-social{
	position:absolute;
	left:0;
	bottom:0;
	width:100%;
}
.option-social a:link,
.option-social a:visited{
	display:inline-block;
	width:33.3%;
	height:30px;
}
.option-social a:link:before,
.option-social a:visited:before{
	font-family:FontAwesome;
	line-height:30px;
	text-align:center;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	color:#fff;
}
.option-social a.facebook{ 	background-color:#3d599b; }
.option-social a.facebook:before{ content:'\f09a'; }
.option-social a.twitter{ background-color:#5cadff; }
.option-social a.twitter:before{ content:'\f099'; }
.option-social a.googleplus{ background-color:#fd4142; }
.option-social a.googleplus:before{ content:'\f0d5'; }

.ourteam-box:hover .thumbnail-img-ourteam img{
	width:30%;
	height:30%;
	left:35%;
	top:85px;
}

.ourteam-box:hover .ourteam-box-thumbnail{
	opacity:1;
	<?php rb_cssall('transform', 'scale(1)'); ?>
}


/* Portfolio */
.pagination>li:first-child>a,.pagination>li:first-child>span,.pagination>li:last-child>a,.pagination>li:last-child>span {
	margin-left: 0;
	border-bottom-left-radius: 0;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
}

.thumbnail-portfolio:hover .figcaption {
	opacity: 1.0;
	bottom: 0;
}

.thumbnail-portfolio:hover .button-portfolio a {
	opacity: 1.0;
}

.thumbnail-portfolio:hover .button-portfolio {
	margin-top: -45px;
}

.thumbnail-portfolio:hover .wrapper-black {
	opacity: 0.8;
}

.thumbnail-portfolio .wrapper-black {
	opacity: 0;
	height: 100%;
	width: 100%;
	z-index: 0;
	position: absolute;
	top: 0;
	min-height: 200px;
	background:<?php echo $rb_ColorFirst; ?>;
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.button-portfolio {
	position: absolute;
	z-index: 3;
	top: 50%;
	font-size: 20px;
	margin-top: -65px;
	left: 50%;
	margin-left: -50px;
/* animation */
	-webkit-transition-duration: .6s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.button-portfolio a {
	text-decoration:none;
	font-family: FontAwesome !important;
	display: inline-block;
	padding: 5px;
	border-radius: 50%;
	border: 5px solid transparent;
	margin-right: 20px;
	opacity: 0.0;
/* animation */
	-webkit-transition-duration: .5s;
	-moz-transition-duration: .6s;
	-ms-transition-duration: .6s;
	-o-transition-duration: .6s;
	transition-duration: .6s;
}

.button-portfolio a:focus{
	outline: none;
}

.button-portfolio a:hover {
	padding: 15px;
	margin-left: -10px;
}

.thumbnail-portfolio{
	padding:0 5px 5px 5px;
}
.thumbnail-portfolio figure{
	position:relative;
}
.thumbnail-portfolio figure > img{
	width:100%;
	height:auto;
}
.thumbnail-portfolio .figcaption {
	position: absolute;
	width: 100%;
	bottom: -20%;
	z-index: 1;
	opacity: 0;
/* animation */
	-webkit-transition-duration: .4s;
	-moz-transition-duration: .4s;
	-ms-transition-duration: .4s;
	-o-transition-duration: .4s;
	transition-duration: .4s;
}

.thumbnail-portfolio .figcaption p {
	padding: 0;
	margin: 0;
}

.thumbnail-portfolio .figcaption .like p {
	padding: 0;
	margin: 2px 0;
}
.votedIcon{ opacity:.5; }

.thumbnail-portfolio .figcaption h4 {
	padding: 5px 0;
	margin: 0;
}


.thumbnail-portfolio .like {
	width: 60px;
	min-height: 20px;
	text-align: center;
	padding: 10px 0;
	background: #fff;
	color: #fff;
	float: left;
}

.thumbnail-portfolio .caption {
	text-align: center;
	padding: 6px 0;
}

/**** Isotope Filtering ****/
.isotope-item {
	z-index: 2;
}

.isotope-hidden.isotope-item {
	pointer-events: none;
	z-index: 1;
}

/**** Isotope CSS3 transitions ****/
.isotope,.isotope .isotope-item {
	-webkit-transition-duration: .8s;
	-moz-transition-duration: .8s;
	-ms-transition-duration: .8s;
	-o-transition-duration: .8s;
	transition-duration: .8s;
}

.isotope {
	-webkit-transition-property: height, width;
	-moz-transition-property: height, width;
	-ms-transition-property: height, width;
	-o-transition-property: height, width;
	transition-property: height, width;
}

.isotope .isotope-item {
	-webkit-transition-property: 0 opacity;
	-moz-transition-property: 0 opacity;
	-ms-transition-property: 0 opacity;
	-o-transition-property: 0 opacity;
	transition-property: transform, opacity;
}

/**** disabling Isotope CSS3 transitions ****/
.isotope.no-transition,.isotope.no-transition .isotope-item,.isotope .isotope-item.no-transition {
	-webkit-transition-duration: 0;
	-moz-transition-duration: 0;
	-ms-transition-duration: 0;
	-o-transition-duration: 0;
	transition-duration: 0;
}

/*******************************************************************************
                -	BULLETS AND ARROWS ADD ONS TO THE EXISTING VERSION 	-
*******************************************************************************/
.tp-bannertimer {
	background: #777;
	background: rgba(0,0,0,0.1);
	height: 5px !important;
}

.tp-bullets.simplebullets.navbar {
	height: 35px;
	padding: 0;
}

.tp-bullets.simplebullets .bullet {
	cursor: pointer;
	position: relative !important;
	background: rgba(0,0,0,0.5) !important;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	width: 6px !important;
	height: 6px !important;
	border: 5px solid rgba(0,0,0,0) !important;
	display: inline-block;
	margin-right: 2px !important;
	margin-bottom: 14px !important;
	-webkit-transition: background-color .2s border-color .2s;
	-moz-transition: background-color .2s border-color .2s;
	-o-transition: background-color .2s border-color .2s;
	-ms-transition: background-color .2s border-color .2s;
	transition: background-color .2s border-color .2s;
	float: none !important;
}

.tp-bullets.simplebullets .bullet.last {
	margin-right: 0;
}

.tp-bullets.simplebullets .bullet:hover,.tp-bullets.simplebullets .bullet.selected {
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	background: rgba(255,255,255,1) !important;
	width: 6px !important;
	height: 6px !important;
	border: 5px solid rgba(0,0,0,1) !important;
}

.tparrows:before {
	font-family: FontAwesome;
	color: #fff;
	font-style: normal;
	font-weight: 400;
	speak: none;
	display: inline-block;
	text-decoration: inherit;
	margin-right: 0;
	margin-top: 9px;
	text-align: center;
	width: 40px;
	font-size: 20px;
}

.tparrows {
	cursor: pointer;
	background: rgba(0,0,0,0.5) !important;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	width: 43px !important;
	height: 45px !important;
}

.tparrows:hover {
	color: #fff;
}

.tp-leftarrow:before {
	content: '\f053';
}

.tp-rightarrow:before {
	content: '\f054';
}

.tparrows.tp-rightarrow:before {
	margin-left: 1px;
}

.tparrows:hover {
	background: rgba(0,0,0,1) !important;
}

/* flexslider */
.carousel_flexslider {
	opacity:0;
	position: absolute;
	bottom: 20px;
	z-index: 6;
	left: 30px;
}

.carousel_flexslider li {
	margin: 5px;
}

.type-gallery {
	position: relative;
}

/******************************
        -	SLIDER NAV STYLE DEMOS	-
********************************/

#slider4container .tparrows:before,#slider4container .tparrows:hover,#slider4container .tparrows {
	color: #000 !important;
}

#slider4container .tparrows {
	background: #fff !important;
	background: rgba(255,255,255,0.5) !important;
}

#slider4container .tparrows:hover {
	background: #fff !important;
}

.tp-bullets.simplebullets .bullet.selected {
	border: 2px solid #fff !important;
	width: 12px !important;
	height: 12px !important;
	background: <?php echo $rb_ColorFirst; ?> !important;
}

.tp-bullets.simplebullets .bullet {
	background: #fff !important;
}

.isotope-container {
	margin: auto;
}

.window-portfolio .loading,
.window-portfolio .success,
.portfolio-wrapper .loading,
.portfolio-wrapper .success,
#page-footer .loading,
#page-footer .success{
	position:relative;
	z-index:3;
	display: none;
}

.window-portfolio .loading,
.window-portfolio .success,
#page-footer .loading,
#page-footer .success,
.portfolio-wrapper .loading,
.portfolio-wrapper .success {
	width:60%;
	margin:0 auto;
	padding:30px 20px;
	background:<?php echo $rb_ColorFirst; ?>;
	color:#fff;
	border:5px solid #fff;
	text-align:center;
	font-family:<?php echo $rb_HeaderFont; ?>;
	font-size:20px;
}

.thumbnail-portfolio { width:25%; }
@media only screen and   (min-width: 480){
	.thumbnail-portfolio { width: 50%; }
}
@media only screen and   (min-width: 1024){
	.thumbnail-portfolio { width: 33%; }
}
@media only screen and  (min-width: 1200px){
	.thumbnail-portfolio { width: 25%; }
}
@media only screen and  (min-width: 1600px){
	.thumbnail-portfolio { width: 20%; }
}


.error::-webkit-input-placeholder {
/* WebKit browsers */
	color: #c23f3f;
}

.error:-moz-placeholder {
/* Mozilla Firefox 4 to 18 */
	color: #c23f3f;
}

.error::-moz-placeholder {
/* Mozilla Firefox 19+ */
	color: #c23f3f;
}

.error:-ms-input-placeholder {
/* Internet Explorer 10+ */
	color: #c23f3f;
}

div.tp-caption {
	width: 100%;
	text-align: center;
	/* left: initial; */
}

/* bootstrap elements */
.tab-content > .tab-pane{
	padding:15px;
}

.panel-group{
	padding-top:5px;
}
.panel-group .panel{
	border-radius:0;
}

.panel{
	border-radius:0;
	box-shadow:none;
}

.panel-title{
	font-size:16px;
	border:none;
}

.panel-default{
	background:none;
	border:none;
}

.panel-default > .panel-heading {
	padding:0px;
	background:none;
	border:none;
}

.panel-title:before{
	<?php rb_cssall('transition', '.3s'); ?>
	display:inline-block;
	width:40px;
	height:40px;
	background-color:<?php echo $rb_ColorFont; ?>;
	border-radius:50%;
	font-family:Fontawesome;
	content:'\f067';
	line-height:40px;
	text-align:center;
	color:#fff;
	margin-right:20px;
}

.panel-body{
	border:none !important;
	padding:8px 15px 0px 60px;
}
.panel-body, .panel-body p{
	font-size:14px;
}

.panel-heading:hover .panel-title:before{
	background-color:<?php echo $rb_ColorFirst; ?>;
}
.panel-group .panel + .panel{
	margin-top:15px;
}

.panel-default > .panel-heading:hover {
	/*background:#eee;*/
}

.panel-default.active > .panel-heading,
.panel-default.active > .panel-heading:hover {
	/*background:<?php echo $rb_ColorFirst; ?>;
	color:#fff;
	border-radius:0;*/
	border:none;
}
.panel-default.active .panel-title:before{
	background-color:<?php echo $rb_ColorFirst; ?>;
	content:'\f068';
}

.panel-primary > .panel-heading{
	border-radius:0;
}

.alert{
	border-radius:0;
}

.list-group-item:first-child{
	border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}
.list-group-item:last-child {
	border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
}

.list-group{
	border-radius:0;
	box-shadow:none;
}

.btn{
	border-radius:0;
}
.btn-margin{
	margin:5px;
}

/* extras */

#about .heading h2, #ourteam .heading h2, #services .heading h2, #portfolio .heading h2 {
	font-size: 36px;
	font-weight: 500;
}

.head-sub {
	font-family:<?php echo $rb_NormalFont; ?>;
	font-weight:600;
}

#about h3 {
	font-size: 20px;
}

/*#page-footer, */
#top_section {
	position: relative;
}

#page-footer #background, #top_section #background,
.rainy-background, .footer-background {
	width: 100%;
	height: 100%;
	position: absolute;
}

#top_section article {
	position: relative;
	z-index: 1;
	color: #fff;
}

#page-footer article {
	position: relative;
	z-index: 1;
	color: #fff;
}

#page-footer h2,#page-footer .description {
	color: #fff;
}

#page-footer .heading:after {
	border-bottom-color: #fff;
}

.audio-plr {
	display: table;
	height: 40px;
	width: 40px;
	position: relative;
	top: -150px;
	z-index: 100;
	margin: 0 auto;
	margin-bottom: -40px;
}

.audio-plr2 {
	top: -120px;
}

#jp_container_1 a {
	display: table;
	font-size: 0;
}

.player {
	display: inline-block;
	vertical-align: top;
	position: relative;
	width: 500px;
	height: 350px;
	margin-top: 100px !important;
	left: 0;
	overflow: hidden;
	border-radius: 4px;
	-moz-box-shadow: 0 0 10px rgba(0,0,0,.5);
	box-shadow: 0 0 10px rgba(0,0,0,.5);
}

.body-wrapper {
position:relative;
width:100%;
overflow:hidden;
}

.body-loading{
	position:fixed;
	left:0;
	right:0;
	top:0;
	bottom:0;
	display:table;
	width:100%;
	height:100%;
	background:#fff;
	z-index:999999;
}
.body-loading > div{
	display:table-cell;
	vertical-align:middle;
	text-align:center;
}

.bubblingG span {
	display: inline-block;
	vertical-align: middle;
	width: 10px;
	height: 10px;
	margin: 25px 2px;
	background: <?php echo $rb_ColorFirst; ?>;
	-moz-border-radius: 50px;
	-moz-animation: bubblingG 1s infinite alternate;
	-webkit-border-radius: 50px;
	-webkit-animation: bubblingG 1s infinite alternate;
	-ms-border-radius: 50px;
	-ms-animation: bubblingG 1s infinite alternate;
	-o-border-radius: 50px;
	-o-animation: bubblingG 1s infinite alternate;
	border-radius: 50px;
	animation: bubblingG 1s infinite alternate;
}

#bubblingG_1 {
	-moz-animation-delay: 0s;
	-webkit-animation-delay: 0s;
	-ms-animation-delay: 0s;
	-o-animation-delay: 0s;
	animation-delay: 0s;
}

#bubblingG_2 {
	-moz-animation-delay: 0.3s;
	-webkit-animation-delay: 0.3s;
	-ms-animation-delay: 0.3s;
	-o-animation-delay: 0.3s;
	animation-delay: 0.3s;
}

#bubblingG_3 {
	-moz-animation-delay: 0.6s;
	-webkit-animation-delay: 0.6s;
	-ms-animation-delay: 0.6s;
	-o-animation-delay: 0.6s;
	animation-delay: 0.6s;
}


.fa{
	font-family: FontAwesome !important;
}
.fa.highlight:before{
	color: <?php echo $rb_ColorFirst; ?>;
}


/* Color Changes */
.bg-color {
    background-color: <?php echo $rb_ColorFirst; ?>!important;
}

.widget-title {
    color: <?php echo $rb_ColorFirst; ?>;
}

.list-menu a:hover {
    background: <?php echo $rb_ColorFirst; ?>;
    color: #fff;
}

a {
    color: <?php echo $rb_ColorFirst; ?>;
}

.navbar-toggle .icon-bar {
    background-color: <?php echo $rb_ColorFirst; ?>;
}

.button-portfolio a {
    background:<?php echo $rb_ColorFirst; ?>!important;
    color:#fff;
}

.thumbnail-portfolio .like span {
    color:<?php echo $rb_ColorFirst; ?>!important;
}

.tp-bannertimer {
    background:<?php echo $rb_ColorFirst; ?>!important;
    z-index: 20!important;
}

.top-navigation-inner .menu-top li a:hover , .font-color {
    color:<?php echo $rb_ColorFirst; ?>;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    background:<?php echo $rb_ColorFirst; ?>;
    border:0px;
    border-bottom: 1px solid <?php echo $rb_ColorFirst; ?>;
    color:#fff;

    border-radius: 0;
}

.thumbnails .label .date {
    color:<?php echo $rb_ColorFirst; ?>;
    line-height: 24px;
}

.button-portfolio a:hover {
    border:5px solid <?php echo $rb_ColorFirst; ?>;
}

.owl-controls .owl-page.active span , .single-blog .icon-type {
    background:<?php echo $rb_ColorFirst; ?>!important;

}

.widget-tags a:hover , .frame-blog .date , .frame-blog .readmore a.readmore {
    font-family: <?php echo $rb_HeaderFont; ?>;
    background:<?php echo $rb_ColorFirst; ?>!important;
    color:#fff;
}

.pin-contact .label:hover {
    background:<?php echo $rb_ColorFirst; ?>;
    border-color: #fff;
}

.pagination a.active {
    background: <?php echo $rb_ColorFirst; ?>!important;
    color:#fff;
}

.button-q {
    font-family: <?php echo $rb_HeaderFont; ?>;
    background: <?php echo $rb_ColorFirst; ?>!important;
    color: #fff;
    padding: 10px 20px;
}

.thumbnail-services span {
    font-size: 25px;
}

.box-services:hover .thumbnail-services span {
    color:#fff;
}

.box-services:hover .thumbnail-services {
    color: <?php echo $rb_ColorFirst; ?>!important;
}

.hover-font-color:hover {
    color: <?php echo $rb_ColorFirst; ?>!important;
}

.option-social {
    border-color:<?php echo $rb_ColorFirst; ?>!important;
}

.hi-icon-effect-3b div:hover h3 {
    color: <?php echo $rb_ColorFirst; ?>;
}

.thumbnail-portfolio figcaption {
    background:<?php echo $rb_ColorFirst; ?>;
}

.thumbnail-icon-about img {
    border: 3px solid <?php echo $rb_ColorFirst; ?>;
}

.form-contact input[type="submit"] {
    background: <?php echo $rb_ColorFirst; ?>!important;
	border-radius:20px;
}

.pin-contact .label {
    border-color: <?php echo $rb_ColorFirst; ?>;
}

.tp-bullets.simplebullets .bullet.selected {
    background: <?php echo $rb_ColorFirst; ?>!important;
}

.thumbnail-icon-about img:hover {
    background: <?php echo $rb_ColorFirst; ?>;
    box-shadow: 5px 5px 10px <?php echo $rb_NormalFont; ?> ;
}

/** WooCommerce **/
.woocommerce .products ul,
.woocommerce ul.products,
.woocommerce-page .products ul,
.woocommerce-page ul.products{
	margin-left: -15px;
    margin-right: -15px;
}
.woocommerce ul.products li.product,
.woocommerce-page ul.products li.product{
	min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
	margin:0;
    position: relative;
	float: left;
	width:33%;
	padding-bottom:30px;
}
.woocommerce ul.products li.last,
.woocommerce-page ul.products li.last{
}
.woocommerce ul.products li.first,
.woocommerce-page ul.products li.first{
}


.woocommerce-result-count{
	float:none !important;
	margin: 0 0 10px !important;
	text-align: center;
	font-family: <?php echo $rb_NormalFont; ?>;
}

/* orderby button */
.rb_woo_order{
	display:inline-block;
}

.rb_woo_order,
.rb_woo_order ul,
.rb_woo_order li{
	list-style:none;
	margin: 0;
	padding: 0;
}
.rb_woo_order > li{
	position:relative;
}
.rb_woo_order li ul li a,
.rb_woo_order > li > span
{
	text-align:left;
	display:block;
	font-size: 14px;
	color:<?php echo $rb_ColorFont; ?>;
	font-size:14lpx;
	line-height:2;
	text-decoration:none;
	padding: 6px 12px;
}
.rb_woo_order li ul li{
	text-align:left;
	border-bottom: 1px solid #EFEFEF;
}
.rb_woo_order > li > span{
	border: 1px solid #EFEFEF;
}
.rb_woo_order li span .arrow:before{
	padding-left:10px;
	font-family: FontAwesome;
	content: "\f107";
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
.rb_woo_order > li > ul{
	<?php rb_cssall('transition', 'all','.4s','ease-out'); ?>
	height:0px;
	overflow:hidden;
	opacity:0;
	position:absolute;
	top:100%;
	z-index:2;
	background:#fff;
	box-shadow: 0 6px 14px 0 rgba(0,0,0,0.1);
	width:200px;
	margin-top:-1px;
	border-top: 1px solid #EFEFEF;
	border-left: 1px solid #EFEFEF;
	border-right: 1px solid #EFEFEF;
}
.rb_woo_order li:hover ul{
	overflow:visible;
	height:auto;
	opacity:1;
}
.rb_woo_order li ul li:hover{
	background-color:#EFEFEF;
}
.rb_woo_order li ul li:hover a{
	color:<?php echo $rb_ColorFirst; ?>;
}

/* Shop Page */
.woocommerce #content input.button,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce-page #content input.button,
.woocommerce-page #respond input#submit,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button{
	<?php rb_cssall('transition', 'all', '.3s'); ?>
	display:block;
	background:none;
	background-color:#fff;
	text-align:center;
	box-shadow:none;
	border: 1px solid #EFEFEF;
	font-family:<?php echo $rb_HeaderFont; ?>;
	color:<?php echo $rb_ColorFont; ?>;
	font-weight:normal;
	padding:15px 15px;
	border-radius:0;
	text-transform:uppercase;
	white-space:normal;
	text-shadow:none;
}

.woocommerce #content input.button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce-page #content input.button:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce-page a.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-page input.button:hover {
    background: <?php echo $rb_ColorFirst; ?>;
	color: #fff;
    text-decoration: none;
}

.woocommerce .type-product a.button:before{
	font-family:FontAwesome;
	content:"\f07a";
	padding-right:10px;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
.woocommerce #content input.button.added:before,
.woocommerce #respond input#submit.added:before,
.woocommerce a.button.added:before,
.woocommerce button.button.added:before,
.woocommerce input.button.added:before,
.woocommerce-page #content input.button.added:before,
.woocommerce-page #respond input#submit.added:before,
.woocommerce-page a.button.added:before,
.woocommerce-page button.button.added:before,
.woocommerce-page input.button.added:before{
	position: static;
	right:auto;
	top:auto;
	font-family:FontAwesome;
	content:"\f00c";
	padding-right:10px;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

.woocommerce ul.products li.product a,
.woocommerce-page ul.products li.product a{
	position:relative;
}
.woocommerce ul.products li.product a img,
.woocommerce-page ul.products li.product a img{
	<?php rb_cssall('transition', 'all', '.5s'); ?>
	box-shadow: none;
}

.woocommerce ul.products li.product a:hover img,
.woocommerce-page ul.products li.product a:hover img {
    box-shadow: none;
}
.woocommerce ul.products li.product a:hover .thumbnail-second,
.woocommerce-page ul.products li.product a:hover .thumbnail-second {
    opacity:1;
}
.woocommerce ul.products li.product .thumbnail-wrapper{
	position:relative;
}
.woocommerce ul.products li.product .thumbnail-second{
	position:absolute;
	opacity:0;
}
.woocommerce ul.products li.product a .thumbnail-fg{
	<?php rb_cssall('transition', 'all', '.5s'); ?>
	display:block;
	position:absolute;
	opacity:0;
	background-color:<?php echo $rb_ColorFirst; ?>;
	top:0;
	width:100%;
	height:100%;
}
.woocommerce ul.products li.product a:hover .thumbnail-fg{
	opacity:.4;
}

.woocommerce ul.products li.product h3,
.woocommerce-page ul.products li.product h3{
	text-align:center;
	font-size:18px;
	font-family:<?php echo $rb_HeaderFont; ?>;
	color: <?php echo $rb_ColorFont; ?>;
	padding: 20px 0 10px 0;
}

.woocommerce ul.products li.product .price,
.woocommerce-page ul.products li.product .price{
	text-align:center;
	font-family:<?php echo $rb_HeaderFont; ?>;
	font-size:18px;
	color:<?php echo $rb_ColorFont; ?>;
	padding: 10px 0;
}
.woocommerce ul.products li.product .price ins,
.woocommerce-page ul.products li.product .price ins{
	text-decoration:none;
}
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating{
	margin:10px auto 20px auto;
}

/* On Sale */
.woocommerce ul.products li.product .onsale,
.woocommerce-page ul.products li.product .onsale{
	left: 20px;
    margin: 0;
    top: 34px;
	right:auto;
}

.woocommerce span.onsale,
.woocommerce-page span.onsale {
    background:none;
	background-color:<?php echo $rb_ColorFirst; ?>;
    border-radius:100%;
    box-shadow: none;
    color: #FFFFFF;
    font-size: 14px;
    font-weight: normal;
    left: 20px;
    line-height: 50px;
    margin: 0;
    min-height: 50px;
    min-width: 50px;
    padding: 0px;
    text-shadow: none;
    top: 20px;
	z-index:1;
	text-transform:uppercase;
}

.woocommerce .products .star-rating:before,
.woocommerce-page .products .star-rating:before,
.woocommerce .products .star-rating span,
.woocommerce .products .star-rating span:before,
.woocommerce .products .star-rating span:after,
.woocommerce-page .products .star-rating span,
.woocommerce-page .products .star-rating span:before,
.woocommerce-page .products .star-rating span:after{
	color:#fff;
	font-size:11px;
}
.woocommerce ul.products li.product a:hover .star-rating,
.woocommerce-page ul.products li.product a:hover .star-rating{
	opacity:1;
	bottom:0;
}
.woocommerce .products .star-rating:before,
.woocommerce-page .products .star-rating:before{
	opacity:.3;
}
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	opacity:0;
	position:absolute;
	left:50%;
	bottom:-20px;
	margin-left:-27px;
	width:60px;
	padding:3px;
}

/* Pagination */
.woocommerce #content nav.woocommerce-pagination ul li,
.woocommerce nav.woocommerce-pagination ul li,
.woocommerce-page #content nav.woocommerce-pagination ul li,
.woocommerce-page nav.woocommerce-pagination ul li{
	border-right: 1px solid #EFEFEF;
}
.woocommerce #content nav.woocommerce-pagination ul,
.woocommerce nav.woocommerce-pagination ul,
.woocommerce-page #content nav.woocommerce-pagination ul,
.woocommerce-page nav.woocommerce-pagination ul{
	border-color: #EFEFEF -moz-use-text-color #EFEFEF #EFEFEF;
}

.woocommerce #content nav.woocommerce-pagination ul li a,
.woocommerce #content nav.woocommerce-pagination ul li span,
.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span,
.woocommerce-page #content nav.woocommerce-pagination ul li a,
.woocommerce-page #content nav.woocommerce-pagination ul li span,
.woocommerce-page nav.woocommerce-pagination ul li a,
.woocommerce-page nav.woocommerce-pagination ul li span{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	padding: 15px 20px;
	color:<?php echo $rb_ColorFont; ?>;
}

.woocommerce #content nav.woocommerce-pagination ul li a:focus,
.woocommerce #content nav.woocommerce-pagination ul li a:hover,
.woocommerce #content nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li a:focus,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li span.current{
	background: none repeat scroll 0 0 <?php echo $rb_ColorFirst; ?>;
    color: #fff;
}

/* WooCommerce Widgets */

.woocommerce.widget_product_tag_cloud a:link,
.woocommerce.widget_product_tag_cloud a:visited{
	font-family: <?php echo $rb_HeaderFont; ?>;
	padding: 10px;
	font-size:14px !important;
	display: inline-block;
	color: <?php echo $rb_ColorFont; ?>;
	<?php rb_cssall('transition', 'all', '.2s', 'ease-out'); ?>
}

.woocommerce.widget_product_tag_cloud a:hover,
.woocommerce.widget_product_tag_cloud a:active{
    font-family: <?php echo $rb_HeaderFont; ?>;
    background:<?php echo $rb_ColorFirst; ?>!important;
    color:#fff;
}

.widget_product_categories ul li a:link,
.widget_product_categories ul li a:visited{
	<?php rb_cssall('transition', 'all', '.2s', 'ease-out'); ?>
	display:inline-block;
	padding:6px 10px;
	color:<?php echo $rb_ColorFont; ?>;
}
.widget_product_categories ul li .count{
	float:right;
}

.widget_product_categories li a:before{
	font-family:FontAwesome;
	content:"\f105";
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	padding-right:10px;
}
.widget_product_categories ul li a:hover,
.widget_product_categories ul li a:active{
	background-color:<?php echo $rb_ColorFirst; ?>;
	color:#fff;
}
.widget_product_categories ul li ul{
	margin-left:30px;
}
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content{
	background:#efefef;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range{
	background:#d8d8d8;
	box-shadow:none;
}

.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
	background: #565656;
    border: 4px solid #d8d8d8;
    border-radius:50%;
    box-shadow: none;
    height: 22px;
	width: 22px;
    outline: 0 none;
    position: absolute;
    top:-7px;
}

.woocommerce .price_slider_wrapper,
.woocommerce-page .price_slider_wrapper{
	padding-top:20px;
}

.woocommerce .widget_price_filter .price_slider_amount,
.woocommerce-page .widget_price_filter .price_slider_amount{
	padding-top:20px;
}

.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce-page .widget_price_filter .price_slider_amount .button{
	padding: 10px;
}

.woocommerce .widget_layered_nav_filters ul li a,
.woocommerce-page .widget_layered_nav_filters ul li a{
	background: <?php echo $rb_ColorFirst; ?>;
    border: none;
    border-radius: 0;
    color: #FFFFFF;
    float: left;
    padding: 10px 10px;
    text-decoration: none;
}

.woocommerce .widget_layered_nav ul li a:before{
	font-family:FontAwesome;
	content:"\f105";
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	padding-right:10px;
}

.woocommerce .widget_layered_nav ul li a:link,
.woocommerce .widget_layered_nav ul li a:visited{
	color:<?php echo $rb_ColorFont; ?>;
	padding:5px 10px;
	width:90%;
}
.woocommerce .widget_layered_nav ul li a:hover,
.woocommerce .widget_layered_nav ul li a:active{
	color:#fff;
	background: <?php echo $rb_ColorFirst; ?>;
}

.woocommerce .widget_layered_nav ul li.chosen a,
.woocommerce-page .widget_layered_nav ul li.chosen a{
	background: <?php echo $rb_ColorFirst; ?>;
    border: none;
    border-radius: 0;
    color: #FFFFFF;
    float: left;
    padding: 5px 10px;
    text-decoration: none;
}

.woocommerce ul.cart_list li img,
.woocommerce ul.product_list_widget li img,
.woocommerce-page ul.cart_list li img,
.woocommerce-page ul.product_list_widget li img{
	box-shadow: none;
    float: none;
    height: auto;
    margin:0;
    width: 85px;
}

.woocommerce ul.cart_list li .widget-thumbnail,
.woocommerce ul.product_list_widget li .widget-thumbnail,
.woocommerce-page ul.cart_list li .widget-thumbnail,
.woocommerce-page ul.product_list_widget li .widget-thumbnail{
	position:relative;
	float:left;
	margin-right:20px;
}

.woocommerce ul.cart_list li .widget-texts,
.woocommerce ul.product_list_widget li .widget-texts,
.woocommerce-page ul.cart_list li .widget-texts,
.woocommerce-page ul.product_list_widget li .widget-texts{
	float:left;
	width:50%;
}

.woocommerce ul.cart_list li .widget-title,
.woocommerce ul.product_list_widget li .widget-title,
.woocommerce-page ul.cart_list li .widget-title,
.woocommerce-page ul.product_list_widget li .widget-title{
	color:<?php echo $rb_ColorFont; ?>;
	font-weight:normal;
	font-size:14px;
	margin-bottom:0;
}
.woocommerce .widget-thumbnail-fg,
.woocommerce-page .widget-thumbnail-fg{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	position:absolute;
	width:100%;
	height:100%;
	background-color:<?php echo $rb_ColorFirst; ?>;
	opacity:0;
	top:0;
	left:0;
}
.woocommerce ul.cart_list li .widget-thumbnail:hover .widget-thumbnail-fg,
.woocommerce ul.product_list_widget li .widget-thumbnail:hover .widget-thumbnail-fg,
.woocommerce-page ul.cart_list li .widget-thumbnail:hover .widget-thumbnail-fg,
.woocommerce-page ul.product_list_widget li .widget-thumbnail:hover .widget-thumbnail-fg{
	opacity:.4;
}
.woocommerce ul.products li.product a:hover .zubeyr-v,
.woocommerce-page ul.products li.product a:hover .zubeyr-v{
		opacity:1;
		height:100px;
		margin-top:-50px;
}
.woocommerce ul.products li.product a:hover .zubeyr-h,
.woocommerce-page ul.products li.product a:hover .zubeyr-h{
		opacity:1;
		width:100px;
		margin-left:-50px;
}
.zubeyr-v{
	<?php echo rb_cssall('transition', 'all', '.5s', 'ease-out'); ?>
	opacity:0;
	position:absolute;
	width:1px;
	background:#fff;
	height:0px;
	left:50%;
	top:50%;
	margin-left:-1px;
	margin-top:0px;
}

.zubeyr-h{
	opacity:0;
	<?php echo rb_cssall('transition', 'all', '.5s', 'ease-out'); ?>
	position:absolute;
	width:0px;
	background:#fff;
	height:1px;
	left:50%;
	top:50%;
	margin-top:-1px;
	margin-left:0px;
}

.woocommerce ul.cart_list li dl,
.woocommerce ul.product_list_widget li dl,
.woocommerce-page ul.cart_list li dl,
.woocommerce-page ul.product_list_widget li dl{
	border:none;
    margin: 0;
    padding-left: 0;
}
.woocommerce ul.cart_list li .variation *,
.woocommerce ul.product_list_widget li .variation *,
.woocommerce-page ul.cart_list li .variation *,
.woocommerce-page ul.product_list_widget li .variation *{
	font-weight:normal;
	font-size:12px;
	color:#999;
}
.woocommerce ul.cart_list li .quantity,
.woocommerce ul.product_list_widget li .quantity,
.woocommerce-page ul.cart_list li .quantity,
.woocommerce-page ul.product_list_widget li .quantity{
	color:<?php echo $rb_ColorFirst; ?>;
}
.woocommerce ul.cart_list li ins,
.woocommerce ul.product_list_widget li ins,
.woocommerce-page ul.cart_list li ins,
.woocommerce-page ul.product_list_widget li ins{
	display:block;
	text-decoration:none;
}
.woocommerce ul.cart_list li .amount,
.woocommerce ul.product_list_widget li .amount,
.woocommerce-page ul.cart_list li .amount,
.woocommerce-page ul.product_list_widget li .amount{
	color:#999;
}
.woocommerce .star-rating:before,
.woocommerce-page .star-rating:before,
.woocommerce .star-rating span:before,
.woocommerce-page .star-rating span:before{
	font-family:star;
}
.woocommerce .star-rating,
.woocommerce-page .star-rating{
	font-size:14px;
	height: 14px;
	line-height:14px;
	margin:10px 0;
}
.woocommerce .star-rating span:before,
.woocommerce-page .star-rating span:before{
	color:<?php echo $rb_ColorFirst; ?>;
	font-size:14px;
	line-height:14px;
}

.woocommerce .widget_shopping_cart .total,
.woocommerce-page .widget_shopping_cart .total,
.woocommerce-page.widget_shopping_cart .total,
.woocommerce.widget_shopping_cart .total{
	border-top:1px solid #efefef;
	padding:15px 5px;
	text-align:right;
}
.woocommerce .widget_shopping_cart .total strong,
.woocommerce-page .widget_shopping_cart .total strong,
.woocommerce-page.widget_shopping_cart .total strong,
.woocommerce.widget_shopping_cart .total strong{
	color:<?php echo $rb_ColorFirst; ?>;
	margin-right:10px;
}
.woocommerce .widget_shopping_cart .buttons a,
.woocommerce-page .widget_shopping_cart .buttons a,
.woocommerce-page.widget_shopping_cart .buttons a,
.woocommerce.widget_shopping_cart .buttons a{
	border:none;
	text-transform:none;
	float:left;
	width:50%;
	border-bottom:1px solid #efefef;
}
.wc-forward a:after, .wc-forward:after{
	font-family:FontAwesome;
	content:"\f178";
}

.woocommerce.widget_recent_reviews ul.product_list_widget li img{
	margin-right:20px;
	vertical-align:top;
}
.woocommerce.widget_recent_reviews ul.product_list_widget li a{
	color:<?php echo $rb_ColorFont; ?>;
	font-weight:normal;
}
.woocommerce.widget_recent_reviews ul.product_list_widget li{
	margin-bottom:20px;
}

/* Product Page */
.woocommerce #content div.product .woocommerce-tabs ul.tabs:before,
.woocommerce div.product .woocommerce-tabs ul.tabs:before,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before,
.woocommerce-page div.product .woocommerce-tabs ul.tabs:before{
	border:none;
}
.woocommerce #content div.product .woocommerce-tabs ul.tabs,
.woocommerce div.product .woocommerce-tabs ul.tabs,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs,
.woocommerce-page div.product .woocommerce-tabs ul.tabs{
	background-color:#f8f8f8;
}
.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active:before,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active:before,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active:before,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active:before{
	box-shadow:none !important;
}

.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active:after,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active:after,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active:after {
    box-shadow:none !important;
}

.woocommerce #content div.product .woocommerce-tabs ul.tabs li:before,
.woocommerce div.product .woocommerce-tabs ul.tabs li:before,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:before,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li:before {
	border-radius:0;
    border:0;
    box-shadow: none !important;
    left: 0px;
}

.woocommerce #content div.product .woocommerce-tabs ul.tabs li:after,
.woocommerce #content div.product .woocommerce-tabs ul.tabs li:before,
.woocommerce div.product .woocommerce-tabs ul.tabs li:after,
.woocommerce div.product .woocommerce-tabs ul.tabs li:before,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:after,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:before,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li:after,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li:before {
	border: none;
    bottom: 0px;
    content: " ";
    height: 0px;
    position: absolute;
    width: 0px;
}

.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
.woocommerce div.product .woocommerce-tabs ul.tabs li,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li {
	background: none;
    border: none;
    border-radius:0;
    box-shadow:none;
    margin: 0;
    padding: 7px 20px;
}

.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active {
	background-color: <?php echo $rb_ColorFirst; ?>;
	color:#fff;
}

.woocommerce #content div.product .woocommerce-tabs ul.tabs,
.woocommerce div.product .woocommerce-tabs ul.tabs,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs,
.woocommerce-page div.product .woocommerce-tabs ul.tabs {
	padding:0;
	margin-bottom:0;
}

.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
.woocommerce div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a{
	font-weight:normal;
	font-size:18px;
}

.woocommerce #content div.product .woocommerce-tabs .panel,
.woocommerce div.product .woocommerce-tabs .panel,
.woocommerce-page #content div.product .woocommerce-tabs .panel,
.woocommerce-page div.product .woocommerce-tabs .panel{
	box-shadow:none;
	border-radius:0;
	border-bottom:1px solid #f8f8f8;
	border-left:1px solid #f8f8f8;
	border-right:1px solid #f8f8f8;
	padding:15px;
}

.woocommerce #content div.product .woocommerce-tabs .panel h2,
.woocommerce div.product .woocommerce-tabs .panel h2,
.woocommerce-page #content div.product .woocommerce-tabs .panel h2,
.woocommerce-page div.product .woocommerce-tabs .panel h2{
	font-size:22px;
	margin-top:10px;
}


.woocommerce #content div.product div.images img,
.woocommerce div.product div.images img,
.woocommerce-page #content div.product div.images img,
.woocommerce-page div.product div.images img{
	box-shadow:none;
}

.woocommerce #content div.product div.thumbnails a,
.woocommerce div.product div.thumbnails a,
.woocommerce-page #content div.product div.thumbnails a,
.woocommerce-page div.product div.thumbnails a{
	width:33.3%;
	padding: 15px 0 15px 15px;
	margin:0;
}
.woocommerce #content div.product div.images div.thumbnails,
.woocommerce div.product div.images div.thumbnails,
.woocommerce-page #content div.product div.images div.thumbnails,
.woocommerce-page div.product div.images div.thumbnails{
	padding:0;
	margin: 0 0 0 -15px;
	border-top: 0;
}
.woocommerce #content div.product div.images div.thumbnails img,
.woocommerce div.product div.images div.thumbnails img,
.woocommerce-page #content div.product div.images div.thumbnails img,
.woocommerce-page div.product div.images div.thumbnails img{
	padding:5px;
	border:1px solid #efefef;
}

.woocommerce #content .quantity .plus,
.woocommerce .quantity .plus,
.woocommerce-page #content .quantity .plus,
.woocommerce-page .quantity .plus {
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	position:static;
	border:0;
	border-radius:0;
	color:#565656;
	width:50px;
	height:50px;
	bottom:auto;
	top:auto;
	left:auto;
	right:auto;
	float:left;
	background:none;
	box-shadow:none;
	background-color:#eaeaea;
	text-shadow:none;
}
.woocommerce #content .quantity .minus,
.woocommerce .quantity .minus,
.woocommerce-page #content .quantity .minus,
.woocommerce-page .quantity .minus {
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	position:static;
	float:left;
    border:0;
	border-radius:0;
	color:#565656;
	width:50px;
	height:50px;
	bottom:auto;
	top:auto;
	left:auto;
	right:auto;
	background:none;
	box-shadow:none;
	background-color:#eaeaea;
	text-shadow:none;
}
.woocommerce #content .quantity .minus:hover,
.woocommerce .quantity .minus:hover,
.woocommerce-page #content .quantity .minus:hover,
.woocommerce-page .quantity .minus:hover,

.woocommerce #content .quantity .plus:hover,
.woocommerce .quantity .plus:hover,
.woocommerce-page #content .quantity .plus:hover,
.woocommerce-page .quantity .plus:hover{
	background:<?php echo $rb_ColorFirst; ?>;
	color:#fff;
}


.woocommerce #content .quantity input.qty,
.woocommerce .quantity input.qty,
.woocommerce-page #content .quantity input.qty,
.woocommerce-page .quantity input.qty{
	position:static;
	float: left;
	border:none;
    border-radius:0;
    box-shadow:none;
    font-weight: normal;
    height: 50px;
    padding: 0;
    text-align: center;
    width: 70px;
	bottom:auto;
	top:auto;
	left:auto;
	right:auto;
	background-color:#fbfbfb;
}

.woocommerce #content div.product form.cart div.quantity,
.woocommerce div.product form.cart div.quantity,
.woocommerce-page #content div.product form.cart div.quantity,
.woocommerce-page div.product form.cart div.quantity {
	position:static;
    margin: 0 auto;
    position: relative;
    width: 172px;
	height:50px;
	bottom:auto;
	top:auto;
	left:auto;
	right:auto;
	border-radius:2px;
	background-color:#eaeaea;
	border:1px solid #eaeaea;
}

.woocommerce #content div.product form.cart div.quantity,
.woocommerce div.product form.cart div.quantity,
.woocommerce-page #content div.product form.cart div.quantity,
.woocommerce-page div.product form.cart div.quantity{
	margin-right:20px;
}

.woocommerce #content div.product form.cart .button,
.woocommerce div.product form.cart .button,
.woocommerce-page #content div.product form.cart .button,
.woocommerce-page div.product form.cart .button{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	position:relative;
	text-shadow:none;
	height:50px;
	padding-left:15px;
	padding-right:67px;
	border:none;
	background:<?php echo $rb_ColorFirst; ?>;
	color:#fff;
}
.woocommerce #content div.product form.cart .button:after,
.woocommerce div.product form.cart .button:after,
.woocommerce-page #content div.product form.cart .button:after,
.woocommerce-page div.product form.cart .button:after{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	line-height:52px;
	position:absolute;
	right:0;
	top:0;
	bottom:0;
	width:50px;
	height:50px;
	background-color:#000;
	color:#fff;
	font-family:FontAwesome;
	content: "\f07a";
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
.woocommerce #content div.product form.cart .button:hover,
.woocommerce div.product form.cart .button:hover,
.woocommerce-page #content div.product form.cart .button:hover,
.woocommerce-page div.product form.cart .button:hover{
	background-color:#000;
	color:#fff;
	padding-left:25px;
	padding-right:77px;
}
.woocommerce #content div.product form.cart .button:hover:after,
.woocommerce div.product form.cart .button:hover:after,
.woocommerce-page #content div.product form.cart .button:hover:after,
.woocommerce-page div.product form.cart .button:hover:after{
	width:50px;
	background:<?php echo $rb_ColorFirst; ?>;
	color:#fff;
}

.woocommerce #content div.product p.price,
.woocommerce #content div.product span.price,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce-page #content div.product p.price,
.woocommerce-page #content div.product span.price,
.woocommerce-page div.product p.price,
.woocommerce-page div.product span.price{
	font-size:22px;
	margin:15px 0;
	color:<?php echo $rb_ColorFont; ?>;
}

.woocommerce #content div.product p.price ins,
.woocommerce #content div.product span.price ins,
.woocommerce div.product p.price ins,
.woocommerce div.product span.price ins,
.woocommerce-page #content div.product p.price ins,
.woocommerce-page #content div.product span.price ins,
.woocommerce-page div.product p.price ins,
.woocommerce-page div.product span.price ins{
	text-decoration:none;
}

.woocommerce #content div.product form.cart,
.woocommerce div.product form.cart,
.woocommerce-page #content div.product form.cart,
.woocommerce-page div.product form.cart{
	padding-top:20px;
}

.woocommerce #content div.product form.cart .variations,
.woocommerce div.product form.cart .variations,
.woocommerce-page #content div.product form.cart .variations,
.woocommerce-page div.product form.cart .variations{
	width:100%;
}

.woocommerce #content div.product form.cart .variations label,
.woocommerce div.product form.cart .variations label,
.woocommerce-page #content div.product form.cart .variations label,
.woocommerce-page div.product form.cart .variations label,

.woocommerce #content div.product form.cart .variations select,
.woocommerce div.product form.cart .variations select,
.woocommerce-page #content div.product form.cart .variations select,
.woocommerce-page div.product form.cart .variations select,

.woocommerce #content div.product form.cart .variations td.label,
.woocommerce div.product form.cart .variations td.label,
.woocommerce-page #content div.product form.cart .variations td.label,
.woocommerce-page div.product form.cart .variations td.label{
	font-size:14px;
	color:<?php echo $rb_ColorFont; ?>;
	font-weight:normal;
	text-align:left;
}

.woocommerce #content div.product form.cart .variations td.label,
.woocommerce div.product form.cart .variations td.label,
.woocommerce-page #content div.product form.cart .variations td.label,
.woocommerce-page div.product form.cart .variations td.label{
	min-width:100px;
	padding:10px 10px 10px 0;
	display:block;
}

.woocommerce #content div.product form.cart .variations label,
.woocommerce div.product form.cart .variations label,
.woocommerce-page #content div.product form.cart .variations label,
.woocommerce-page div.product form.cart .variations label{
	margin-top:3px;
	font-weight:500;
}

.woocommerce #content div.product form.cart .variations select,
.woocommerce div.product form.cart .variations select,
.woocommerce-page #content div.product form.cart .variations select,
.woocommerce-page div.product form.cart .variations select{
	border:1px solid #efefef;
	padding:10px;
}

.woocommerce #content div.product form.cart .variations td .reset_variations,
.woocommerce div.product form.cart .variations td .reset_variations,
.woocommerce-page #content div.product form.cart .variations td .reset_variations,
.woocommerce-page div.product form.cart .variations td .reset_variations{
	padding-top:20px;
	padding-bottom:10px;
	display:inline-block;
	float:right;
}

.woocommerce #content div.product form.cart .variations td .reset_variations:before,
.woocommerce div.product form.cart .variations td .reset_variations:before,
.woocommerce-page #content div.product form.cart .variations td .reset_variations:before,
.woocommerce-page div.product form.cart .variations td .reset_variations:before{
	font-family:FontAwesome;
	content:"\f057";
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	padding-right:10px;
}

.woocommerce #content div.product p.stock,
.woocommerce div.product p.stock,
.woocommerce-page #content div.product p.stock,
.woocommerce-page div.product p.stock{
	color:<?php echo $rb_ColorFont; ?>;
}

.woocommerce #content div.product .out-of-stock,
.woocommerce div.product .out-of-stock,
.woocommerce-page #content div.product .out-of-stock,
.woocommerce-page div.product .out-of-stock{
	color:#ff0000 !important;
}

.woocommerce #content div.product .product_meta >span ,
.woocommerce div.product .product_meta > span,
.woocommerce-page #content div.product .product_meta > span,
.woocommerce-page div.product .product_meta > span{
	display:block;
	padding:10px 0;
}

.woocommerce #reviews #comments ol.commentlist li img.avatar,
.woocommerce-page #reviews #comments ol.commentlist li img.avatar{
	width:72px;
	height:72px;
	background:none;
	border:1px solid #efefef;
	padding:5px;
}
.woocommerce #reviews #comments ol.commentlist li .comment-text,
.woocommerce-page #reviews #comments ol.commentlist li .comment-text{
	margin-left:86px;
	border-radius:0;
	border:none;
	border-bottom:1px solid #efefef;
}

.woocommerce .comment-form input,
.woocommerce .comment-form textarea,
.woocommerce-page .comment-form input,
.woocommerce-page .comment-form textarea{
	border:1px solid #efefef;
	padding:5px;
	width:100%;
	margin-bottom:15px;
}
.woocommerce #reviews #comment,
.woocommerce-page #reviews #comment{
	height:130px;
}
.woocommerce .comment-form .comment-form-rating,
.woocommerce-page .comment-form .comment-form-rating{
	float:left;
	font-weight:normal;
	color:<?php echo $rb_ColorFont; ?>;
}
.woocommerce .comment-form .comment-form-rating label,
.woocommerce-page .comment-form .comment-form-rating label{
	padding:5px;
	float:left;
	font-weight:normal;
	color:#999;
}
.woocommerce .comment-form .comment-form-rating .rb-stars,
.woocommerce-page .comment-form .comment-form-rating .rb-stars{
	float:left;
	padding-top:5px;
	padding-left:30px;
}
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong,
.woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta strong{
	font-weight:normal;
	font-size:14px;
}

.rb-star-item{
	cursor:pointer;
	width:14px;
	display:inline-block;
	text-indent:-9999px;
	position:relative;
}
.rb-star-item:before{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	text-indent:0;
	font-family:WooCommerce;
	content:"\e021";
	position:absolute;
	left:0;
}
.rb-star-item:after{
	<?php rb_cssall('transition', 'all', '.3s', 'ease-out'); ?>
	opacity:0;
	content:"\e020";
	text-indent:0;
	font-family:WooCommerce;
	position:absolute;
	left:0;
}
.rb-star-active:before{
	opacity:0;
}
.rb-star-active:after{
	opacity:1;
}
.woocommerce #review_form #respond .form-submit,
.woocommerce-page #review_form #respond .form-submit{
	float:right;
	width:50%;
	padding-left:15px;
}
.woocommerce #review_form #submit{
	background:none;
}

/** Woo Other Elements **/
.woocommerce .woocommerce-error .button,
.woocommerce .woocommerce-info .button,
.woocommerce .woocommerce-message .button,
.woocommerce-page .woocommerce-error .button,
.woocommerce-page .woocommerce-info .button,
.woocommerce-page .woocommerce-message .button{
	padding-right:15px;
	padding-left:15px;
}
.woocommerce .woocommerce-error:before,
.woocommerce .woocommerce-info:before,
.woocommerce .woocommerce-message:before,
.woocommerce-page .woocommerce-error:before,
.woocommerce-page .woocommerce-info:before,
.woocommerce-page .woocommerce-message:before{
	padding-top:0px;
}

.woocommerce .woocommerce-error,
.woocommerce .woocommerce-info,
.woocommerce .woocommerce-message,
.woocommerce-page .woocommerce-error,
.woocommerce-page .woocommerce-info,
.woocommerce-page .woocommerce-message{
	box-shadow:none;
	border-radius:2px;
	text-shadow:none;
}

/* Product Page Related Images */
.woocommerce .upsells.products h2,
.woocommerce-page .upsells.products h2,
.woocommerce .related.products h2,
.woocommerce-page .related.products h2{
	font-size:24px;
	color:<?php echo $rb_ColorFirst; ?>;
	margin-bottom:30px;
}

.woocommerce .related ul li.product,
.woocommerce .related ul.products li.product,
.woocommerce .upsells.products ul li.product,
.woocommerce .upsells.products ul.products li.product,
.woocommerce-page .related ul li.product,
.woocommerce-page .related ul.products li.product,
.woocommerce-page .upsells.products ul li.product,
.woocommerce-page .upsells.products ul.products li.product{
	width:33%;
}

/* Chart Page */
.woocommerce table.shop_table,
.woocommerce-page table.shop_table{
	border-radius:0;
	border:1px solid #efefef;
}
.woocommerce table.shop_table th,
.woocommerce-page table.shop_table th{
	text-transform:uppercase;
	font-weight:normal;
	color:#999;
}
.woocommerce table.shop_table .quantity,
.woocommerce-page table.shop_table .quantity{
	width:auto;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type=number]{
	-moz-appearance:textfield;
}

.woocommerce table.shop_table .product-subtotal,
.woocommerce-page table.shop_table .product-subtotal,
.woocommerce table.shop_table .product-price,
.woocommerce-page table.shop_table .product-price{
	text-align:right;
	padding-right:30px;
}

.woocommerce table.shop_table .product-name .variation *,
.woocommerce-page table.shop_table .product-name .variation *,
.woocommerce table.shop_table .product-name .variation *,
.woocommerce-page table.shop_table .product-name .variation *{
	color:#999;
	font-weight:normal;
	font-size:12px;
	margin:0;
	padding:0;
}
.woocommerce table.shop_table .product-name .variation dt,
.woocommerce-page table.shop_table .product-name .variation dt,
.woocommerce table.shop_table .product-name .variation dt,
.woocommerce-page table.shop_table .product-name .variation dt{
	padding-top:2px;
	padding-right:5px;
}
.woocommerce #content table.cart a.remove,
.woocommerce table.cart a.remove,
.woocommerce-page #content table.cart a.remove,
.woocommerce-page table.cart a.remove{
	<?php rb_cssall('transition', '.3s'); ?>
	opacity:.5;
	line-height:18px;
	font-size:16px;
	height:20px;
	width:20px;
	text-align:center;
}
.woocommerce #content table.cart a.remove:hover,
.woocommerce table.cart a.remove:hover,
.woocommerce-page #content table.cart a.remove:hover,
.woocommerce-page table.cart a.remove:hover{
	opacity:1;
}
.woocommerce #content table.cart td.actions .coupon,
.woocommerce table.cart td.actions .coupon,
.woocommerce-page #content table.cart td.actions .coupon,
.woocommerce-page table.cart td.actions .coupon{

}
.woocommerce .cart .button,
.woocommerce .cart input.button,
.woocommerce-page .cart .button,
.woocommerce-page .cart input.button{
	float:right;
	padding-left:10px;
	padding-right:10px;
}
.woocommerce .shop_table .button,
.woocommerce .shop_table input.button,
.woocommerce-page .shop_table .button,
.woocommerce-page .shop_table input.button{
	margin-top:5px;
	margin-bottom:5px;
}
.woocommerce .cart .checkout-button,
.woocommerce .cart input.checkout-button,
.woocommerce-page .cart .checkout-button,
.woocommerce-page .cart input.checkout-button{
	background:none;
	text-shadow:none;
	color:<?php echo $rb_ColorFont; ?>;
	border:1px solid #efefef;
	margin-right:10px;
}
.woocommerce .cart .checkout-button:hover,
.woocommerce .cart input.checkout-button:hover,
.woocommerce-page .cart .checkout-button:hover,
.woocommerce-page .cart input.checkout-button:hover{
	background:<?php echo $rb_ColorFirst; ?>;
	text-shadow:none;
	color:#fff;
}

.woocommerce #content table.cart td.actions .coupon .input-text,
.woocommerce table.cart td.actions .coupon .input-text,
.woocommerce-page #content table.cart td.actions .coupon .input-text,
.woocommerce-page table.cart td.actions .coupon .input-text{
	box-shadow:none;
	padding:15px 10px;
	width:150px;
	border:1px solid #efefef;
	margin:5px 10px 5px 0;
}
.woocommerce .cart-collaterals .cart_totals h2,
.woocommerce-page .cart-collaterals .cart_totals h2{
	font-size:16px;
	font-weight:normal;
	text-transform:uppercase;
	color:#999;
}
.woocommerce .cart-collaterals .cart_totals th,
.woocommerce-page .cart-collaterals .cart_totals th{
	font-weight:normal;
	text-transform:uppercase;
}
.woocommerce .cart-collaterals .cart_totals *,
.woocommerce-page .cart-collaterals .cart_totals *{
	color:#999;
}
.woocommerce .cart-collaterals .cart_totals table th,
.woocommerce-page .cart-collaterals .cart_totals table th{
	padding:6px 12px 6px 0;
}
.woocommerce .cart-collaterals .cart_totals .cart-subtotal *,
.woocommerce-page .cart-collaterals .cart_totals .cart-subtotal *,
.woocommerce .cart-collaterals .cart_totals .order-total *,
.woocommerce-page .cart-collaterals .cart_totals .order-total *{
	color:<?php echo $rb_ColorFirst; ?>;
}
.woocommerce .cart-collaterals .shipping_calculator .shipping-calculator-button,
.woocommerce-page .cart-collaterals .shipping_calculator .shipping-calculator-button{
	display:block;
	text-decoration:none;
	font-size:16px;
	font-weight:normal;
	text-transform:uppercase;
	text-align:right;
	margin-bottom:20px;
}
.woocommerce .cart-collaterals .shipping_calculator .shipping-calculator-button:after,
.woocommerce-page .cart-collaterals .shipping_calculator .shipping-calculator-button:after{
	font-family:FontAwesome;
	content:"\f175";
}
.woocommerce form .form-row input.input-text,
.woocommerce form .form-row textarea,
.woocommerce-page form .form-row input.input-text,
.woocommerce-page form .form-row textarea,
.woocommerce form .form-row select,
.woocommerce-page form .form-row select{
	border:1px solid #efefef;
	padding:5px;
	width:100%;
	margin-bottom:5px;
}

.woocommerce .cross-sells h2,
.woocommerce-page .cross-sells h2{
	font-size:24px;
	margin-bottom:30px;
	color:<?php echo $rb_ColorFirst; ?>;
}

/** Checkout Page **/
.woocommerce form .form-row label,
.woocommerce-page form .form-row label{
	font-weight:500;
	font-size:12px;
	line-height:1;
	margin-bottom:5px;
}
.woocommerce .checkout .col-2 h3 label,
.woocommerce-page .checkout .col-2 h3 label{
	margin-top:0px;
	margin-bottom:0px;
	float:right;
	font-weight:normal;
	padding-left:0px;
}

.woocommerce .checkout .col-1 h3,
.woocommerce-page .checkout .col-1 h3,
.woocommerce .checkout .col-2 h3,
.woocommerce-page .checkout .col-2 h3,
.woocommerce .checkout h3#order_review_heading,
.woocommerce-page .checkout h3#order_review_heading{
	margin-bottom:20px;
	margin-top:40px;
}

.woocommerce .checkout .col-2 h3 input[type="checkbox"],
.woocommerce-page .checkout .col-2 h3 input[type="checkbox"]{
	margin:7px 10px 0 0;
}

.chosen-container-single .chosen-single{
	background:none;
    border: 1px solid #efefef;
    border-radius: 0px;
    box-shadow:none;
    color: <?php echo $rb_ColorFont; ?>;
	margin-bottom:10px;
}
.chosen-container .chosen-drop{
	border:1px solid #efefef;
	box-shadow:none;
}
.chosen-container-active.chosen-with-drop .chosen-single{
	border:1px solid #efefef;
	background:none;
}

.chosen-container-single .chosen-search {
	background:none;
	box-shadow:none;
}
.chosen-container-single .chosen-search input[type=text],
.woocommerce-checkout .form-row .chosen-container-single .chosen-search input {
	border:1px solid #efefef;
	background:none;
	box-shadow:none;
}

.woocommerce table.shop_table tfoot th,
.woocommerce-page table.shop_table tfoot th{
	font-weight:normal;
	text-transform:uppercase;
}

.woocommerce table.shop_table tfoot td,
.woocommerce-page table.shop_table tfoot td{
	font-weight:normal;
	color:<?php echo $rb_ColorFirst; ?>;
	border-left:1px solid #efefef;
}

.woocommerce #payment ul.payment_methods li label,
.woocommerce-page #payment ul.payment_methods li label{
	font-weight:normal;
}
.woocommerce #payment,
.woocommerce-page #payment{
	background:none;
	border:1px solid #efefef;
    border-radius: 2px;
}
.woocommerce #payment ul.payment_methods,
.woocommerce-page #payment ul.payment_methods{
	border-bottom: 1px solid #efefef;
}
.woocommerce #payment div.payment_box,
.woocommerce-page #payment div.payment_box{
	background:none;
	box-shadow:none;
	text-shadow:none;
	border:1px solid #efefef;
}
.woocommerce #payment div.payment_box:after,
.woocommerce-page #payment div.payment_box:after{
	border:0;
	margin:0;
	top:0;
}
.woocommerce #content input.button.alt,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce-page #content input.button.alt,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt{
	display:block;
	background:none;
	border:1px solid #efefef;
	text-shadow:none;
	color:<?php echo $rb_ColorFont; ?>;
	padding-left:15px;
	padding-right:15px;
	widget:100%;
}
.woocommerce #content input.button.loading:before,
.woocommerce #respond input#submit.loading:before,
.woocommerce a.button.loading:before,
.woocommerce button.button.loading:before,
.woocommerce input.button.loading:before,
.woocommerce-page #content input.button.loading:before,
.woocommerce-page #respond input#submit.loading:before,
.woocommerce-page a.button.loading:before,
.woocommerce-page button.button.loading:before,
.woocommerce-page input.button.loading:before{
	display:inline-block;
	background: url('../images/ajax-loader.gif') no-repeat scroll center center transparent;
    bottom: auto;
    content: "";
    left: auto;
    position: static;
    right: auto;
    top: auto;
	width:15px;
	height:15px;
	margin-right:15px;
}


.woocommerce #payment #place_order,
.woocommerce-page #payment #place_order{
	float:left;
}
.woocommerce #content input.button.alt:hover,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce-page #content input.button.alt:hover,
.woocommerce-page #respond input#submit.alt:hover,
.woocommerce-page a.button.alt:hover,
.woocommerce-page button.button.alt:hover,
.woocommerce-page input.button.alt:hover{
	background:<?php echo $rb_ColorFirst; ?>;
	border:1px solid #efefef;
	text-shadow:none;
	color:#fff;
}

.woocommerce form.checkout_coupon,
.woocommerce form.login,
.woocommerce form.register,
.woocommerce-page form.checkout_coupon,
.woocommerce-page form.login,
.woocommerce-page form.register{
	border:1px solid #efefef;
}

.woocommerce form .form-row input.input-text#coupon_code,
.woocommerce-page form .form-row input.input-textcoupon_code{
	padding-top:14px;
	padding-bottom:14px;
}

.woocommerce-checkout .login .button{
	float:left;
}
.woocommerce-checkout .login input#rememberme{
	margin-top:35px;
	margin-left:20px;
}

/** Responsive **/
@media only screen and (max-width: 768px){
	.woocommerce ul.products li.product,
	.woocommerce-page ul.products li.product{
		width:50%;
	}

	.woocommerce .related ul li.product,
	.woocommerce .related ul.products li.product,
	.woocommerce .upsells.products ul li.product,
	.woocommerce .upsells.products ul.products li.product,
	.woocommerce-page .related ul li.product,
	.woocommerce-page .related ul.products li.product,
	.woocommerce-page .upsells.products ul li.product,
	.woocommerce-page .upsells.products ul.products li.product{
		width:50%;
	}
}
@media only screen and (max-width: 320px){
	.woocommerce ul.products li.product,
	.woocommerce-page ul.products li.product{
		width:100%;
	}

	.woocommerce .related ul li.product,
	.woocommerce .related ul.products li.product,
	.woocommerce .upsells.products ul li.product,
	.woocommerce .upsells.products ul.products li.product,
	.woocommerce-page .related ul li.product,
	.woocommerce-page .related ul.products li.product,
	.woocommerce-page .upsells.products ul li.product,
	.woocommerce-page .upsells.products ul.products li.product{
		width:100%;
	}
}

@media only screen and  (min-width:768px) and (max-width: 1200px){
	.woocommerce #content div.product form.cart .button,
	.woocommerce div.product form.cart .button,
	.woocommerce-page #content div.product form.cart .button,
	.woocommerce-page div.product form.cart .button{
		margin-top:20px;
		margin-bottom:20px;
	}
}
