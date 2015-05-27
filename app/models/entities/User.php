<?php

namespace models\entities;


/**
 * User
 */
class User
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $oauthToken;

    /**
     * @var string
     */
    private $oauthTokenSecret;


    /**
     * Get userId
     *
     * @return string 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set oauthToken
     *
     * @param string $oauthToken
     * @return User
     */
    public function setOauthToken($oauthToken)
    {
        $this->oauthToken = $oauthToken;

        return $this;
    }

    /**
     * Get oauthToken
     *
     * @return string 
     */
    public function getOauthToken()
    {
        return $this->oauthToken;
    }

    /**
     * Set oauthTokenSecret
     *
     * @param string $oauthTokenSecret
     * @return User
     */
    public function setOauthTokenSecret($oauthTokenSecret)
    {
        $this->oauthTokenSecret = $oauthTokenSecret;

        return $this;
    }

    /**
     * Get oauthTokenSecret
     *
     * @return string 
     */
    public function getOauthTokenSecret()
    {
        return $this->oauthTokenSecret;
    }
}
