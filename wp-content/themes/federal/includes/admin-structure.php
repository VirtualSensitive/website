<?php

// options
$Rb_SettingsOptions = array(
	array(
		'id' => 'setGeneral',
		'name'=>__('GENERAL SETTINGS','rb'),
		'type'=>'fields',
		'imagemanager'=>'true',
		'icon'=>get_template_directory_uri().'/includes/adminimages/icon_picker.png',
		'fields'=> array(
			array(
				'id'=>'logo',
				'name'=>__('Logo Url','rb'),
				'default'=> get_template_directory_uri().'/images/theme-logo.png',
				'type'=>'url'
			),
			array(
				'id' => 'favicon',
				'name' => __('Favicon (.ico file)','rb'),
				'default' => '',
				'type' => 'url'
			),
			array(
				'id' => 'googlecode',
				'name' => __('Google Analytics Code','rb'),
				'default' => '',
				'type' => 'text'
			),
			array(
				'id' => 'topsectionhome',
				'name' => __('Home\'s Top Section','rb'),
				'default' => 'none',
				'type' => 'topsection'
			),
			array(
				'id' => 'topsectionother',
				'name' => __('Other Pages\'s Top Section','rb'),
				'default' => 'none',
				'type' => 'topsection'
			),
			array(
				'id' => 'headerSocialFacebook',
				'name' => __('Header Social Facebook','rb'),
				'default' => 'http://facebook.com',
				'type'=>'text'
			),
			array(
				'id' => 'headerSocialGoogle',
				'name' => __('Header Social Google Plus','rb'),
				'default' => 'http://googleplus.com',
				'type'=>'text'
			),
			array(
				'id' => 'headerSocialTwitter',
				'name' => __('Header Social Twitter','rb'),
				'default' => 'http://twitter.com',
				'type'=>'text'
			),
			array(
				'id' => 'topSectionAudio',
				'name' => __('Mp3 for home topsection','rb'),
				'default' => '',
				'type' => 'url'
			),
			array(
				'id' => 'sidebarsingledefault',
				'name' => __('Post Detail Sidebar Position','rb'),
				'default' => 'right',
				'options' => array(__('None','rb')=>'none', __('Right','rb')=>'right', __('Left','rb')=>'left'),
				'type' => 'select'
			),
			array(
				'id' => 'sidebarWooCommerceDefault',
				'name' => __('WooCommerce Default Sidebar Position','rb'),
				'default' => 'left',
				'options' => array(__('None','rb')=>'none', __('Right','rb')=>'right', __('Left','rb')=>'left'),
				'type' => 'select'
			),
			array(
				'id' => 'sidebarWooCommerceProduct',
				'name' => __('Product Page Sidebar Position','rb'),
				'default' => 'left',
				'options' => array(__('None','rb')=>'none', __('Right','rb')=>'right', __('Left','rb')=>'left'),
				'type' => 'select'
			),
			array(
				'id' => 'twitterInfo',
				'name' => __('Info','rb'),
				'infotext' => __('<a href="http://www.renklibeyaz.com/forum/twitterdevaccount.html" target="_blank"> How to create a twitter developer account </a>','rb'),
				'type'=>'info'
			),
			array(
				'id' => 'twitterConsumerKey',
				'name' => __('Tweeter ConsumerKey','rb'),
				'default' => '',
				'type'=>'text'
			),
			array(
				'id' => 'twitterConsumerSecret',
				'name' => __('Tweeter ConsumerSecret','rb'),
				'default' => '',
				'type'=>'text'
			),
			array(
				'id' => 'twitterAccessToken',
				'name' => __('Tweeter AccessToken','rb'),
				'default' => '',
				'type'=>'text'
			),
			array(
				'id' => 'twitterAccessTokenSecret',
				'name' => __('Tweeter AccessTokenSecret','rb'),
				'default' => '',
				'type'=>'text'
			)
		),
	),
	array(
		'id' => 'foooteroptions',
		'name'=>__('FOOTER OPTIONS','rb'),
		'type'=>'fields',
		'imagemanager'=>'false',
		'icon'=>get_template_directory_uri().'/includes/adminimages/icon_interface.png',
		'fields'=> array(
			array(
				'id' => 'footerHeader',
				'name' => __('Footer Header','rb'),
				'default' => 'CONTACT US',
				'type'=>'text'
			),
			array(
				'id' => 'footerHeaderSub',
				'name' => __('Footer Header Sub Text','rb'),
				'default' => 'We love to write blog and also love to design logo for a project. Follow us for more news',
				'type'=>'text'
			),
			array(
				'id' => 'footerContactForm',
				'name' => __('Contact Form','rb'),
				'default' => 'true',
				'options' => array(__('Show','rb')=>'true', __('Hide','rb')=>'false'),
				'type' => 'select'
			),
			array(
				'id' => 'copyrighttext',
				'name' => __('Footer Text','rb'),
				'default' => '',
				'type'=>'text'
			),
			array(
				'id'=>'footerImage',
				'name'=>__('Footer Background Image','rb'),
				'default'=> '',
				'type'=>'url'
			),
			array(
				'id' => 'footerType',
				'name' => __('Image Type','rb'),
				'default' => 'classic',
				'options' => array(__('Classic','rb')=>'classic', __('Rainy','rb')=>'rainy',  __('Parallax','rb')=>'parallax'),
				'type' => 'select'
			),
			array(
				'id' => 'footerPattern',
				'name' => __('Footer Pattern','rb'),
				'default' => 'true',
				'options' => array(__('Show','rb')=>'true', __('Hide','rb')=>'false'),
				'type' => 'select'
			),
			array(
				'id' => 'footerColumns',
				'name' => __('Footer Columns','rb'),
				'default' => '3',
				'options' => array(__('One Column','rb')=>'1', __('2 Columns','rb')=>'2', __('3 Columns','rb')=>'3', __('4 Columns','rb')=>'4'),
				'type' => 'select'
			),
			array(
				'id' => 'menuSocialFacebook',
				'name' => __('Menu Social Facebook','rb'),
				'default' => 'http://facebook.com',
				'type'=>'text'
			),
			array(
				'id' => 'menuSocialGoogle',
				'name' => __('Menu Social Google Plus','rb'),
				'default' => 'http://googleplus.com',
				'type'=>'text'
			),
			array(
				'id' => 'menuSocialTwitter',
				'name' => __('Menu Social Twitter','rb'),
				'default' => 'http://twitter.com',
				'type'=>'text'
			),
			array(
				'id' => 'menuSocialVimeo',
				'name' => __('Menu Social Vimeo','rb'),
				'default' => 'http://vimeo.com',
				'type'=>'text'
			),
			array(
				'id' => 'menuSocialLinkedin',
				'name' => __('Menu Social Linkedin','rb'),
				'default' => 'http://linkedin.com',
				'type'=>'text'
			),
			array(
				'id' => 'menuSocialPinterest',
				'name' => __('Menu Social Pinterest','rb'),
				'default' => 'http://pinterest.com',
				'type'=>'text'
			),
		)
	),
	array(
		'id' => 'style',
		'name'=>__('STYLE OPTIONS','rb'),
		'type'=>'fields',
		'imagemanager'=>'true',
		'icon'=>get_template_directory_uri().'/includes/adminimages/icon_generalsettings.png',
		'fields'=> array(
			array(
				'id' => 'colorFirst',
				'name' => __('First Color','rb'),
				'default' => '00b5e7',
				'type'=>'color'
			),
			array(
				'id'=>'colorBackground',
				'name'=>__('Background Color','rb'),
				'default'=> 'ffffff',
				'type'=>'color'
			),
			array(
				'id' => 'colorFont',
				'name' => __('Font Color','rb'),
				'default' => '222222',
				'type'=>'color'
			),
			array(
				'id' => 'headerFont',
				'name' => __('Header Font','rb'),
				'default' => 'Open Sans',
				'type'=>'font'
			),
			array(
				'id' => 'contentFont',
				'name' => __('Content Font','rb'),
				'default' => 'Raleway',
				'type'=>'font'
			),
		)
	),
);

?>