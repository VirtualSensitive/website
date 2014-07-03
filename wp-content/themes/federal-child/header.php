<?php
$rb_tmpurl = get_template_directory_uri();
global $Rb_demo;
?>
<!DOCTYPE html>
<html>
	<head <?php language_attributes(); ?>>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title><?php  wp_title( '|', true, 'right' );  ?></title>
		<?php
		$rb_favicon = trim(rb_opt('favicon',''));
		if(!empty($rb_favicon)){
			if(strpos($rb_favicon,'http')===false)
				$favicon = $rb_tmpurl.'/'.$rb_favicon;
		?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $rb_favicon; ?>">
		<?php } ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php if($Rb_demo) demo_switch_html(); ?>
		<div class="body-wrapper">
			<div id="page-top" class="clearfix"></div>
			<?php
			$rb_logoURL = rb_opt('logo','');
			if( !empty($rb_logoURL) ){
				if(strpos($rb_logoURL,'http')===false)
					$rb_logoURL = $rb_tmpurl.'/'.$rb_logoURL;
			}
			?>
			<?php
			if(!$Rb_demo)
				rb_get_top_section();
			else{
				rb_get_demo_top_section();
			}
			?>
			<?php $rb_topSectionAudio = rb_opt('topSectionAudio','');
			if(!empty( $rb_topSectionAudio ) ): ?>
			<div class="audio-plr">
				<div id="jquery_jplayer_1" data-mp3="<?php echo $rb_topSectionAudio; ?>"></div>
				<div id="jp_container_1">
					<a href="#" class="jp-play"><?php _e('Play', 'rb'); ?></a>
					<a href="#" class="jp-pause"><?php _e('Pause', 'rb'); ?></a>
				</div>
			</div>
			<?php endif; ?>
			<!--
			<section class="top-navigation content-white">
				<article class="top-navigation-inner ">
					<div class="hidden-lg hidden-md hidden-sm">
						<header class="navbar" role="banner">
							<div class="container">
								<div class="navbar-header">
									<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<div class="logo mobile left">
										<img src="<?php echo $rb_logoURL; ?>" alt="<?php bloginfo('name'); ?>" >
									</div>
								</div>
								<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
									<?php
									if ( has_nav_menu( 'headermenu' ) ){
										wp_nav_menu(array(
											'theme_location' => 'headermenu',
											'echo' => true,
											'container' => '',
											'menu_class' => 'nav navbar-nav',
											'walker'=> new Description_Walker,
											'depth' => 4
										));
									}
									?>
								</nav>
							</div>
						</header>
					</div>
				</article>
			</section>
			-->
			<section id='page-wrapper'>
				<nav id='page-navigation'>
					<div id="page-logo">
						<img src="<?php echo $rb_logoURL; ?>" alt="<?php bloginfo('name'); ?>" >
					</div>
					<?php
					$rb_header_socials = '';
					$rb_hSocials = array('Google', 'Twitter', 'Facebook');
					foreach($rb_hSocials as $rb_hSocial){
						$rb_hSocial_link = trim(get_option('headerSocial'.str_replace(' ','',$rb_hSocial), ''));
						if(!empty($rb_hSocial_link))
							$rb_header_socials .= '<a class="'.strtolower(str_replace(' ','',$rb_hSocial)).'" href="'.$rb_hSocial_link.'" target="_blank" ></a>';
					}

					if (!empty($rb_header_socials)) { ?>
						<div id="page-share">
							<div id='page-share-icons'>
								<?php echo $rb_header_socials; ?>
							</div>
						</div>
					<?php } ?>
					<div class="menu right">
						<?php
						if ( has_nav_menu( 'headermenu' ) ){
							wp_nav_menu(array(
								'theme_location' => 'headermenu',
								'echo' => true,
								'container' => '',
								'menu_class' => 'menu-top',
								'walker'=> new Description_Walker,
								'depth' => 4
							));
						}
						?>
					</div>
				</nav>
				<div id='side-mask-background-left' class='side-mask-background'></div>
				<div id='page-container'>
					<aside id='page-round-container-left'>
						<svg class='svg-mask' viewBox='0 0 712 1000' preserveAspectRatio='xMaxYMin meet'>
							<g class='group' transform='translate(0, 0)'>
								<path class='mask' d='M0,0 H712 C472.8,79, 300,304.2, 300,570 C300,738.6, 369.6,891, 481.6,1000 H0 V0 Z' />
								<path class='border' d='M712,0 C472.8,79, 300,304.2, 300,570 C300,738.6, 369.6,891, 481.6,1000' />
								<path class='header-background' d='M0,0 H712 C634.1,26,563.2,67,503,120 H0 V0 Z' />
							</g>
						</svg>
					</aside>
					<div id='page-round-content'>
