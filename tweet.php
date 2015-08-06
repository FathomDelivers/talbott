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
	 
	 
	//echo json_encode($tweets);
	foreach($tweets as $tweet) {
   		echo "<li>";
   		echo "<a href='http://twitter.com/$twitteruser'>@$twitteruser</a>";
   		echo " ";
   		echo $tweet->created_at;
   		echo "<br />";
   		echo $tweet->text;
   		echo "</li>";
	}
?>