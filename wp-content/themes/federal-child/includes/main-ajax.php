<?php
add_action('wp_ajax_nopriv_rb_post-like', 'rb_post_like');  
add_action('wp_ajax_rb_post-like', 'rb_post_like');  

$rb_timebeforerevote = 120; // = 2 hours  
function rb_post_like()
{
	// Check for nonce security
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
	
	if(isset($_POST['post_id']))
	{
		// Retrieve user IP address
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];
		
		// Get voters'IPs for the current post
		$meta_IP = get_post_meta($post_id, "voted_IP");
		
		$voted_IP = array();
		if(isset($meta_IP[0]))
			$voted_IP = @$meta_IP[0];
			
		// Get votes count for the current post
		$meta_count = get_post_meta($post_id, "votes_count", true);

		// Use has already voted ?
		if(!rb_hasAlreadyVoted($post_id))
		{
			$voted_IP[$ip] = time();

			// Save IP and increase votes count
			update_post_meta($post_id, "voted_IP", $voted_IP);
			update_post_meta($post_id, "votes_count", ++$meta_count);
			
			// Display count (ie jQuery return value)
			echo $meta_count;
		}
		else
			echo "already";
	}
	exit;
}

function rb_hasAlreadyVoted($post_id)
{
	global $rb_timebeforerevote;

	// Retrieve post votes IPs
	$meta_IP = get_post_meta($post_id, "voted_IP");
	$voted_IP = array();
	if(isset($meta_IP[0]))
		$voted_IP = $meta_IP[0];
		
	
	if(!is_array($voted_IP))
		$voted_IP = array();
		
	// Retrieve current user IP
	$ip = $_SERVER['REMOTE_ADDR'];
	
	// If user has already voted
	if(in_array($ip, array_keys($voted_IP)))
	{
		$time = $voted_IP[$ip];
		$now = time();
		
		// Compare between current time and vote time
		if(round(($now - $time) / 60) > $rb_timebeforerevote)
			return false;
			
		return true;
	}
	
	return false;
}

add_action('wp_ajax_nopriv_rb_blogloadmore', 'rb_blogloadmore');  
add_action('wp_ajax_rb_blogloadmore', 'rb_blogloadmore');
function rb_blogloadmore()
{
	// Check for nonce security
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
	global $paged;
	$paged = (int) $_POST['paged'];
	$attrsList = array('cats', 'postperpage');
	$attrs = '';
	foreach($attrsList as $attrItem){
		$value = trim($_POST[$attrItem]);
		if(!empty($value))
			$attrs .= $attrItem.'="'.$value.'" ';
	}
	$blogdata = do_shortcode('[rb_blog '.$attrs.']');
	$re = array('paged'=>$paged, 'content'=>$blogdata);
	echo json_encode($re);
	exit;
}

add_action('wp_ajax_nopriv_rb_portfolioloadmore', 'rb_portfolioloadmore');  
add_action('wp_ajax_rb_portfolioloadmore', 'rb_portfolioloadmore');
function rb_portfolioloadmore()
{
	// Check for nonce security
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
	global $paged;
	$paged = (int) $_POST['paged'];
	$paged++;
	$attrsList = array('cats','postperpage', 'imagewidth', 'imageheight');
	$attrs = '';
	foreach($attrsList as $attrItem){
		$value = trim($_POST[$attrItem]);
		if(!empty($value))
			$attrs .= $attrItem.'="'.$value.'" ';
	}
	$portfoliodata = do_shortcode('[rb_portfolio type="none" '.$attrs.']');
	$re = array('paged'=>$paged, 'content'=>$portfoliodata);
	echo json_encode($re);
	exit;
}

add_action('wp_ajax_nopriv_rb_getTweets', 'rb_getTweets');
add_action('wp_ajax_rb_getTweets', 'rb_getTweets');  
function rb_getTweets()
{
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
	
	require_once("twitteroauth/twitteroauth.php"); 
	 
	$twitteruser = $_POST['user'];
	$notweets = (int) $_POST['limit'];
	$consumerkey = rb_opt('twitterConsumerKey','');
	$consumersecret = rb_opt('twitterConsumerSecret','');
	$accesstoken = rb_opt('twitterAccessToken','');
	$accesstokensecret = rb_opt('twitterAccessTokenSecret','');
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	
	
	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	$re = '';
	
	if($connection){
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
		$tweetsArr = json_decode(json_encode($tweets), true);

		if(is_array($tweetsArr)){
			if(sizeof($tweetsArr)>0 && !isset($tweetsArr['errors'])){
				for($t=0; $t<sizeof($tweetsArr); $t++){
				
					//$tweetTimestamp = strtotime($tweetsArr[$t]['created_at']);
					$datetime = new DateTime($tweetsArr[$t]['created_at']);
					$datetime->setTimezone(new DateTimeZone('Europe/Istanbul'));

					$tweetText = $tweetsArr[$t]['text'];
					$tweetText = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" class="tweet-link" target="_blank">http://$1</a>', $tweetText);
					$tweetText = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" class="tweet-user" target="_blank">@$1</a>', $tweetText);
					
					$re .= '<div class="item">';
					$re .= '<p class="text-center">';
					$re .= $tweetText;
					$re .= '<br><br>';
					$re .= '<span class="font-color">'.humanTiming($datetime->format('U')).'</span>';
					$re .= '</p>';
					$re .= '</div>';
					
				
				}
			
			}else{
				$re .= '<div class="item"><p>'.$tweetsArr['errors'][0]['message'].'<br><br><span class="font-color">'.$tweetsArr['errors'][0]['code'].'</p></div>';
			}
		}
	}else{
		$re .= '<div class="item"><p>'.__('Twitter api connection error', 'rb').'</p></div>';
	}

	
	echo $re;
	exit;
}

