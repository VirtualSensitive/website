<?php
function rb_add_control_panel()
{
	add_menu_page('RB Panel', __('RB Admin', 'rb'), 'manage_options', 'top-level-menu-action', 'RBsettings', '','64');;
	add_action( 'admin_init', 'rb_reg_settings' );  
}
$rb_addScript = '';

function rb_reg_settings()
{
	global $Rb_SettingsOptions, $rb_addScript;
	foreach($Rb_SettingsOptions as $sm){
		if($sm['type'] == 'fields'){
			foreach($sm['fields'] as $field){
				if(get_option($field['id'])=== false){
					register_setting( 'rbsettings', $field['id']);
					$firstValue = '';
					if(isset($field['default'])) $firstValue = $field['default'];
					update_option($field['id'], $firstValue);
				}
			}
		}
	}
		
	// Define Google Web Fonts
	register_setting('rbsettings', 'fonts');
	if(get_option('fonts')=='' || isset($_GET['updatefonts']))
	{
		$googleFontUrl = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBgeqKlFdYj3Y7VwmrEXnXzpnx5TfKXG4o';
		WP_Filesystem();
		global $wp_filesystem;
		$googleFonts = $wp_filesystem->get_contents($googleFontUrl);;
		if(empty($googleFonts))
		{
			include 'googleFontList.php';
			$googleFonts = $rb_googleFontList;
		}else{
			if(get_option('fonts')!='')
				$rb_addScript .= "alert('Google Fonts has been updated');\n";
		}
		update_option('fonts', $googleFonts);
	}
	
}


