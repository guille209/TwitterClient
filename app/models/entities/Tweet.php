<?php
namespace models\entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Tweet
 *
 * @ORM\Table(name="tweet")
 * @ORM\Entity
 */
class Tweet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tweet_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tweetId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=152, nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=256, nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
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
