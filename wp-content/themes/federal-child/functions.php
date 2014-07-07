<?php
$Rb_demo = false;
if($Rb_demo) include 'includes/demo/demo.php';

include 'includes/admin-structure.php';
include 'includes/general-settings.php';
include 'includes/gallerymanager.php';
include 'includes/post-options.php';
include 'includes/main-ajax.php';
include 'includes/general-settings-ajax.php';
include 'includes/register-widgets.php';
include 'includes/update_notifier.php';
include 'includes/helper-functions.php';

include 'includes/rb-widget-tab.php';
include 'includes/rb-widget-flickr.php';
include 'includes/rb-widget-twitter.php';

include 'includes/shortcodes.php';
include 'includes/blog-sh.php';
include 'includes/portfolio-sh.php';

if(is_admin()){
	require_once 'includes/rb-shortcode/rb-shortcode.php';
	require_once 'includes/class-tgm-plugin-activation.php';
	require_once 'includes/plugin-installer.php';
	rb_register_required_plugins();
}

add_action( 'after_setup_theme', 'rb_theme_setup' );

function rb_theme_setup(){
	global $content_width;

	if ( ! isset( $content_width ) ) $content_width = 1170;

	//use thumbnail with post
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );


	// For use shortcode in widgets
	add_filter('widget_text', 'do_shortcode');
	add_filter('widget_title', 'do_shortcode');

	// localization support
	load_theme_textdomain('rb');

	// menus
	register_nav_menu('headermenu', 'Header Navigation');
	register_nav_menu('footermenu', 'Footer Navigation');

	//use thumbnail with post
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array('aside', 'audio', 'gallery', 'image', 'video') );

	//Woo Commerce
	if(function_exists('is_woocommerce')){
		include 'woocommerce/woo-functions.php';
		rb_woocommerce_actions();
	}

	add_action( 'wp_print_styles', 'rb_wp_pagenavi_clear');
	add_action('wp_enqueue_scripts', 'rb_enqueue_scripts');
	add_action('admin_enqueue_scripts', 'rb_admin_enqueue_scripts');

	add_filter( 'style_loader_tag', 'rb_enqueue_less_styles', 5, 2);

	add_filter('avatar_defaults','rb_custom_gravatar');

	// Galleries
	add_action( 'init', 'rb_create_gallery_post_type' );
	add_action('admin_menu', 'rb_add_gallery_manager_box');

	// Update Notifier
	add_action('admin_menu', 'rb_update_notifier_menu');

	// RB Admin
	add_action('admin_menu', 'rb_add_control_panel');
	// Custom Portfolio
	add_action( 'init', 'rb_add_custom_taxonomies_portfolio', 0 );
	add_action( 'init', 'rb_create_portfolio_post_type' );
	add_action( 'init', 'rb_postformatPortfolio');

	// certain post formats
	add_filter('pre_get_posts','GetCertainPostTypes');

	// Body classes
	add_filter('body_class', 'add_slug_body_class');
}

function GetCertainPostTypes($query){
	$post_type = get_query_var('post_type');
    if ($query->is_search &&  empty($post_type)) {
        $query->set('post_type',array('post','page','rb-portfolio'));
    }
	return $query;
}