function RBsettings()
{
wp_enqueue_media();
global $wpdb, $Rb_SettingsOptions, $rb_addScript;
$pURL = str_replace('http://'.$_SERVER['SERVER_NAME'],'',get_template_directory_uri());
$fonts = json_decode(get_option('fonts'));
?>
<script type="text/javascript">
var $ = jQuery.noConflict();
</script>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript">
	<?php echo $rb_addScript ?>
	
	var settingsVar = new Array();
	<?php
		foreach($Rb_SettingsOptions as $sm){
			if($sm['type'] == 'fields'){
				$sv = "settingsVar['".$sm['id']."'] = new Array(";
				foreach($sm['fields'] as $field){
					$sv .= "'".$field['id']."',";
				}
				$sv = substr($sv,0,-1);
				$sv .= "); \n";
				echo $sv;
			}
		}
	?>
	
	function themeCheck(){
		showMessage('waiting', '<?php  _e('Theme checking...','rb'); ?>', 'ctheme');
		$.post(ajaxurl, {'action':'check_theme'}, function(data){
			$('#checktheme').html(data);
			$('#checktheme').slideDown('slow');	
			showMessage('successful', '<?php _e('Theme has been checked successfully','rb'); ?>', 'ctheme');
		});	
	}
	
	jQuery(document).ready(function($){
		
		$('#rbmenu li a').click(function(){
			$(this).parent().parent().find('li').removeClass('selected');
			$(this).parent().addClass('selected');
		});
		
		
		$('#textoptions select[name=headerFont], #textoptions select[name=contentFont]').change(function(){
			loadFontVariants($(this).attr('name'), $(this).val()); 
		});  
		
		
		$('#rbmenu ul li:first-child a').trigger('click');
	});
	

	jQuery(document).ready(function($){
	
		locateMsg();
		$(window).bind('resize', function() {
					locateMsg();
				});
		$(window).bind('scroll', function() {
					locateMsg();
				});
	
		$('.colorSelector').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).find('input').val(hex);
				$(el).find('div').css('backgroundColor', '#'+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor($(this).find('input').val());
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		$('.colorSelectorControl').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).find('input').val(hex);
				$(el).find('div').css('backgroundColor', '#'+hex);
				$(el).ColorPickerHide();
				setBg($(el).parent().parent());
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor($(this).find('input').val());
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		$('.bgcontrol select[name=horizontal], .bgcontrol select[name=vertical]').change(function(){
			if($(this).val()=='value')	
				$(this).parent().find("input").show();
			else
			$(this).parent().find("input").hide();
		});

		$('.bgcontrol select').change(function(){
			setBg($(this).parent().parent());
		});

		$('.bgcontrol select, .bgcontrol input').blur(function(){
			setBg($(this).parent().parent());
		});
	
	});
	
	function locateMsg()
	{					
		var top = $(window).height()+$(window).scrollTop()-100;
		$('#messageArea').css('top', top+'px');
	}
		
	function showMessage(type, message, id)
	{
		if(type=='waiting')
		{
			$('#messageArea').append('<div class="waiting" id="waiting_'+id+'">'+message+'</div>').find('#waiting_'+id).slideDown('slow');
		}
		else if(type=='successful')
		{
			$('#waiting_'+id).slideUp('slow', function(){$(this).remove()});
			$('#messageArea').append('<div class="successful" id="successful_'+id+'">'+message+'</div>').find('#successful_'+id).slideDown('slow').delay(3000).slideUp('slow',function(){$(this).remove();});
		}
		else if(type=='error')
		{
			$('#waiting_'+id).slideUp('slow', function(){$(this).remove()});
			$('#messageArea').append('<div class="error2" id="error_'+id+'">'+message+'</div>').find('#error_'+id).slideDown('slow').delay(3000).slideUp('slow',function(){$(this).remove();});
		}
	}
	
	function saveSettings(objName)
	{
		if(!window.confirm('<?php _e('Are you sure to apply. If you continue all current settings will be change.','rb'); ?>'))
			return false;
		
		var varList ='';
		$('#'+objName+' input[type!=submit], #'+objName+' select').not('.novar').each(function(){
			varList += '&vars[]='+$(this).attr('name');
		});
		
		settingsData = '';
		$.each(settingsVar[objName],function(i,el){
			if($('#'+objName+' input[name='+el+']').length==1)
				if($('#'+objName+' input[name='+el+']').is(':checkbox'))
				{
					if($('#'+objName+' input[name='+el+']').is(':checked'))
						settingsData+='&'+el+'='+$('#'+objName+' input[name='+el+']').first().val();
				}
				else
					settingsData+='&'+el+'='+$('#'+objName+' input[name='+el+']').val();
			else if($('#'+objName+' select[name='+el+']').length==1)
				settingsData+='&'+el+'='+$('#'+objName+' select[name='+el+']').val();		
		});
		
		settingsData += varList;
		settingsData+="&action=rb_General_save";
		
		showMessage('waiting', '<?php _e('Saving general settings...','rb'); ?>', 'Generalsave');
		$.post(ajaxurl, settingsData, function(data){
			data = $.parseJSON(data);
			if(data.status=='OK')
			{			
				showMessage('successful', '<?php _e('General settings has been updated successfully.','rb'); ?>', 'Generalsave');
			}
			else
				showMessage('error', '<?php _e('Have got an error while saving settings.','rb'); ?>', 'Generalsave');
				
		});
		return false;
	}
	
	function getSettings(setid)
	{
		showMessage('waiting', '<?php _e('Getting current settings...','rb'); ?>', 'rb_get_general');
		$.post(ajaxurl, {'action':'rb_get_general','setid':setid}, function(data){
			data = $.parseJSON(data);
			showMessage('successful', '<?php _e('Current settings has been gotten successfully.','rb'); ?>', 'rb_get_general');	
			setForm(data);
			if($('#'+setid).is(':hidden')){
				$('#'+setid).slideDown('slow');
			}
		});
	}
	
	function loadFontVariants(area, font)
	{
		if(font!=undefined){
		$.ajax({ url:ajaxurl,
				 async: false,
				 data: {'action':'rb_load_font_variants', 'font':font },
				 dataType:'text',
				 type: "POST",
				 success:function(data){
					data = $.parseJSON(data); 
					if(data.status=='OK')
					{
						$('#rbcontent select[name="'+area+'Variant"] option').remove();
						for(i=0; i<data.variants.length; i++)
							$('#rbcontent select[name="'+area+'Variant"]').append($('<option></option>').text(data.variants[i]).attr('value', data.variants[i]));
					}else
						showMessage('error', '<?php _e('Have got an error while getting font variant','rb'); ?>', 'get_variant');
					}
			});
		}
	}
	
	function setForm(data)
	{
		$('#rbcontent input[type=text]').val('');
		$('#rbcontent select').selectedIndex = -1;
		$('#rbcontent .colorSelectorControl div').css("backgroundColor",'#FFFFFF');
		
		loadFontVariants('headerFont', data.headerFont);
		loadFontVariants('contentFont', data.contentFont);
		
			$.each(data, function(name,i){
				if($('#rbcontent input:checkbox[name='+name+']').length==1){
					if($('#rbcontent input:checkbox[name='+name+']').val()==data[name])
					{
						$('#rbcontent input:checkbox[name='+name+']').attr('checked','checked');
					}else{
						$('#rbcontent input:checkbox[name='+name+']').removeAttr('checked');
					}
				}else{
					$('#rbcontent input[name='+name+']').val(data[name]);
					$('#rbcontent select[name='+name+']').attr('selectedIndex', -1).find('option[value="'+data[name]+'"]').attr('selected','selected');
					$('#rbcontent input[name='+name+'][name*="color"]').parent().find("div").css('backgroundColor', '#'+data[name]);
				}
			});
			
			$('#rbcontent input[name$="bg"]').each(function(){
				// finding starting with "bg" for setting background properties
				var wrapper = $(this).parent().parent().find(".bgcontrol");
				// spliting parameters 
				var params = $(this).val().split(" ");				
				if(params.length>0)
				{
					// params[0] taransparent or color value
					if(params[0]=='transparent' || params[0]=='' || params[0]==' ')
					{
						// trnasparent or no color
						$(wrapper).find("select[name=colorOption]").find('option[value=transparent]').attr("selected","selected");
					}else{
						// set color value and "use color"
						params[0] = params[0].replace("#",'');
						$(wrapper).find("select[name=colorOption]").find('option[value=usecolor]').attr("selected","selected");
						$(wrapper).find(".colorSelectorControl input").val(params[0]);
						$(wrapper).find(".colorSelectorControl div").css("backgroundColor",'#'+params[0]);
					}
					
					// if have got backgroun image and other paramters
					if(params.length>1)
					{
						if(params[1]!='')
						{
							// params[1] is background url
							params[1] = params[1].replace("url('",'');
							params[1] = params[1].replace("')",'');
							$(wrapper).find("input[name=url]").val(params[1]);//URL
							
							// params[2] is predefined left value or horizontal pixel value
							if(params[2]=='left' || params[2]=='right' || params[2]=='center')
							{
								$(wrapper).find("select[name=horizontal]").find('option[value='+params[2]+']').attr("selected","selected");
								$(wrapper).find("input[name=horizontalValue]").hide();
							}
							else
							{
								$(wrapper).find("select[name=horizontal]").find('option[value="value"]').attr("selected","selected");
								$(wrapper).find("input[name=horizontalValue]").show().val(params[2]);
							}
							
							// params[2] is predefined top value or vertical pixel value
							if(params[3]=='top' || params[3]=='bottom' || params[3]=='middle')
							{
								$(wrapper).find("select[name=vertical]").find('option[value='+params[3]+']').attr("selected","selected");
								$(wrapper).find("input[name=verticalValue]").hide();
							}else{
								$(wrapper).find("select[name=vertical]").find('option[value="value"]').attr("selected","selected");
								$(wrapper).find("input[name=verticalValue]").show().val(params[3]);
							}
							// params[4] is predefined repeat value
							$(wrapper).find("select[name=repeat]").find('option[value='+params[4]+']').attr("selected","selected");
							// params[5] is predefined position value
							$(wrapper).find("select[name=position]").find('option[value='+params[5]+']').attr("selected","selected");
						}else{
							// if no value clear all
							$(wrapper).find("input[name=url]").val('');
							$(wrapper).find("select[name=horizontal]").selectedIntex = 1;
							$(wrapper).find("select[name=vertical]").selectedIntex = 1;
							$(wrapper).find("select[name=repeat]").selectedIntex = 1;
							$(wrapper).find("select[name=position]").selectedIntex = 1;
							$(wrapper).find("input[name=horizontalValue]").hide();
							$(wrapper).find("input[name=verticalValue]").hide();
						}
					}else{
							// if no value clear all
							$(wrapper).find("input[name=url]").val('');
							$(wrapper).find("select[name=horizontal]").selectedIntex = 1;
							$(wrapper).find("select[name=vertical]").selectedIntex = 1;
							$(wrapper).find("select[name=repeat]").selectedIntex = 1;
							$(wrapper).find("select[name=position]").selectedIntex = 1;
							$(wrapper).find("input[name=horizontalValue]").hide();
							$(wrapper).find("input[name=verticalValue]").hide();
					}
				}
			});
	}
	
	function setBg(obj)
	{
		bg = '';
		if($(obj).find('select[name=colorOption]').val()=='usecolor')
			bg = '#'+$(obj).find('input[name=color]').val();
		else
			bg = 'transparent';
		
		if($(obj).find('input[name=url]').val()!='')
		{
			bg += " url('"+$(obj).find('input[name=url]').val()+"')";
			if($(obj).find('select[name=horizontal]').val()=='value')
				bg += ' '+$(obj).find('input[name=horizontalValue]').val();
			else
				bg += ' '+$(obj).find('select[name=horizontal]').val();
			if($(obj).find('select[name=vertical]').val()=='value')
				bg += ' '+$(obj).find('input[name=verticalValue]').val();
			else
				bg += ' '+$(obj).find('select[name=vertical]').val();
			bg += ' '+$(obj).find('select[name=repeat]').val();
			bg += ' '+$(obj).find('select[name=position]').val();
		}
		$(obj).parent().find('input:first').val(bg);
	}
	
	function getSettingsOptions(settingsID, settingsType, settingsImageManager, callfunction){
		$('#rbcontent > div').slideUp('slow');
		
		if(settingsType=='fields'){
			getSettings(settingsID);
		}else if(settingsType=='area'){
			if($('#'+settingsID).is(':hidden'))
				$('#'+settingsID).slideDown('slow');
		}else{
			var fn = window[callfunction];
			if(typeof fn === 'function')
				fn();
		}
		
	}
	