add_action('wp_ajax_nopriv_rb_getWidgetTweets', 'rb_getWidgetTweets');
add_action('wp_ajax_rb_getWidgetTweets', 'rb_getWidgetTweets');  
function rb_getWidgetTweets()
{
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
	
	require_once("twitteroauth/twitteroauth.php"); 
	 
	$twitteruser = $_POST['user'];
	$notweets = (int) $_POST['limit'];
	
	$consumerkey = rb_opt('twitterConsumerKey','');
	$consumersecret = rb_opt('twitterConsumerSecret','');
	$accesstoken = rb_opt('twitterAccessToken','');
	$accesstokensecret = rb_opt('twitterAccessTokenSecret','');
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	
	
	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	 
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	$tweetsArr = json_decode(json_encode($tweets), true);

	$re = '';
	if(sizeof($tweetsArr)>0){
		for($t=0; $t<sizeof($tweetsArr); $t++){
		
			$datetime = new DateTime($tweetsArr[$t]['created_at']);
			$datetime->setTimezone(new DateTimeZone('Europe/Istanbul'));

			$tweetText = $tweetsArr[$t]['text'];
			$tweetText = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" class="tweet-link" target="_blank">http://$1</a>', $tweetText);
			$tweetText = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" class="tweet-user" target="_blank">@$1</a>', $tweetText);
			
			$re .= '<li class="jtwt_tweet">';
			$re .= '<p class="jtwt_tweet_text">';
			$re .= $tweetText;
													
			$re .= ' <a href="http://twitter.com/'.$twitteruser.'/statuses/'.$tweetsArr[$t]['id_str'].'" class="jtwt_date">'.humanTiming($datetime->format('U')).'</a>';
			
			$re .= '</p>';
			$re .= '</li>';
		}
	}else{
		$re .= __('Have got an error while connecting to twitter api', 'rb');
	}

	
	echo $re;
	exit;
}

function humanTiming ($time)
{
	$time = time() - $time; // to get the time since that moment
	$tokens = array (
		31536000 => 'year',
		2592000 => 'month',
		604800 => 'week',
		86400 => 'day',
		3600 => 'hour',
		60 => 'minute',
		1 => 'second'
	);
	foreach ($tokens as $unit => $text) {
		if ($time < $unit) continue;
		$numberOfUnits = floor($time / $unit);
		return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').__(' ago','rb');
	}
}


add_action('wp_ajax_nopriv_rb_send_contact_form', 'rb_send_contact_form');
add_action('wp_ajax_rb_send_contact_form', 'rb_send_contact_form');  
function rb_send_contact_form(){
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');

	$re = array();
	
	$rb_form = '<table cellspacing="1" cellpadding="2" border="0">'."\n";

	foreach($_POST as $key => $value)
		if(!in_array($key, array('action', 'nonce')) )
			$rb_form .= "<tr>\n\t<td valign=\"top\">".$key."</td>\n\t<td>".htmlspecialchars($value)."</td>\n</tr>";

	$rb_form .= '</table>';

	$rb_subject = 'Online Form from '.get_bloginfo('name');

	// To send HTML mail, the Content-type header must be set
	$rb_headers  = 'MIME-Version: 1.0' . "\r\n";
	$rb_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$rb_headers .= 'From: '.get_bloginfo('name')." <".get_bloginfo('admin_email').">\r\n";

	// Mail it
	if(function_exists('wp_mail'))
		$rb_result = wp_mail(get_bloginfo('admin_email'), $rb_subject, $rb_form, $rb_headers);
	else
		$rb_result = mail(get_bloginfo('admin_email'), $rb_subject, $rb_form, $rb_headers);

	if($rb_result)
		$re  = array( 'status'=>'OK', 'message'=> __('Your message has been sent successfully.','rb') );
	else
		$re  = array( 'status'=>'NOK', 'error'=> __('Have got an error while sending e-mail.', 'rb') );

	echo json_encode($re);
	exit;
}
?>