function rb_enqueue_scripts(){
	global $Rb_demo;
   	$tmpurl = get_template_directory_uri();

	if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])){
		wp_enqueue_script("respond", 				$tmpurl.'/js/libs/respond.min.js', 		false, null, false);
		wp_enqueue_script("html5", 					$tmpurl.'/js/libs/html5.js', 			false, null, false);
	}

	if(rb_opt('contentFont','')!='')
		wp_enqueue_style('contentFont', rb_opt('contentFontFull',''), 						false, null, 'all');
	if(rb_opt('headerFont','')!='')
		wp_enqueue_style('headerFont', rb_opt('headerFontFull',''), 						false, null, 'all');


	wp_enqueue_style('bootstrap-css', 			$tmpurl."/css/bootstrap.min.css", 			false, null, 'all');
	wp_enqueue_style('bootstrap-theme-css', 	$tmpurl."/css/bootstrap-theme.min.css", 	false, null, 'all');

	wp_enqueue_style('owl.carousel-css',		$tmpurl."/css/owl.carousel.css", 			false, null, 'all');
	wp_enqueue_style('owl.theme', 				$tmpurl."/css/owl.theme.css", 				false, null, 'all');
	wp_enqueue_style('owl.transitions', 		$tmpurl."/css/owl.transitions.css", 		false, null, 'all');

	wp_enqueue_style('font-awesome', 			$tmpurl."/css/font-awesome.min.css", 		false, null, 'all');

	wp_enqueue_style('hover-effect', 			$tmpurl."/css/hover-effect.css", 			false, null, 'all');
	wp_enqueue_style('hover-effect-responsive', $tmpurl."/css/responsive.css", 				false, null, 'all');

	wp_enqueue_style('generalStyle', 			$tmpurl."/style.css", 						false, null, 'all');
	if(!$Rb_demo)
		wp_enqueue_style('ThemeStyle', 			$tmpurl."/style.php",						false, null, 'all');
	else{
		wp_enqueue_script("cookie", 			$tmpurl."/includes/demo/js/jquery.cookie.js",  false, null, true);
		wp_enqueue_style('ThemeStyle', 			$tmpurl."/style.php?file=style.less", 		false, null, 'all');
		wp_enqueue_script("lesscss", 			$tmpurl."/includes/demo/js/less-1.1.6.js", 	false, null, false);
		wp_enqueue_style('demo-css', 			$tmpurl."/includes/demo/css/demo.css", 		false, null, 'all');
		wp_enqueue_script("demo-js", 			$tmpurl."/includes/demo/js/demo.js", 		false, null, false);
		wp_localize_script('demo-js', 'demo_var', array(
			'themeURL' => $tmpurl,
			'homeURL'=>home_url(),
		));
	}
	wp_enqueue_style('jplayer-skin', 			$tmpurl."/css/skin/blue.monday/jplayer.blue.monday.css", false, null, 'all');
	wp_enqueue_style('animatecss', 				$tmpurl."/css/animate.css", 				false, null, 'all');
	wp_enqueue_style('magnific-popup-css', 		$tmpurl."/css/magnific-popup.css", 			false, null, 'all');

	wp_enqueue_script("jquery");
	wp_enqueue_script("easing",					$tmpurl."/js/jquery.easing.1.3.js",		    false, null, true);
	wp_enqueue_script("scrollTo",				$tmpurl."/js/jquery.scrollTo.js", 			false, null, true);
	wp_enqueue_script("jquery.nav",				$tmpurl."/js/jquery.nav.js", 				false, null, true);
	wp_enqueue_script("bootstrap-js",			$tmpurl."/js/bootstrap.min.js", 			false, null, true);
	wp_enqueue_script("owl.carousel-js",		$tmpurl."/js/owl.carousel.min.js", 			false, null, true);
	wp_enqueue_script("jquery.easypiechart",	$tmpurl."/js/jquery.easypiechart.min.js", 	false, null, true);
	wp_enqueue_script("flexslider",				$tmpurl."/js/jquery.flexslider-min.js", 	false, null, true);
	wp_enqueue_script("isotope",				$tmpurl."/js/jquery.isotope.min.js", 		false, null, true);
	wp_enqueue_script("isotope.perfectmasonry",	$tmpurl."/js/jquery.isotope.perfectmasonry.js", false, null, true);
	wp_enqueue_script("SmoothScroll",			$tmpurl."/js/SmoothScroll.js", 				false, null, true);
	wp_enqueue_script("waypoints",				$tmpurl."/js/waypoints.min.js", 			false, null, true);
	wp_enqueue_script("parallax",				$tmpurl."/js/jquery.parallax-1.1.3.js", 	false, null, true);
	wp_enqueue_script("wow-js",					$tmpurl."/js/wow.min.js", 					false, null, false);
	wp_enqueue_script("jplayer",				$tmpurl."/js/jquery.jplayer.min.js", 		false, null, true);
	wp_enqueue_script("main",					$tmpurl."/main.js", 						false, null, true);
	wp_enqueue_script("rainyday",				$tmpurl."/js/rainyday.js", 					false, null, true);
	wp_enqueue_script("ytplayer",				$tmpurl."/js/jquery.mb.YTPlayer.js", 		false, null, true);
	wp_enqueue_script("fitvids",				$tmpurl."/js/jquery.fitvids.js", 			false, null, true);
	wp_enqueue_script("googlemap", 				"http://maps.googleapis.com/maps/api/js?sensor=true", false, null, true);
	wp_enqueue_script("magnific-popup",			$tmpurl."/js/magnific-popup.js", 			false, null, true);

	wp_localize_script('main', 'ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce'),
		'themeURL' => $tmpurl,
		'homeURL'=>home_url(),
	));
}

function rb_admin_enqueue_scripts(){
   	$tmpurl = get_template_directory_uri();
	wp_enqueue_script("bootstrap",$tmpurl."/js/bootstrap.min.js", false, null, true);
	wp_enqueue_style('bootstrap-css', $tmpurl."/includes/css/bootstrap.css", false, null, 'all');
	wp_enqueue_style('font-awesome', $tmpurl."/css/font-awesome.min.css", false, null, 'all');
}

function rb_enqueue_less_styles($tag, $handle) {
    global $wp_styles;
    $match_pattern = '/\.less$/U';
    if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
        $handle = $wp_styles->registered[$handle]->handle;
        $media = $wp_styles->registered[$handle]->args;
        $href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
        $rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
        $title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

        $tag = "<link rel='stylesheet' id='$handle' $title href='$href' type='text/less' media='$media' />";
    }
    return $tag;
}

// clear page navi style
function rb_wp_pagenavi_clear(){
	wp_deregister_style('wp-pagenavi');
}

function rb_wp_title_modification( $title, $separator ) {
	global $paged;

	if(is_search())
	{
		$title = __('Results for ','rb').get_search_query();
		$title .= " $separator ".get_bloginfo('name');
		return $title;
	}else{

		if($paged>1)
			$title .= ' '.__('Page ','rb').$paged." $separator ";

		$title .= get_bloginfo('name');

		$description = get_bloginfo('description');

		if((is_home() || is_front_page()) && $description)
			$title .= " $separator ".$description;
		return $title;
	}
}
add_filter( 'wp_title', 'rb_wp_title_modification', 10, 2 );


class description_walker extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth=0, $args=array(), $current_object_id=0){
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		if($item->object == 'custom' && $item->xfn!='skip' && substr($item->url,0,1)=='#')
		{
			$varpost = get_post($item->object_id);
			if(is_front_page()){
				$attributes .= ' href="' . $item->url . '"';
				$attributes .= ' class="onepage" ';
			}else{
				$attributes .= ' href="' . home_url().'/'. $item->url . '"';
			}
		}else{
			$attributes .= ! empty( $item->url )  ? ' href="'   . esc_attr( $item->url) .'"' : '';
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

//POSTED ON META INFO TEMPLATE
function posted_on_template () {
	return __('Posted by ', 'rb').get_the_author();
}

function rb_custom_gravatar($avatar_defaults)
{
	$myavatar = get_template_directory_uri().'/images/avatar.jpg';
	$avatar_defaults[$myavatar] = __('RB Default Avatar','rb');
	return $avatar_defaults;
}

function add_slug_body_class($classes)
{
	global $post;
	if (isset($post)) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
