<?php

// Get Tweets to Publish
$tweets = get_tweet_to_publish();
// If empty, exit!
if (!$tweets) {
    exit;
}
$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_secret);
foreach ($tweets as $tweet) {
    $connection->post('statuses/update', array('status' => $tweet['tweet']));
    success_to_publish($tweet['id']);
}
