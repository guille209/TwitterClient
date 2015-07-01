<?php

require_once '../config/twitterConfig.php';
require_once '../config/daoConfig.php';
require_once '../config/bootstrap.php';
require_once '../vendor/autoload.php';
require_once '../vendor/abraham/twitteroauth/src/TwitterOAuth.php';


$tweet = $tweet = new \models\entities\Tweet();
$factory = $factory = \models\daos\FactoryDao::getFactory();

$tweetDao = $factory->getTweetDao();
$userDao = $factory->getUserDao();


echo "Running daemon v1.1...";
while (true) {
    sleep(1);
    $tweets = $tweetDao->getTweetsToPublish();

    foreach ($tweets as $tweet) {
        $user = new \models\entities\User();

        $user = $userDao->getUserByTweet($tweet);
        $connection = new \Abraham\TwitterOAuth\TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user->getOauthToken(), $user->getOauthTokenSecret());
        $user = $connection->get("account/verify_credentials");
        $_SESSION['userLogged'] = true;
        $connection->post('statuses/update', array('status' => $tweet->getText()));
        $tweetDao->delete($tweet);
    }
}
