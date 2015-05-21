<?php
namespace models\entities;



use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=128)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="oauth_token", type="string", length=256, nullable=false)
     */
    private $oauthToken;

    /**
     * @var string
     *
     * @ORM\Column(name="oauth_token_secret", type="string", length=256, nullable=false)
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