// <!-- Audio Functions 
	jQuery(document).ready(function($){
		$('#addAudioButton').click(function(){
			var emptyAudioItem = '<?php echo str_replace(array("\r\n", "\n", "\r"), '', rb_createAudioItem('', '', '')); ?>';
			$('#audiomanager form > table > tbody').append($(emptyAudioItem));
		});
	});
	
	function getAudioManager(){
		showMessage('waiting', '<?php _e('Getting audio list...','rb'); ?>', 'getaudio');
		$.post(ajaxurl, {'action':'rb_get_audio_list'}, function(data){
			$('#audiomanager').slideDown('slow');
			$('#audiomanager form tbody').html(data);
			$('#audiomanagerbody').sortable({
				start:function(event, ui){
					ui.item.addClass('activeMove');
				},
				stop:function(event, ui){ 
					ui.item.removeClass('activeMove');
				},
				cancel: 'input, textarea'
			});
			showMessage('successful', '<?php _e('Audio list has been gotted successfully','rb'); ?>', 'getaudio');
		});
	}
	
	function removeAudioItem(obj){
		if(window.confirm('Are you sure delete?')){
			$(obj).closest('table').slideUp('slow', function(){
				$(this).closest('tr').remove();
			});
		}
	}
	
	function saveAudio(){
		var settingsData = $('#audiomanager form').serialize();
		settingsData+="&action=rb_save_audio_list";
		showMessage('waiting', 'Saving audio list...', 'saveaudio');
		$.post(ajaxurl, settingsData, function(data){
			showMessage('successful', 'Audio list has been saved successfully', 'saveaudio');
		});
		return false;
	}
	
	// Audio Functions End -->


