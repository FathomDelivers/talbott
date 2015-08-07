<?php
	session_start();
	require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); //Path to twitteroauth library
	 
	$twitteruser = "TalbottRecovery";
	$notweets = 3;
	$consumerkey = "jVRKt3yHQffU70jjg7SZNa60B";
	$consumersecret = "fgz6PUxV2DkU34ApMuVj90jV543sBjtBAXt2leNg62NPsDuI3F";
	$accesstoken = "1482284173-4PM9bPN5i7ui1B4AdJhEuNw1abTs4b57k4mPZIE";
	$accesstokensecret = "c5LKH7205Sd1ws4DVW4vLXhWy3TOJVUFUQSXoK7ujv62I";
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}

	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	 
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	 

	//timeSince last tweet instead of created_at
	function timeSince($time) {
    $since = time() - strtotime($time);
    $string     = '';
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }
    $string = ($count == 1) ? '1 ' . $name . ' ago' : $count . ' ' . $name . 's ago';
    return $string;
  }
	 
	//echo json_encode($tweets);
	foreach($tweets as $tweet) {
   		echo "<li>";
   		echo "<a href='http://twitter.com/$twitteruser'>@$twitteruser</a>";
   		echo " ";
   		echo timeSince($tweet->created_at);
   		echo "<br />";
   		echo $tweet->text;
   		echo "</li>";
	}

?>