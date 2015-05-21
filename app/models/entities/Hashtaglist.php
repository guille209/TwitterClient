<?php
namespace models\entities;



use Doctrine\ORM\Mapping as ORM;

/**
 * Hashtaglist
 *
 * @ORM\Table(name="hashtaglist")
 * @ORM\Entity
 */
class Hashtaglist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="hashtaglist_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $hashtaglistId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=128, nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="hashtag", type="string", length=256, nullable=false)
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
