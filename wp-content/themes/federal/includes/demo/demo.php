<?php 
function demo_switch_html(){ ?>
<div id="switch">
	<div class="switch-heading">
		Select Style 
		<i class="fa fa-cog show-setting">
		</i>
	</div>
	<div class="switch-options">
		<div class="switch-section clearfix">
			<p class="message text-center">
				Select a color		
			</p>
			<p>
				<a class="colorchange amethyst" data-codecolor="#9b59b6" >
				Amethyst
				</a>
				<a class="colorchange carrot" data-codecolor="#e67e22" >
				Carrot
				</a>
				<a class="colorchange emerald" data-codecolor="#2ecc71">
				Green
				</a>
				<a class="colorchange river" data-codecolor="#00b5e7" >
				Blue
				</a>
				<a class="colorchange pomegranate" data-codecolor="#c0392b" >
				Red
				</a>
				<a class="colorchange pumpkin" data-codecolor="#d35400">
				Pumpkin
				</a>
				<a class="colorchange yellow" data-codecolor="#f1c40f">
				Yellow
				</a>
				<a class="colorchange turquoise" data-codecolor="#1abc9c">
				Turquoise
				</a>
			</p>
			<p class="message text-center">
				Select Layout
			</p>
			<div class="text-center">
				<?php 
					$rb_defType = 'ytvideo';
					//if(isset($_COOKIE['defType'])) $rb_defType = $_COOKIE['defType'];
					if(isset($_GET['home_page_alternative'])) $rb_defType = $_GET['home_page_alternative'];
				?>
				<select class="form-control">
					<option value="none" <?php if($rb_defType=='none') echo 'selected' ?>>
						None
					</option>
					<option value="revslider" <?php if($rb_defType=='revslider') echo 'selected' ?> >
						Revolution Slider
					</option>
					<option value="ytvideo" <?php if($rb_defType=='ytvideo') echo 'selected' ?> >
						Youtube Video
					</option>
					<option value="rainy" <?php if($rb_defType=='rainy') echo 'selected' ?> >
						Rainy Day
					</option>
				</select>
			</div>
		</div>
	</div>
</div>
<?php } 

function rb_get_demo_top_section(){
	if(!is_front_page()){ echo ''; return false; }
	
	$rb_defType = 'ytvideo';
	//if(isset($_COOKIE['defType'])) $rb_defType = $_COOKIE['defType'];
	if(isset($_GET['home_page_alternative'])) $rb_defType = $_GET['home_page_alternative'];
	switch($rb_defType){
		case 'revslider':
		rb_show_top_section('revslider', 'home');
		rb_demo_audio_player();
		break;
		
		case 'ytvideo':
		rb_show_top_section('page', '222');
		break;
		
		case 'rainy':
		rb_show_top_section('page', '230');
		rb_demo_audio_player();
		break;
		
		default:
		echo '';
	}
}

function rb_demo_audio_player(){
	?>
	<div class="audio-plr">
		<div id="jquery_jplayer_1" data-mp3="http://mythemes.renklibeyaz.com/federalwp/wp-content/uploads/2014/04/1680350_earthtone_ghost.mp3"></div>
		<div id="jp_container_1">
			<a href="#" class="jp-play"><?php _e('Play', 'rb'); ?></a>
			<a href="#" class="jp-pause"><?php _e('Pause', 'rb'); ?></a>
		</div>
	</div>
	<?php
}
?>