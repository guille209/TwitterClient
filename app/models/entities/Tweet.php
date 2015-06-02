<?php

namespace models\entities;

/**
 * Tweet
 */
class Tweet
{
    /**
     * @var integer
     */
    private $tweetId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $date;


    /**
     * Get tweetId
     *
     * @return integer 
     */
    public function getTweetId()
    {
        return $this->tweetId;
    }

    /**
     * Set userId
     *
     * @param string $userId
     * @return Tweet
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
     * Set text
     *
     * @param string $text
     * @return Tweet
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Tweet
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
