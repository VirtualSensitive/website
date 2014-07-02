<?php
add_action('wp_ajax_rb_General_save', 'rb_General_save');
function rb_General_save()
{
	foreach($_POST['vars'] as $regKey)
	{
		if(array_key_exists($regKey, $_POST)){
			update_option($regKey, $_POST[$regKey]);
		}else{
			$item = rb_getSettingsItem($regKey);
			// getSettingsItem is defined in function.php
			if(is_array($item)){
				update_option($regKey, $item['off']);
			}else{
				update_option($regKey, '');
			}	
		}
	}
		echo '{"status":"OK", "type":"apply"}';
	die();
}

add_action('wp_ajax_rb_get_general', 'rb_get_general');
function rb_get_general()
{
	global $Rb_SettingsOptions;
	foreach($Rb_SettingsOptions as $sm){
		if($sm['type']=='fields' && $sm['id']==$_POST['setid']){
			foreach($sm['fields'] as $field){
				$default = '';
				if(isset($field['default'])) $default = $field['default'];
				$ret[$field['id']]=stripslashes(get_option($field['id'], $default));
			}
			break;
		}
	}
	echo json_encode($ret);
	die();
}

add_action('wp_ajax_rb_load_font_variants', 'rb_load_font_variants');
function rb_load_font_variants()
{
	echo '{"status":"OK", "variants":'.json_encode(rb_getFont($_POST['font'],'variants')).'}';
	// where is this func
	die();
}

// *** Audio Function Begin *** 
function rb_createAudioItem($name, $mp3, $ogg){
	return '<tr>
		<td align="left" colspan="2">
			<table cellpadding="0" style="width:550px; margin:10px;" class="widefat">
			<tr style="width:100px;">
				<td>Name</td>
				<td>
					<input type="text" name="audioName[]" value="'.$name.'" style="width:200px" />
					<input class="button" onclick="removeAudioItem(this);" type="button" name="removeAudio"  value="Remove This Item"/>
				</td>
			</tr>
			<tr>
				<td>Mp3 File Path</td>
				<td><input type="text" name="audioMp3Path[]" value="'.$mp3.'" style="width:440px" /></td>
			</tr>
			<tr>
				<td>Ogg File Path</td>
				<td><input type="text" name="audioOggPath[]" value="'.$ogg.'" style="width:440px" /></td>
			</tr>
			</table>
		</td>
	</tr>';
}

add_action('wp_ajax_rb_get_audio_list', 'rb_get_audio_list');
function rb_get_audio_list(){
	$audioList = get_option("audioList");
	$listHTML = '';
	if(!empty($audioList))
	{
		$audioJSON = json_decode($audioList);
		for($i=0; $i<sizeof($audioJSON); $i++)
		{
			$listHTML .= rb_createAudioItem(
				htmlentities(stripslashes($audioJSON[$i]->name),ENT_QUOTES, "UTF-8"), 
				htmlentities(stripslashes($audioJSON[$i]->mp3),ENT_QUOTES, "UTF-8"), 
				htmlentities(stripslashes($audioJSON[$i]->ogg),ENT_QUOTES, "UTF-8"));
		}
	}
	echo $listHTML;
	die();
}

add_action('wp_ajax_rb_save_audio_list', 'rb_save_audio_list');
function rb_save_audio_list(){
	$datas = array();
	for($i=0; $i<sizeof($_POST['audioName']); $i++){
		array_push($datas, array('name'=>$_POST['audioName'][$i], 'mp3'=>$_POST['audioMp3Path'][$i], 'ogg'=>$_POST['audioOggPath'][$i]));
	}
	update_option('audioList', json_encode($datas));
	echo '{"status":"OK"}';
	die();
}
// *** Audio Function End *** 

?>