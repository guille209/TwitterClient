<?php

namespace models\entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Hashtaglist
 */
class Hashtaglist
{
    /**
     * @var integer
     */
    private $hashtaglistId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $hashtag;


    /**
     * Get hashtaglistId
     *
     * @return integer 
     */
    public function getHashtaglistId()
    {
        return $this->hashtaglistId;
    }

    /**
     * Set userId
     *
     * @param string $userId
     * @return Hashtaglist
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

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
     * Set hashtag
     *
     * @param string $hashtag
     * @return Hashtaglist
     */
    public function setHashtag($hashtag)
    {
        $this->hashtag = $hashtag;

        return $this;
    }

    /**
     * Get hashtag
     *
     * @return string 
     */
    public function getHashtag()
    {
        return $this->hashtag;
    }
}
