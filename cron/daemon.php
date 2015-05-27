<?php

$consumer_key = $_SESSION['CONSUMER_KEY'];
$consumer_secret = $_SESSION['CONSUMER_SECRET'];
$tweet = $tweet = new \models\entities\Tweet();
$tweetDao = new \models\daos\TweetDao(); 
$tweets = $tweetDao->get_tweet_to_publish();

if (!$tweets) {
    exit;
}

foreach ($tweets as $tweet) {
    $user = new \models\entities\User();
    $userDao = new \models\daos\UserDao();

    $user = $userDao->getUserByTweet($tweet);
    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $user->getOauthToken(), $user->getOauthTokenSecret());
    $connection->post('statuses/update', array('status' => $tweet->getText()));
    success_to_publish($tweet);
}