</script>
<style>
#messageArea { position:absolute; left:0px; top:0px; width:800px; z-index:999;}
#messageArea .waiting{padding:5px 5px 5px 25px; background:url('<?php echo get_template_directory_uri(); ?>/images/admin-loading.gif') #FF7300 5px center no-repeat; color:#FFFFFF; display:none;}
#messageArea .successful{padding:5px; background-color:#10CD02; color:#FFFFFF; display:none;}
#messageArea .error2{padding:5px; background-color:#FF0000; color:#FFFFFF; display:none;}

.widefat td{
	padding:8px;
}

.trueHeader{
	background: url('../images/gray-grad.png') repeat-x scroll left top #DFDFDF;	
	-moz-border-radius-topleft:3px;
	-moz-border-radius-topright:3px;
	padding:10px;
	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
	border:1px solid #DFDFDF;
}
.trueWrapper{
	background-color:#FFFFFF;
	-moz-border-radius-topleft:3px;
	-moz-border-radius-topright:3px;
	-moz-border-radius-bottomleft:3px;
	-moz-border-radius-bottomright:3px;
	border:1px solid #DFDFDF;
}
.colorSelectorWrapper{
	height:35px;
}
.colorSelector, .colorSelectorControl {
	width: 36px;
	height: 36px;
	float:left;
}
.colorSelector div, .colorSelectorControl div{
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: url(<?php echo get_template_directory_uri(); ?>/includes/colorpicker/images/select2.png) center;
}
.color{
	display:none;
	margin-left:40px;
}
.bgcontrol > div {
	clear:both;
}
.bgcontrol select{
	width:100px;
}
.bgcontrol label{
	float:left;
	width:80px;
}

.gl{
	border:3px solid #ddd;
	padding:2px;
	text-align:center;
	margin:2px auto;
}
.gl_active
{
	border-color:#bbb; 
}
.da{
	width:200px;
}
.glcontrol{
	border: 2px solid #ddd;
	background-color: #eee;
	position:absolute;
	padding:5px;
} 
.glcontrol h5{
	margin:0;
}

