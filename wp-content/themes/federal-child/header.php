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
		<title><?php wp_title('|', true, 'right'); ?></title>
		<?php
		$rb_favicon = trim(rb_opt('favicon',''));
		if (!empty($rb_favicon)) {
			if (strpos($rb_favicon,'http') === false) {
				$favicon = $rb_tmpurl.'/'.$rb_favicon;
			}
			?>
			<link rel="shortcut icon" type="image/x-icon" href="<?php echo $rb_favicon; ?>">
			<?php
		}
		?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php if($Rb_demo) demo_switch_html(); ?>
		<div class="body-wrapper">
			<div id="page-top" class="clearfix"></div>
			<?php
			$rb_logoURL = rb_opt('logo','');
			if (!empty($rb_logoURL)) {
				if (strpos($rb_logoURL, 'http') === false) {
					$rb_logoURL = $rb_tmpurl.'/'.$rb_logoURL;
				}
			}
			?>
			<?php
			if (!$Rb_demo) {
				rb_get_top_section();
			} else {
				rb_get_demo_top_section();
			}
			?>
			<?php $rb_topSectionAudio = rb_opt('topSectionAudio','');
			if (!empty($rb_topSectionAudio)): ?>
				<div class="audio-plr">
					<div id="jquery_jplayer_1" data-mp3="<?php echo $rb_topSectionAudio; ?>"></div>
					<div id="jp_container_1">
						<a href="#" class="jp-play"><?php _e('Play', 'rb'); ?></a>
						<a href="#" class="jp-pause"><?php _e('Pause', 'rb'); ?></a>
					</div>
				</div>
			<?php endif; ?>
			<section class="top-navigation content-white">
				<article class="top-navigation-inner ">
					<div class="hidden-xs">
						<header class="container ">
							<div class='site-logo left'>
								<a href='<?php echo home_url('/'); ?>'>
									<img src="<?php echo $rb_logoURL; ?>" alt="<?php bloginfo('name'); ?>" />
								</a>
							</div>
							<?php
							$rb_header_socials = '';
							$rb_hSocials = array('Google', 'Twitter', 'Facebook');
							foreach ($rb_hSocials as $rb_hSocial) {
								$rb_hSocial_link = trim(get_option('headerSocial'.str_replace(' ','',$rb_hSocial), ''));
								if (!empty($rb_hSocial_link)) {
									$rb_header_socials .= '<a class="'.strtolower(str_replace(' ','',$rb_hSocial)).'" href="'.$rb_hSocial_link.'" target="_blank" ></a>';
								}
							}
							if (!empty($rb_header_socials)) {
								?>
								<div id="header-share" class="right">
									<?php echo $rb_header_socials; ?>
								</div>
							<?php
							}
							?>
						</header>
						<nav class="menu">
							<a id='menu-toggle' href='#'>Menu</a>
							<div id='menu-content-wrapper'>
								<?php
								if (has_nav_menu('headermenu')) {
									wp_nav_menu(array(
										'theme_location' => 'headermenu',
										'echo' => true,
										'container' => '',
										'menu_class' => 'menu-top',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'walker'=> new Description_Walker,
										'depth' => 4
									));
								}
								?>
							</div>
						</nav>
					</div>
					<div class="visible-xs">
						<header class="navbar" role="banner">
							<div class="container">
								<div class="navbar-header">
									<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<div class="site-logo mobile left">
										<a href='<?php echo home_url('/'); ?>'>
											<img src="<?php echo $rb_logoURL; ?>" alt="<?php bloginfo('name'); ?>" >
										</a>
									</div>
								</div>
								<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
									<?php
									if (has_nav_menu('headermenu')) {
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
