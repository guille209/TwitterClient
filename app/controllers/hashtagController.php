<?php
namespace controllers;

require_once '../config/twitterConfig.php';
require_once '../config/bootstrap.php';
require_once '../vendor/autoload.php';
require_once '../vendor/abraham/twitteroauth/src/TwitterOAuth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hashtagController
 *
 * @author Propietario
 */
class hashtagController implements interfaces\iHashtagController {

    function createHashtaglist($hashtag) {

        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $user = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
        $doctrineFactory = \models\daos\FactoryDao::getFactory(\models\daos\FactoryDao::DOCTRINE_FACTORY);
        $user->setOauthToken($_SESSION['access_token']['oauth_token']);
        $user->setOauthTokenSecret($_SESSION['access_token']['oauth_token_secret']);
        $userDao = $doctrineFactory->getUserDao();
        $userDao->getUser($user);
        $userDao->saveUser($user);
        $hashtaglist->setUserId($user->getUserId());
        //$hashtaglist->setUserId(10);
        $hashtaglist->setHashtag($hashtag);
        //echo "El hashtag->" . $hashtag;

        $hashtaglistDao = $doctrineFactory->getHashtaglistDao();
        $hashtaglistDao->saveHashtaglist($hashtaglist);
        sleep(1);
    }

    function deleteHashtaglist($hashtagId) {
        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $doctrineFactory = \models\daos\FactoryDao::getFactory(\models\daos\FactoryDao::DOCTRINE_FACTORY);
        $hashtaglistDao = $doctrineFactory->getHashtaglistDao();

        while (true) {
            sleep(1);
            $hashtaglists = $hashtaglistDao->get_hashtaglist($hashtagId);
            
            foreach ($hashtaglists as $hashtaglist) {
                $user = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
                $userDao = $doctrineFactory->getUserDao();
                $user = $userDao->getUserByHash($hashtaglist);
                $connection = new \Abraham\TwitterOAuth\TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user->getOauthToken(), $user->getOauthTokenSecret());
                $user = $connection->get("account/verify_credentials");
                $_SESSION['userLogged'] = true;
               // $connection->post('statuses/update', array('status' => $hashtaglist->getHashtag()));
                $hashtaglistDao->deleteHashtaglist($hashtaglist);
                sleep(1);
            }
             //$hashtaglistDao->deleteHashtaglist($hashtaglist);
            
        }
    }

    function showHashtaglistDetails() {
        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $doctrineFactory = \models\daos\FactoryDao::getFactory(\models\daos\FactoryDao::DOCTRINE_FACTORY);
        $hashtaglistDao = $doctrineFactory->getHashtaglistDao();

            $hashtaglists = $hashtaglistDao->getLists();
            $count = count($hashtaglists);
            for($i=0;$i<$count;$i++){
                //echo "count->".count($hashtaglists); 
                echo "Hashtaglist id: ";
                echo $hashtaglists[$i]->getHashtaglistId();
                echo " ";
                echo "User id ";
                echo $hashtaglists[$i]->getUserId();
                echo " ";
                echo "Hashtag name ";
                echo $hashtaglists[$i]->getHashtag();
                echo "\n";
        }
    }

    function showHashtaglists() {
        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $doctrineFactory = \models\daos\FactoryDao::getFactory(\models\daos\FactoryDao::DOCTRINE_FACTORY);       
        $hashtaglistDao = $doctrineFactory->getHashtaglistDao();

            $hashtaglists = $hashtaglistDao->getLists();
            $count = count($hashtaglists);
            for($i=0;$i<$count;$i++){
                echo "Hashtag name: ";
                echo $hashtaglists[$i]->getHashtag();
                echo "\n";
        }
    }
    
   /* 
    function createSavedQuery($hashtag) {
        $raw_response = $_SESSION["connection"]->post("saved_searches/create", array("query" => $hashtag));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        echo $json_string;
    }

    function get_saved() {
        $raw_response = $_SESSION["connection"]->get("saved_searches/list");
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        echo $json_string;
    }*/

}
