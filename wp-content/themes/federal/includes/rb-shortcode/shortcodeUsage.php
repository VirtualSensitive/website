<?php
/*

$rb_shorcodesUsage['codeName'] = array(
				'label'=>__('Title of the Modal Dialog', 'rb'), 
				'content'=> false | 'html' | 'text' | 'shortcode',
				'contentType'=>'orderlist', // it can use if content id 'shortcode' 
				'contentShortCode' => 'su array(
					'id' =>  array(
						'label' => __('Label of the field','rb'),
						'validation' => 'required' | 'number' | 'url' | 'cssvalue', // optional
						'validationOptional' => 'true', // optional, it will check if value is not empty
						'validationAllowing' => 'float,negative', // optional it can use with can use with validation
						'type' => 'select', 'gallerylist' | 'text' | 'group' | 'singleimage' | 'iconname' | 'revslider',
						'help' => __('help text optional', 'rb'),
						'values'=> array( 'ON'=>'true', 'OFF'=>'false'), // it can use if type is group or select
						'sequential' => array(1,18,1), // it can use if type is select
						'default' => 'true' // optional
					),
				)
			)

*/
$animatejsList = array('bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'wobble', 
'bounceIn', 'bounceInDown', 'bounceInLeft', 'bounceInRight', 'bounceInUp', 'bounceOut', 'bounceOutDown', 'bounceOutLeft', 'bounceOutRight', 'bounceOutUp', 
'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig', 
'fadeOut', 'fadeOutDown', 'fadeOutDownBig', 'fadeOutLeft', 'fadeOutLeftBig', 'fadeOutRight', 'fadeOutRightBig', 'fadeOutUp', 'fadeOutUpBig',
'flip', 'flipInX', 'flipInY', 'flipOutX', 'flipOutY',
'lightSpeedIn', 'lightSpeedOut',
'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight',
'rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight', 'rotateOutUpLeft', 'rotateOutUpRight',
'slideInDown', 'slideInLeft', 'slideInRight', 'slideOutLeft', 'slideOutRight', 'slideOutUp',
'hinge', 'rollIn', 'rollOut');

$rb_shorcodesUsage = array();

