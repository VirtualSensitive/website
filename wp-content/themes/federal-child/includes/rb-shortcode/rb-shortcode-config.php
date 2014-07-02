<?php
$RbShortcodePluginUrl = get_template_directory_uri().'/includes/rb-shortcode/';

$rb_shortcodeMap = array(
				'Layout Elements' => 	array(
								'type'  => 'category',
								'items' => array(
						'1/1' => "[row][col12]Content goes here[/col12][/row]",
						'1/2 x2 Columns' => "[row][col6]Content goes here[/col6][col6]Content goes here[/col6][/row]",
						'1/3 x3 Columns' => "[row][col4]Content goes here[/col4][col4]Content goes here[/col4][col4]Content goes here[/col4][/row]",
						'1/4 x4 Columns' => "[row][col3]Content goes here[/col3][col3]Content goes here[/col3][col3]Content goes here[/col3][col3]Content goes here[/col3][/row]",
						'1/6 x6 Columns' => "[row][col2]Content goes here[/col2][col2]Content goes here[/col2][col2]Content goes here[/col2][col2]Content goes here[/col2][col2]Content goes here[/col2][col2]Content goes here[/col2][/row]",
						'2/3 + 1/3' => "[row][col8]Content goes here[/col8][col4]Content goes here[/col4][/row]",
						'3/4 + 1/4' => "[row][col9]Content goes here[/col9][col3]Content goes here[/col3][/row]",
						'Row'		=> '[row]Columns goes here[/row]'
					)
				),
				'Quick Elements' => array(
							'type' => 'category',
							'items' => array(
						'page_header',
						'button',
						'icon',
						'icon_text',
						'thumbnail_icon',
						'hi_icon',
						'score',
						'pin_contact',
						'tooltip',
						'popover',
						'message-box',
						'Highlight' => '[highlight] Word [/highlight]',
						'Highlight2' => '[highlight2] Word [/highlight2]',
						'Separator' => '[separator]'
					)
				),
				'Content Elements' => 	array( 
								'type'  => 'category',
								'items' => array(
						'flexslider',
						'owl-slider',
						'owl-item-button',
						'video',
						'map',
						'twitter_feeds',
						'person',
						'testimonial',
						'circle_processbar',
						'brands',
						'tab',
						'accordition',
						'progress',
						'panel',
						'list-group',
						'Sidebar' => '[sidebar]'
					)
				),
				'Pages' => 	array( 
								'type'  => 'category',
								'items' => array(
						'rb_blog',
						'rb_portfolio',
						'rb_single_page',
					)
				),
				'Top Section' => array( 
								'type'  => 'category',
								'items' => array(
						'rainy',
						'video-parallax',
					)
				)
			);
?>