.subText{
	float:left;
	margin-right:5px;
	width:50px;
}
#settingShow{
	display:none;
}

	* html .clearfix {
		height: 1%; /* IE5-6 */
	}
	*+html .clearfix {
		display: inline-block; /* IE7not8 */
	}
	.clearfix:after { /* FF, IE8, O, S, etc. */
		content: ".";
		display: block;
		height: 0;
		clear: both;
		visibility: hidden;
	}
	.colorpicker{
		z-index:99;
	}
	.settedfp{
		font-weight:bold;
		color:red;
	}
	
	
	#rbwrap{width:800px; margin-top:20px;}
	#rbheader{height:46px;}
	.rbheaderbordertop{height:3px; background-image:url('<?php echo get_template_directory_uri(); ?>/includes/adminimages/header-bg1.png');}
	.rbheaderborderbottom{height:3px; background-color:#2c2c2c;}
	#rbheadermenu{height:40px; background-color:#333;}
	#rbmenu{background-color:#2c2c2c; width:170px; float:left;}
	#rbheadermenuleft{
		float:left;
		width:250px;
	}
	#rbheadermenuright{
		text-align:right;
		float:right;
		width:500px;
	}
	#rbbody{background-color:#eeeeee;}
	#rbcontent{background-color:#eeeeee; width:630px; float:left;}
	
	
	#rbmenu ul{list-style:none; margin:0;}
	#rbmenu ul li{
		width:164px; 
		height:40px; 
		margin:0 3px;
		background-color:#333333;
		margin-bottom:3px;
	}
	#rbmenu ul li a:link,
	#rbmenu ul li a:visited{
		-moz-transition: all 0.5s ease-in-out 0s;
		transition: all 0.5s ease-in-out;
		-webkit-transition: all 0.5s ease-in-out;
		-o-transition: all 0.5s ease-in-out;
		
		display:block;
		height:40px;
		font-size:11px; 
		font-family: 'Open Sans', sans-serif; 
		font-weight:800;
		text-decoration:none;
		box-shadow: 1px 1px rgba(255,255,255,.1) inset, -1px -1px rgba(0,0,0,.3) inset;
		
		background: -moz-linear-gradient(top,  rgba(255,255,255,0.07) 0%, rgba(255,255,255,0) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.07)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  rgba(255,255,255,0.07) 0%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  rgba(255,255,255,0.07) 0%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  rgba(255,255,255,0.07) 0%,rgba(255,255,255,0) 100%); /* IE10+ */
		background: linear-gradient(top,  rgba(255,255,255,0.07) 0%,rgba(255,255,255,0) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#12ffffff', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */

	}
	#rbmenu ul li a:hover,
	#rbmenu ul li a:active{		
		background: -moz-linear-gradient(top,  rgba(255,255,255,0) 0%, rgba(255,255,255,0.07) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0)), color-stop(100%,rgba(255,255,255,0.07))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.07) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.07) 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.07) 100%); /* IE10+ */
		background: linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.07) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#12ffffff',GradientType=0 ); /* IE6-9 */
	}
	#rbmenu ul li a:link span,
	#rbmenu ul li a:visited span{	
		background-repeat:repeat-y;
		background-position: 0px 0px;
	}
	#rbmenu ul li a:hover span,
	#rbmenu ul li a:active span{	
		background-position:0 -40px;
	}
	#rbmenu ul li a:hover div,
	#rbmenu ul li a:active div{
		color:#bbbbbb;
	}
	
	#rbmenu ul li a div{
		-moz-transition: all 0.5s ease-in-out 0s;
		transition: all 0.5s ease-in-out;
		-webkit-transition: all 0.5s ease-in-out;
		-o-transition: all 0.5s ease-in-out;
		
		vertical-align:top;
		display:inline-block;
		height:40px;
		color:#6e6e6e;
		line-height:40px;
	}
	#rbmenu ul li a span{
		-moz-transition: all 0.5s ease-in-out 0s;
		transition: all 0.5s ease-in-out;
		-webkit-transition: all 0.5s ease-in-out;
		-o-transition: all 0.5s ease-in-out;
		
		display:inline-block;
		width:40px;
		height:40px;
	}
	
	#rbmenu ul li.selected{
		width:167px; 
		height:40px; 
		margin:0 0 3px 3px;
		background-color:#eeeeee;
	}
	#rbmenu ul li.selected a:link,
	#rbmenu ul li.selected a:visited,
	#rbmenu ul li.selected a:hover,
	#rbmenu ul li.selected a:active{
		cursor:default;
		color:6e6e6e;
		background:none;
		box-shadow:none;
		box-shadow: 1px 1px rgba(255,255,255,1) inset;
	}
	#rbmenu ul li.selected a:link span,
	#rbmenu ul li.selected a:visited span,
	#rbmenu ul li.selected a:hover span,
	#rbmenu ul li.selected a:active span{
		background-position:0 0;
	}
	#rbmenu ul li.selected a:link div,
	#rbmenu ul li.selected a:visited div,
	#rbmenu ul li.selected a:hover div,
	#rbmenu ul li.selected a:active div{
		color:#6e6e6e;
	}
	
	#rbheadermenuleft a:link,
	#rbheadermenuleft a:visited{
		display:inline-block;
		height:40px;
		line-height:40px;
		padding:0 15px;
		font-size:14px; 
		font-family: 'Open Sans', sans-serif; 
		font-weight:800;
		color:#ffffff;
		background-color:#3d3d3d;
		text-decoration:none;
	}
	#rbheadermenuleft a:hover,
	#rbheadermenuleft a:active{
		color:#ffffcc;
	}
	#rbheadermenuright a:link,
	#rbheadermenuright a:visited{
		text-align:left;
		display:inline-block;
		height:33px;
		line-height:1.2em;
		padding:7px 13px 0px 46px;
		font-size:10px; 
		font-family: Tahoma;
		color:#ffffff;
		background-color:#3d3d3d;
		text-decoration:none;
		margin-left:1px;
		background-position:6px 7px;
		background-repeat:no-repeat;
	}
	#rbheadermenuright a:hover,
	#rbheadermenuright a:active{
		color:#ffffcc;
	}
	
	
	
	.statusIcon{
		width:15px;
		height:15px;
		margin:2px auto 0 auto;
	}
	.statusOK{	background:url("<?php echo get_template_directory_uri(); ?>/images/list-check.png") no-repeat; }
	.statusNOK{	background:url("<?php echo get_template_directory_uri(); ?>/images/list-cross.png") no-repeat; }

	.ErrInfo, .attentionbox, .downloadbox, .ErrMessage{
		padding:20px 20px 20px 75px;
		border:2px solid #333;
		margin:10px;
	}
	.ErrInfo{
		border-color:#0066cc;
		color:#0066cc;
		background: url('<?php echo get_template_directory_uri(); ?>/images/box-info.png') 20px center no-repeat;
	}
	.attentionbox{
		border-color:#ffcc00;
		color:#ffcc00;
		background: url('<?php echo get_template_directory_uri(); ?>/images/box-attention.png') 20px center no-repeat;
	}
	.downloadbox{
		border-color:#009900;
		color:#009900;
		background: url('<?php echo get_template_directory_uri(); ?>/images/box-download.png') 20px center no-repeat;
	}
	.ErrMessage{
		border-color:#ff0000;
		color:#ff0000;
		background: url('<?php echo get_template_directory_uri(); ?>/images/box-cross.png') 20px center no-repeat;
	}
	.statusWait{ display:none; }
	
	</style>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,800' rel='stylesheet' type='text/css'>
	
	<div id="messageArea"></div> 
	
	
	
	<div id="rbwrap">
		<div id="rbheader">
			<div class="rbheaderbordertop"></div>
			<div id="rbheadermenu">
				<div id="rbheadermenuleft"><a href="http://themeforest.net/user/RenkliBeyaz/portfolio" target="_blank"><?php _e('RENKLIBEYAZ\'S THEMES','rb'); ?></a></div>
				<div id="rbheadermenuright">
					<a href="<?php _e('http://themeforest.net/user/renklibeyaz/follow','rb'); ?>" target="_blank" style="background-image:url('<?php echo get_template_directory_uri(); ?>/includes/adminimages/icon_star.png');"><?php _e('Follow us on<br />Themeforest','rb'); ?></a>
					<a href="<?php _e('http://renklibeyaz.com/forum/purchisecode.html','rb'); ?>" target="_blank" style="background-image:url('<?php echo get_template_directory_uri(); ?>/includes/adminimages/icon_lock.png');"><?php _e('Forum<br />Register Code','rb'); ?></a>
					<a href="<?php _e('http://renklibeyaz.com/forum/','rb'); ?>" target="_blank" style="background-image:url('<?php echo get_template_directory_uri(); ?>/includes/adminimages/icon_forum.png');"><?php _e('Support<br />Forum','rb'); ?></a>
					<a href="<?php _e('http://twitter.com/renklibeyaz','rb'); ?>" target="_blank" style="background-image:url('<?php echo get_template_directory_uri(); ?>/includes/adminimages/icon_tw.png');"><?php _e('Follow us on<br />Twitter','rb'); ?></a>
				</div>
			</div>
			<div class="rbheaderborderbottom"></div>
		</div>
		<div id="rbbody"> 
			<div id="rbmenu">
				<ul>
					<?php
					foreach($Rb_SettingsOptions as $sm){
						echo '<li><a href="javascript:void(0);" 
							onclick="getSettingsOptions(\''.$sm['id'].'\', \''.$sm['type'].'\',  \''.$sm['imagemanager'].'\', '.(($sm['type']=='script')?'\''.$sm['run'].'\'':'null').')">
							<span style="'.((!empty($sm['icon']))?'background-image:url(\''.$sm['icon'].'\');':'').'" ></span><div>'.$sm['name'].'</div></a></li>';
					}
					?>
				</ul>
			</div>
			<div id="rbcontent">
			<!-- ******************************   CONTENT START   ****************************** -->
			
			
			
			<?php
				foreach($Rb_SettingsOptions as $sm){
					if($sm['type']=='fields')
					{
					echo '<div id="'.$sm['id'].'" style="display:none">';
					echo '<form method="post" action="#" onsubmit="return saveSettings(\''.$sm['id'].'\');">';
					echo '<table cellpadding="0" style="width:590px; margin:20px;" class="widefat">';
					echo '<thead>
						<tr>
							<th width="131">'.__('Option', 'rb').'</th>
							<th width="425">'.__('Value', 'rb').'</th>
						</tr>
					</thead>
					<tbody>
					<tr class="gs">
						<td align="left">
	                        <input type="submit" id="apply" class="button" value="'.__('Apply Settings','rb').'" />
                        </td>
						<td align="right"></td>
					</tr>';
						foreach($sm['fields'] as $field){
							echo '<tr class="gs">';
							echo '<td>'.$field['name'].'</td>';
							echo '<td>';
							
							if(isset($field['before'])) echo $field['before'];
							
							if($field['type']=='onoff')
							{
								echo '<input type="checkbox" class="normal" name="'.$field['id'].'" value="'.$field['on'].'" id="'.$field['id'].'" />';
							}
							elseif($field['type']=='color')
							{
								echo '<div class="colorSelector"><div style="background-color:"></div>';
								echo '<input type="text" class="color" name="'.$field['id'].'" value="" />';
								echo '</div>';
							}
							elseif($field['type']=='text')
							{
								echo '<input type="text" name="'.$field['id'].'" value="" style="width:300px;" />';
							}
							elseif($field['type']=='select')
							{
								echo '<select name="'.$field['id'].'" style="width:100px;">';
								if(is_array($field['options'])){
									if(rb_is_assoc($field['options']))
										foreach($field['options'] as $optionk => $optionv)
											echo '<option value="'.$optionv.'">'.$optionk.'</option>';
									else
										foreach($field['options'] as $option)
											echo '<option value="'.$option.'">'.$option.'</option>';
								}
								echo '</select>';
							}
							elseif($field['type']=='url')
							{
								echo '<div class="url">';
								echo '<input type="text" name="'.$field['id'].'" value="" style="width:300px;"/>';
								echo '<button class="button geturlfromfilemanager">'.__('Get URL','rb').'</button>';
								echo '</div>';
							}
							elseif($field['type']=='font')
							{
								echo '<select name="'.$field['id'].'" style="width:200px;">';
								echo '<option value="">Default</option>';
								for($i=0; $i<sizeof($fonts->items); $i++)
									echo '<option value="'.$fonts->items[$i]->family.'" >'.$fonts->items[$i]->family.'</option>';
								echo '</select>';
								echo '<select name="'.$field['id'].'Variant" style="width:100px;"></select>';
							}
							elseif($field['type']=='defaultgallery')
							{
								echo '<select name="'.$field['id'].'" style="width:200px;">';
								echo '<option value="">No Gallery</option>';
								$galleryPosts = new WP_Query( array('post_type'=>'rb-gallery', 'post_status' => array( 'publish', 'private' )) );
								if($galleryPosts->have_posts()){
									while($galleryPosts->have_posts()){
										$galleryPosts->the_post();
										echo '<option value="'.get_the_ID().'" >'.get_the_title().'</option>';
									}
								}
								echo '</select>';
							}
							elseif($field['type']=='topsection')
							{
								echo '<select name="'.$field['id'].'" style="width:200px;">';
								echo '<option value="none">'.__('None', 'rb').'</option>';
								$galleryPosts = new WP_Query( array('post_type'=>'rb-gallery', 'post_status' => array( 'publish', 'private' )) );
								
								if(function_exists('rev_slider_shortcode')){
									$rev_results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."revslider_sliders");
									if ( $rev_results )
									{
										foreach ( $rev_results as $rev_row )
											echo '<option value="revslider::'.$rev_row->alias.'" > RevSlider > '.$rev_row->title.'</option>';
									}								
								}
								$wp_created_pages = get_pages(); 
								foreach ( $wp_created_pages as $wp_created_page ) 
									echo '<option value="page::'.$wp_created_page->ID.'" > Page > '.$wp_created_page->post_title.'</option>';
								
								echo '</select>';
							}elseif($field['type']=='integer'){
								echo '<input type="text" name="'.$field['id'].'" style="width:50px;" value="" />';
							}elseif($field['type']=='background'){
								echo '<label><input type="text" name="'.$field['id'].'" value="" style="width:300px; display:none" /></label>';
								echo '<div id="'.$field['id'].'-bgcontrol" class="bgcontrol">';
								?>
								<div>
									<label>Color: </label>
									<div class="colorSelectorControl"><div style="background-color:">
										<input class="novar" type="text" name="color" value="" style="display:none"/>
										</div>
									</div>
										<select class="novar" name="colorOption">
											<option value="transparent"><?php echo _e('Transparent','rb'); ?></option>
											<option value="usecolor"><?php echo _e('Use Color','rb'); ?></option>
										</select>
								</div>
								<div class="url">
									<label><?php echo __('Url:','rb'); ?> </label>
									<input class="novar" type="text" name="url" value="" style="width:280px;"/>
									<button class="button geturlfromfilemanager">'<?php echo _e('Get URL','rb'); ?></button>
									
								</div>
								<div class="horizontal">
									<label>
									<?php  _e('Horizontal:','rb'); ?>
									</label>
										<select name="horizontal" class="novar">
											<option value="left"><?php  _e('Left','rb'); ?></option>
											<option value="right"><?php  _e('Right','rb'); ?></option>
											<option value="center"><?php _e('Center','rb'); ?></option>
											<option value="value"><?php _e('Value','rb'); ?></option>
										</select>
										<input class="novar" type="text" name="horizontalValue" value="" style="display:none"/>
									
								</div>
								<div class="vertical">
									<label>
									<?php _e('Vertical:','rb'); ?>
									</label>
										<select class="novar" name="vertical">
											<option value="top"><?php _e('Top','rb'); ?></option>
											<option value="bottom"><?php _e('Bottom','rb'); ?></option>
											<option value="middle"><?php _e('Middle','rb'); ?></option>
											<option value="value"><?php _e('Value','rb'); ?></option>
										</select>
										<input class="novar" type="text" name="verticalValue" value="" style="display:none"/>
									
								</div>
								<div class="novar" class="repeat">
									<label>
									<?php  _e('Repeat:','rb'); ?>
									</label>
										<select class="novar" name="repeat">
											<option value="repeat"><?php _e('Repeat','rb'); ?></option>
											<option value="repeat-x"><?php _e('Repeat-X','rb'); ?></option>
											<option value="repeat-y"><?php _e('Repeat-Y','rb'); ?></option>
											<option value="no-repeat"><?php _e('No-Repeat','rb'); ?></option>
										</select>
									
								</div>
								<div class="position">
									<label>
									<?php _e('Position:','rb'); ?>
									</label>
										<select class="novar" name="position">
											<option value="scroll"><?php _e('Scroll','rb'); ?></option>
											<option value="fixed"><?php _e('Fixed','rb'); ?></option>
										</select>
									
								</div>
								<?php
								echo '</div>';
							}elseif($field['type']=='info'){
								echo $field['infotext'];
							}
							if(isset($field['after'])) echo $field['after'];
							echo '</td>';
							echo '</tr>';
						}
						
					echo '<tr class="gs">
						<td align="left">
	                        <input type="submit" id="apply2" class="button" value="'.__('Apply Settings','rb').'" />
                        </td>
						<td align="right"></td>
						</tr>
					</tbody>
					</table>
					</form>
					</div>';				
					}
				}
			?>
			
			
			
			
			
			
			<!-- ****   AUDIO MANAGER START   **** -->
			<div id="audiomanager" style="display:none">
			<form method="post" action="#" onsubmit="return saveAudio();"> 
			<table cellpadding="0" style="width:590px; margin:20px;" class="widefat">
				<thead>
					<tr>
						<th colspan="2">AUDIO LIST</th>
					</tr>
				</thead>                
				<tbody id="audiomanagerbody">
				
				</tbody>
				<tfoot>
					<tr>
						<td>
							<input type="submit" name="saveAudioBtn" id="saveAudioBtn" class="button" value="Save Audio List" />
						</td>
						<td align="right">
							<input class="button" type="button" name="addAudioButton" id="addAudioButton" value="Add Audio"/>
						</td>
					</tr>
				</tfoot>
			</table>
			</form>
			</div>
			<!-- ****  AUDIO MANAGER END   **** -->
			
			
			

			
				
				<!-- ******************************   CONTENT END   ****************************** -->
			</div>
		<div class="clearfix"></div>
		</div>
	<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
<!-- New Theme END -->


<?php
}
?>