$rb_shorcodesUsage['flexslider'] = array(
				'label'=>__('Flex Slider', 'rb'), 
				'content'=>false,
				'params' => array(
					'id' =>  array(
						'label' => __('Gallery','rb'),
						'validation' => 'required',
						'type' => 'gallerylist',
						'help' => __('You should choose a gallery. If you have not a gallery yet, you can should create a gallery.', 'rb')
					),
					'thumbnails' =>  array(
						'label' => __('Show Thumbnails','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values'=> array( 'Yes'=>'true', 'No'=>'false'),
						'default' => 'true'
					),
				)
			);
			
$rb_shorcodesUsage['person'] = array(
				'label'=>__('Person', 'rb'), 
				'content'=>'text',
				'params' => array(
					'name' =>  array(
						'label' => __('Full Name','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'title' =>  array(
						'label' => __('Title or Position','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'image' =>  array(
						'label' => __('Photo','rb'),
						'validation' => 'url',
						'type' => 'singleimage',
						'help' => '400x400 px recommend for 4 columns.'
					),
					'facebook' => array(
						'label' => __('Facebook Page', 'rb'),
						'validation' => '',
						'validationOptional' => 'true',
						'type' => 'text'
					),
					'twitter' => array(
						'label' => __('Twitter Page', 'rb'),
						'validation' => '',
						'validationOptional' => 'true',
						'type' => 'text'
					),
					'googleplus' => array(
						'label' => __('Google Plus Page', 'rb'),
						'validation' => '',
						'validationOptional' => 'true',
						'type' => 'text'
					),
				)
			);


$rb_shorcodesUsage['video'] = array(
				'label'=>__('Video', 'rb'), 
				'content'=>false,
				'params' => array(
					'url' =>  array(
						'label' => __('Url of the Video','rb'),
						'validation' => 'url',
						'type' => 'text',
						'help' => __('You can use url of the youtube or vimeo video directly (not iframe code). Also you can use self hosted video. We recommend mp4 files for to watch all browsers.', 'rb')
					),
					'width' =>  array(
						'label' => __('Width','rb'),
						'validation' => 'number',
						'type' => 'text',
						'default' => '16'
					),
					'height' =>  array(
						'label' => __('Height','rb'),
						'validation' => 'number',
						'type' => 'text',
						'default' => '9'
					),
					'poster' =>  array(
						'label' => __('Poster','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'singleimage',
						'help' => __('You can choose poster image if you use a self hosted video.', 'rb')
					)
				)
			);
			
$rb_shorcodesUsage['map'] = array(
				'label'=>__('Google Map', 'rb'), 
				'content'=>'html',
				'params' => array(
					'lat' =>  array(
						'label' => __('Latitude','rb'),
						'validation' => 'number',
						'validationAllowing' => 'float,negative',
						'type' => 'text',
						'help' => __('You can find Latitude and Longitude value of your location from Google Map', 'rb')
					),
					'lng' =>  array(
						'label' => 'Longitude',
						'validation' => 'number',
						'validationAllowing' => 'float,negative',
						'type' => 'text'
					),
					'width' =>  array(
						'label' => 'Width',
						'validation' => 'cssvalue',
						'type' => 'text',
						'default'=>'100%'
					),
					'height' =>  array(
						'label' => 'Height',
						'validation' => 'cssvalue',
						'type' => 'text',
						'default' => '100px'
					),
					'zoom' =>  array(
						'label' => 'Zoom',
						'type' => 'select',
						'sequential' => array(1,18,1),
						'default' => 11
					),
					'control' => array(
						'label' => 'Show Control',
						'type' => 'group',
						'values'=> array( 'ON'=>'true', 'OFF'=>'false'),
						'default' => 'true'
					),
					'maptype' => array(
						'label' => 'Map Type',
						'type' => 'group',
						'values' => array( 'Hybrid'=>'hybrid', 'Roadmap'=>'roadmap', 'Satellite'=>'satellite', 'Terrain'=>'terrain'),
						'default' => 'hybrid'
					)
				)
			);

$rb_shorcodesUsage['button'] = array(
				'label'=>__('Button', 'rb'), 
				'content'=>false,
				'params' => array(
					'title' =>  array(
						'label' => __('Title of the Button','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'size' =>  array(
						'label' => __('Size','rb'),
						'validation' => 'required',
						'type' => 'select',
						'values' => array('Xsmall'=>'xsmall', 'Small'=>'small', 'Normal'=>'', 'Large'=>'large'),
						'default' => ''
					),
					'color' =>  array(
						'label' => __('Color/Type of the Button','rb'),
						'validation' => 'number',
						'type' => 'select',
						'values' => array('Primary'=>'primary', 'Success'=>'success', 'Info'=>'info', 'Warning'=>'warning', 'Danger'=>'danger', 'Link'=>'link', 'Default'=>'default'),
						'default' => 'default'
					),
					'link' =>  array(
						'label' => __('Link','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'text'
					),
					'target' =>  array(
						'label' => __('Target of the Link','rb'),
						'type' => 'select',
						'values' => array('Self'=>'_self', 'Blank Page'=>'_blank')
					),
					'block' => array(
						'label' => __('Block Button','rb'),
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'false'
					)
				)
			);
			
$rb_shorcodesUsage['accordition'] = array(
				'label'=>__('Accordition', 'rb'), 
				'content'=>'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'accordition_item',
				'contentShortCodeLabel' => __('Accordition Item', 'rb')
			);

$rb_shorcodesUsage['accordition_item'] = array(
				'label'=>__('Accordition Item', 'rb'), 
				'content'=>'html',
				'defaultTitle' => 'title',
				'params' => array(
					'title' =>  array(
						'label' => __('Title of the Item','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'show' =>  array(
						'label' => __('Show this item','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Show'=>'true', 'Hide'=>'false'),
						'default' => 'false'
					)
				)
			);
			
$rb_shorcodesUsage['tab'] = array(
				'label'=>__('Tab', 'rb'), 
				'content'=>'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'tab_item',
				'contentShortCodeLabel' => __('Tab Item', 'rb')
			);

$rb_shorcodesUsage['tab_item'] = array(
				'label'=>__('Accordition Item', 'rb'), 
				'content'=>'html',
				'defaultTitle' => 'title',
				'params' => array(
					'title' =>  array(
						'label' => __('Title of the Tab Item','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'show' =>  array(
						'label' => __('Show this item','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Show'=>'true', 'Hide'=>'false'),
						'default' => 'false'
					)
				)
			);
			
$rb_shorcodesUsage['icon'] = array(
				'label'=>__('Icon', 'rb'), 
				'content'=>false,
				'params' => array(
					'name' =>  array(
						'label' => __('Choose an icon','rb'),
						'validation' => 'required',
						'type' => 'iconname',
					),
					'size' =>  array(
						'label' => __('Size','rb'),
						'validation' => 'required',
						'type' => 'select',
						'values' => array('Normal'=>'', 'Large'=>'lg', '2X Size'=>'2x', '3X Size'=>'3x', '4X Size'=>'4x', '5X Size'=>'5x'),
						'default' => ''
					),
					'type' =>  array(
						'label' => __('Rotate or Flip','rb'),
						'validation' => 'required',
						'type' => 'select',
						'values' => array('Normal'=>'', 'Rotate 90'=>'rotate-90', 'Rotate 180'=>'rotate-180', 'Rotate 270'=>'rotate-270', 'Flip Horizontal'=>'flip-horizontal', 'Flip Vertical'=>'flip-vertical'),
						'default'=>''
					)
				)
			);
			
$rb_shorcodesUsage['message-box'] = array(
				'label'=>__('Message Box', 'rb'), 
				'content'=>'html',
				'params' => array(
					'color' =>  array(
						'label' => __('Color','rb'),
						'validation' => 'required',
						'type' => 'select',
						'values' => array('Success'=>'success', 'Info'=>'info', 'Warning'=>'warning', 'Danger'=>'danger'),
						'default' => 'success'
					),
					'dismissable' =>  array(
						'label' => __('Dismissable','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'false'
					)
				)
			);
			
$rb_shorcodesUsage['tooltip'] = array(
				'label'=>__('Tooltip', 'rb'), 
				'content'=>'text',
				'params' => array(
					'text' => array(
						'label' => __('Tooltip Content','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'position' =>  array(
						'label' => __('Position','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Top'=>'top', 'Bottom'=> 'bottom', 'Left'=>'left', 'Right'=>'right'),
						'default' => 'top'
					),
					'link' =>  array(
						'label' => __('Link','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'text'
					),
					'target' => array(
						'label' => __('Target Window', 'rb'),
						'type' => 'select',
						'values' => array('Same Window'=>'', 'Blank Page'=>'_blank'),
						'default' => ''
					)
				)
			);
$rb_shorcodesUsage['popover'] = array(
				'label'=>__('Popover', 'rb'), 
				'content'=>'textarea',
				'params' => array(
					'text' => array(
						'label' => __('Popover Content','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'position' =>  array(
						'label' => __('Position','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Top'=>'top', 'Bottom'=> 'bottom', 'Left'=>'left', 'Right'=>'right'),
						'default' => 'top'
					),
					'link' =>  array(
						'label' => __('Link','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'text'
					),
					'target' => array(
						'label' => __('Target Window', 'rb'),
						'type' => 'select',
						'values' => array('Same Window'=>'', 'Blank Page'=>'_blank'),
						'default' => ''
					)
				)
			);
			
$rb_shorcodesUsage['progress'] = array(
				'label'=>__('Progress', 'rb'), 
				'content'=>'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'progress-bar',
				'contentShortCodeLabel' => __('Progress Bar', 'rb'),
				'params' => array(
					'striped' =>  array(
						'label' => __('Striped','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default'=>'false'
					),
					'active' =>  array(
						'label' => __('Active','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default'=>'false'
					)
				)
			);

$rb_shorcodesUsage['progress-bar'] = array(
				'label'=>__('Progress Bar', 'rb'), 
				'content'=>false,
				'defaultTitle' => 'percent',
				'params' => array(
					'percent' =>  array(
						'label' => __('Percent of the progress bar','rb'),
						'validation' => 'required',
						'type' => 'select',
						'sequential' => array(0,100,1),
						'default'=>'50'
					),
					'min' =>  array(
						'label' => __('Minimum value of the progress bar','rb'),
						'validation' => 'required',
						'type' => 'select',
						'sequential' => array(0,100,1),
						'default'=>'0'
					),
					'max' =>  array(
						'label' => __('Maximum value of the progress bar','rb'),
						'validation' => 'required',
						'type' => 'select',
						'sequential' => array(0,100,1),
						'default'=>'100'
					),
					'color' => array(
						'label' => __('Choose a color for the progress bar', 'rb'),
						'validation' => 'required',
						'type' => 'select',
						'values' => array('Success'=>'success', 'Info'=>'info', 'Warning'=>'warning', 'Danger'=>'danger'),
						'default' => 'success'
					)
				)
			);

$rb_shorcodesUsage['list-group'] = array(
				'label'=>__('List Group', 'rb'), 
				'content'=>'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'item',
				'contentShortCodeLabel' => __('List Group Item', 'rb'),
			);

$rb_shorcodesUsage['item'] = array(
				'label'=>__('List Group Item', 'rb'), 
				'content'=>false,
				'defaultTitle' => 'contenttext',
				'params' => array(
					'contenttext' =>  array(
						'label' => __('Content of the item','rb'),
						'validation' => 'required',
						'type' => 'text'
					),
					'heading' =>  array(
						'label' => __('Heading (optional)','rb'),
						'type' => 'text',
					),
					'link' =>  array(
						'label' => __('Link (optional)','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'text'
					),
					'target' => array(
						'label' => __('Target Window', 'rb'),
						'type' => 'select',
						'values' => array('Same Window'=>'', 'Blank Page'=>'_blank'),
						'default' => ''
					),
					'active' => array(
						'label' => __('Selected Item', 'rb'),
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'false',
						'help' => __('This option works only with links', 'rb')
					),
					'badge' => array(
						'label' => __('Badge (optional)', 'rb'),
						'type' => 'text',
						'help' => __('Please don\'t use with Header and Link')
					)
				)
			);
			
$rb_shorcodesUsage['panel'] = array(
				'label'=>__('Panel', 'rb'), 
				'content'=>'html',
				'params' => array(
					'color' => array(
						'label' => __('Choose a color for the progress bar', 'rb'),
						'validation' => 'required',
						'type' => 'select',
						'values' => array('Success'=>'success', 'Info'=>'info', 'Warning'=>'warning', 'Danger'=>'danger'),
						'default' => 'success'
					),
					'header' =>  array(
						'label' => __('Header (optional)','rb'),
						'type' => 'text'
					),
					'footer' => array(
						'label' => __('Footer (optional)', 'rb'),
						'type' => 'text'
					)
				)
			);

			
$rb_shorcodesUsage['rb_blog'] = array(
				'label'=>__('Blog Page', 'rb'), 
				'content'=>false,
				'params' => array(
					'cats' => array(
						'label' => __('Choose Categoies', 'rb'),
						'type' => 'listcreator',
						'function' => 'blog_categories',
						'help' => __('If you don\'t choose any category, all categoies will be show', 'rb') 
					),
					'metaformat' => array(
						'label' => __('Choose Meta Formats', 'rb'),
						'type' => 'listcreator',
						'values' => array('Posted By' => 'posted', 'Comments' => 'comments', 'Tags'=>'tag', 'Category'=>'category', 'Like Button'=>'like'),
						'default' => 'category, like',
						'help' => __('If you don\'t choose any meta format, all meta formats will be show', 'rb') 
					),
					'postperpage' =>  array(
						'label' => __('Post Per Page','rb'),
						'validation' => 'required',
						'type' => 'select',
						'sequential' => array(1,100,1),
						'default' => 12
					)
				)
			);

$rb_shorcodesUsage['rb_portfolio'] = array(
				'label'=>__('Portfolio Page', 'rb'), 
				'content'=>false,
				'params' => array(
					'cats' => array(
						'label' => __('Choose Categoies', 'rb'),
						'type' => 'listcreator',
						'function' => 'portfolio_categories',
						'help' => __('If you don\'t choose any category, all categoies will be show', 'rb') 
					),
					'imagewidth' => array(
						'label' => __('Image Width', 'rb'),
						'type' => 'text',
						'validation' => 'number',
						'default' => '300',
					),
					'imageheight' => array(
						'label' => __('Image Height', 'rb'),
						'type' => 'text',
						'validation' => 'number',
						'default' => '300',
					),
					'type' =>  array(
						'label' => __('Filter Type','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Filter'=>'filter', 'In Page Filter'=>'filterinpage'),
						'default' => 'filter'
					)
				)
			);
			
/* Additional Shortcodes */
$rb_shorcodesUsage['testimonial'] = array(
				'label'=>__('Testimonial', 'rb'), 
				'content'=>'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'testimonial_item',
				'contentShortCodeLabel' => __('Testimonial Item', 'rb'),
				'params' => array(
					'animate' =>  array(
						'label' => __('Animation','rb'),
						'type' => 'select',
						'values' => $animatejsList,
						'default' => '',
						'help' => 'You can see and try all animation in <a href="http://daneden.github.io/animate.css/" target="_blank">this page</a>',
					),
				)
			);

$rb_shorcodesUsage['testimonial_item'] = array(
				'label'=>__('Testimonial Item', 'rb'), 
				'content'=>'text',
				'defaultTitle' => 'owner',
				'params' => array(
					'owner' =>  array(
						'label' => __('Owner of the Testimonial','rb'),
						'type' => 'text'
					),
					'title' =>  array(
						'label' => __('Title','rb'),
						'type' => 'text'
					),
					'image' =>  array(
						'label' => __('Photo','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'singleimage',
					),
				)
			);
			
$rb_shorcodesUsage['page_header'] = array(
				'label'=>__('Page Header', 'rb'), 
				'content'=>'text',
				'params' => array(
					'subtext' =>  array(
						'label' => __('Sub Text','rb'),
						'type' => 'text',
						'help' => __('Optional', 'rb'),
					),
					'animate' =>  array(
						'label' => __('Animation','rb'),
						'type' => 'select',
						'values' => $animatejsList,
						'default' => '',
						'help' => 'You can see and try all animation in <a href="http://daneden.github.io/animate.css/" target="_blank">this page</a>',
					)
				)
			);
			
			
$rb_shorcodesUsage['hi_icon'] = array(
				'label'=>__('Icon + Text', 'rb'), 
				'content'=> false,
				'params' => array(
					'subtext' =>  array(
						'label' => __('Sub Text','rb'),
						'type' => 'text',
					),
					'icon' =>  array(
						'label' => __('Choose an icon','rb'),
						'validation' => 'required',
						'type' => 'iconname',
					)
				)
			);

$rb_shorcodesUsage['icon_text'] = array(
				'label'=>__('Icon + Title + Content', 'rb'), 
				'content'=> 'html',
				'params' => array(
					'title' =>  array(
						'label' => __('Title','rb'),
						'type' => 'text',
					),
					'icon' =>  array(
						'label' => __('Choose an icon','rb'),
						'validation' => 'required',
						'type' => 'iconname',
					),
					'link' =>  array(
						'label' => __('Link','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'text'
					),
				)
			);
			
$rb_shorcodesUsage['thumbnail_icon'] = array(
				'label'=>__('Thumbnail Icon + Title + Content', 'rb'), 
				'content'=> 'html',
				'params' => array(
					'title' =>  array(
						'label' => __('Title','rb'),
						'type' => 'text',
					),
					'icon' =>  array(
						'label' => __('Choose an icon','rb'),
						'validation' => 'required',
						'type' => 'iconname',
					)
				)
			);
			
$rb_shorcodesUsage['pin_contact'] = array(
				'label'=>__('Pin Contact', 'rb'), 
				'content'=> 'html',
				'params' => array(
					'title' =>  array(
						'label' => __('Title','rb'),
						'type' => 'text',
					),
					'icon' =>  array(
						'label' => __('Choose an icon','rb'),
						'validation' => 'required',
						'type' => 'iconname',
					)
				)
			);
			
$rb_shorcodesUsage['score'] = array(
				'label'=>__('Score', 'rb'), 
				'content'=> false,
				'params' => array(
					'title' =>  array(
						'label' => __('Title','rb'),
						'type' => 'text',
					),
					'value' =>  array(
						'label' => __('Score','rb'),
						'type' => 'text',
					)
				)
			);
			
$rb_shorcodesUsage['circle_processbar'] = array(
				'label'=>__('Circle Processbar', 'rb'), 
				'content'=> false,
				'params' => array(
					'title' =>  array(
						'label' => __('Title','rb'),
						'type' => 'text',
					),
					'percent' =>  array(
						'label' => __('Value','rb'),
						'validation' => 'required',
						'type' => 'select',
						'sequential' => array(0,100,1),
						'default' => '25'
					),
					'color' =>  array(
						'label' => __('Color','rb'),
						'validation' => 'hexcolor',
						'type' => 'color',
						'default' => '#999999'
					),
				)
			);
			
			
$rb_shorcodesUsage['twitter_feeds'] = array(
				'label'=>__('Twitter Feeds', 'rb'), 
				'content'=> false,
				'params' => array(
					'user' =>  array(
						'label' => __('Username','rb'),
						'type' => 'text',
						'help' => __('You should fill twitter api parametes to use this shortcode before', 'rb'),
					),
					'limit' =>  array(
						'label' => __('Value','rb'),
						'validation' => 'required',
						'type' => 'select',
						'sequential' => array(0,100,1),
						'default' => '6'
					),
					'animate' =>  array(
						'label' => __('Animation','rb'),
						'type' => 'select',
						'values' => $animatejsList,
						'default' => '',
						'help' => 'You can see and try all animation in <a href="http://daneden.github.io/animate.css/" target="_blank">this page</a>',
					)
					
				)
			);
			
$rb_shorcodesUsage['brands'] = array(
				'label'=>__('Brands', 'rb'), 
				'content'=> 'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'brands_item',
				'contentShortCodeLabel' => __('Brands Item', 'rb'),
				'params' => array(
					'columns' =>  array(
						'label' => __('Column Count','rb'),
						'type' => 'select',
						'sequential' => array(0,12,1),
						'default' => '4',
					),
					'animate' =>  array(
						'label' => __('Animation','rb'),
						'type' => 'select',
						'values' => $animatejsList,
						'default' => '',
						'help' => 'You can see and try all animation in <a href="http://daneden.github.io/animate.css/" target="_blank">this page</a>',
					),
				)
			);

$rb_shorcodesUsage['brands_item'] = array(
				'label'=>__('Brands Item', 'rb'), 
				'content'=>false,
				'defaultTitle' => 'title',
				'params' => array(
					'title' =>  array(
						'label' => __('Title','rb'),
						'type' => 'text',
					),
					'image' =>  array(
						'label' => __('Logo','rb'),
						'validation' => 'url',
						'type' => 'singleimage',
						'help' => 'Please use colorfull image. It will be shown gray automatically'
					),
				)
			);

$rb_shorcodesUsage['owl-slider'] = array(
				'label'=>__('Owl Slider', 'rb'), 
				'content'=> 'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'owl-item',
				'contentShortCodeLabel' => __('Owl Slider Item', 'rb'),
			);
			
$rb_shorcodesUsage['owl-item'] = array(
				'label'=>__('Owl Slider Item', 'rb'), 
				'content'=>'html',
				'defaultTitle' => 'header',
				'params' => array(
					'header' =>  array(
						'title' => __('Header','rb'),
						'type' => 'text',
					),
				)
			);

$rb_shorcodesUsage['owl-item-button'] = array(
				'label'=>__('Owl Item Button', 'rb'), 
				'content'=>'text',
				'params' => array(
					'link' =>  array(
						'label' => __('Link','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'text'
					),
					'target' =>  array(
						'label' => __('Target of the Link','rb'),
						'type' => 'select',
						'values' => array('Self'=>'_self', 'Blank Page'=>'_blank')
					)
				)
			);
			
$rb_shorcodesUsage['rainy'] = array(
				'label'=>__('Rainy Background', 'rb'), 
				'content'=>false,
				'params' => array(
					'image' =>  array(
						'label' => __('Logo','rb'),
						'validation' => 'url',
						'type' => 'singleimage',
						'help' => 'Please use a big image for background.'
					),
					'pattern' =>  array(
						'label' => __('Use Pattern','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'true'
					)
				)
			);
			
$rb_shorcodesUsage['video-parallax'] = array(
				'label'=>__('Youtube Background', 'rb'), 
				'content'=>false,
				'params' => array(
					'video' =>  array(
						'label' => __('Url of the Youtube Video','rb'),
						'validation' => 'url',
						'type' => 'text',
						'help' => __('You can use just Youtube url. For example; http://www.youtube.com/watch?v=XXXXXX', 'rb'),
					),
					'name' =>  array(
						'title' => __('Header','rb'),
						'type' => 'text',
						'help' => __('Name of the Video', 'rb')
					),
					'showbg' =>  array(
						'label' => __('Use Pattern','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'true'
					),
					'autoplay' =>  array(
						'label' => __('Auto Play','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'true'
					),
					'loop' =>  array(
						'label' => __('Loop','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'true'
					),
					'mute' =>  array(
						'label' => __('Mute','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'true'
					),
					'soundcontrol' =>  array(
						'label' => __('Sound Control','rb'),
						'validation' => 'required',
						'type' => 'group',
						'values' => array('Yes'=>'true', 'No'=>'false'),
						'default' => 'true'
					)
				)
			);
$rb_shorcodesUsage['rb_single_pag'] = array(
				'label'=>__('Single Page Creator', 'rb'), 
				'content'=>'html',
				'defaultTitle' => 'header',
				'params' => array(
					'header' =>  array(
						'title' => __('Header','rb'),
						'type' => 'text',
					),
				)
			);
			
$rb_shorcodesUsage['rb_single_page'] = array(
				'label'=>__('Single Page Creator', 'rb'), 
				'content'=> 'shortcode',
				'contentType'=>'orderlist',
				'contentShortCode' => 'rb_page',
				'contentShortCodeLabel' => __('Single Page Section', 'rb'),
			);
$rb_shorcodesUsage['rb_page'] = array(
				'label'=>__('Single Page Section', 'rb'), 
				'content'=>false,
				'defaultTitle' => 'slug',
				'params' => array(
					'slug' => array(
						'title' => __('Choose a page for this section', 'rb'),
						'type' => 'pagelist',
						'validation' => 'required',
					),
					'type' =>  array(
						'label' => __('Type of the Section','rb'),
						'validation' => 'required',
						'type' => 'select',
						'values' => array('Boxed'=>'boxed', 'Boxed Full Background'=>'boxedfullbg', 'Boxed Full Background with Parallax'=>'boxedfullbgparallax', 'Full Width'=>'fullwidth'),
						'default' => 'boxed'
					),
					'bgimage' =>  array(
						'label' => __('Background Image','rb'),
						'validation' => 'url',
						'validationOptional' => 'true',
						'type' => 'singleimage',
						'help' => 'Please choose with background type'
					),
					'parallaxspeed' =>  array(
						'label' => __('Parallax Speed','rb'),
						'type' => 'select',
						'sequential' => array(0,1,.05),
						'default' => '.2',
						'help' => 'Please choose with parallax type'
					),
				)
			);
?>