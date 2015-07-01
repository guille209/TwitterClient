<?php

namespace controllers;

require_once '../config/twitterConfig.php';
require_once '../config/bootstrap.php';
require_once '../vendor/autoload.php';
require_once '../vendor/abraham/twitteroauth/src/TwitterOAuth.php';

class hashtagController implements interfaces\iHashtagController {

    function createHashtaglist($hashtag) {

        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $user = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
        $userDb = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
        $factory = \models\daos\FactoryDao::getFactory();
        $user->setOauthToken($_SESSION['access_token']['oauth_token']);
        $user->setOauthTokenSecret($_SESSION['access_token']['oauth_token_secret']);
        $userDao = $factory->getUserDao();
        $userDao->getUser($user);
        $userDao->create($user);

        $userDb = $userDao->getUser($user);
        if (isset($userDb[0])) {
            $hashtaglist->setUserId($userDb[0]->getUserId());
        } else {
            $userDao->create($user);
            $hashtaglist->setUserId($user->getUserId());
        }
        $hashtaglist->setHashtag($hashtag);

        $hashtaglistDao = $factory->getHashtaglistDao();
        $hashtaglistDao->create($hashtaglist);
        sleep(1);
    }

    function deleteHashtaglist($hashtagId) {
        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $factory = \models\daos\FactoryDao::getFactory();
        $hashtaglistDao = $factory->getHashtaglistDao();

        while (true) {
            sleep(1);
            $hashtaglists = $hashtaglistDao->read($hashtagId);

            foreach ($hashtaglists as $hashtaglist) {
                $user = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
                $userDao = $factory->getUserDao();
                $user = $userDao->getUserByHash($hashtaglist);
                $connection = new \Abraham\TwitterOAuth\TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user->getOauthToken(), $user->getOauthTokenSecret());
                $user = $connection->get("account/verify_credentials");
                $_SESSION['userLogged'] = true;
                $hashtaglistDao->delete($hashtaglist);
                sleep(1);
            }
        }
    }

    public $numero_de_tweets = 50;

    function showHashtaglistDetails($hashtag) {
        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $raw_response = $_SESSION["connection"]->get("search/tweets", array("q" => $hashtag, "count" => $this->numero_de_tweets));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenSearchTweet($json_string);
    }

    function showHashtaglists() {
        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $factory = \models\daos\FactoryDao::getFactory();
        $hashtaglistDao = $factory->getHashtaglistDao();
        $hashtaglists = $hashtaglistDao->getLists();
        $newArray = array();
        $count = count($hashtaglists);
        for ($i = 0; $i < $count; $i++) {
            $newArray[$i] = $hashtaglists[$i]->getHashtag();
        }

        $json_string = json_encode($newArray, JSON_UNESCAPED_SLASHES);
        return $json_string;
    }

}
