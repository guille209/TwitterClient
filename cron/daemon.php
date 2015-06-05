<?php

require_once '../config/twitterConfig.php';
require_once '../config/bootstrap.php';
require_once '../vendor/autoload.php';
require_once '../vendor/abraham/twitteroauth/src/TwitterOAuth.php';


$tweet = $tweet = new \models\entities\Tweet();
$tweetDao = new \models\daos\TweetDao();


while (true) {
    sleep(1);
    $tweets = $tweetDao->get_tweet_to_publish();


    foreach ($tweets as $tweet) {
        $user = new \models\entities\User();
        $userDao = new \models\daos\UserDao();

        $user = $userDao->getUserByTweet($tweet);
        $connection = new \Abraham\TwitterOAuth\TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user->getOauthToken(), $user->getOauthTokenSecret());
        echo "Connection obtenida...";
        $connection->post('statuses/update', array('status' => $tweet->getText()));
        echo "Post hecho";
        $tweetDao->deleteTweet($tweet);
    }
}
