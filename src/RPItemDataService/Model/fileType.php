<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 12:57
 */

namespace RPItemDataService\Model;

use RPItemDataService\Ornamental\ExtendProperties;
use Symfony\Component\Validator\Constraints as Assert;

class fileType
{
    use ExtendProperties;
    /**
     * @var itemType
     * @Assert\Type("\RPItemDataService\Model\itemType")
     * @Assert\Valid
     */
    protected $Item;
    /**
     * @var int
     * @Assert\Type("int")
     */
    protected $FileTypeID;
    /**
     * @var int
     * @Assert\Type("int")
     */
    protected $FileNumber;
    /**
     * @var int
     * @Assert\Type("int")
     */
    protected $SenderID;
    /**
     * @var int
     * @Assert\Type("int")
     */
    protected $RecipientID;
    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\Length(min = 10, max = 19)
     * @Assert\Regex("/([0-3][0-9]\.[0-1][0-9]\.[0-9]{4,4}[ ][0-2]?[0-9][:][0-5][0-9][:][0-5][0-9])|([0-3][0-9]\.[0-1][0-9]\.[0-9]{4,4})/")
     */
    protected $DatePreparation;

    /**
     * @param itemType $Item
     * @return $this
     */
    public function setItem($Item)
    {
        $this->Item = $Item;
        return $this;
    }

    /**
     * @param int $FileTypeID
     * @return $this
     */
    public function setFileTypeID($FileTypeID)
    {
        $this->FileTypeID = $FileTypeID;
        return $this;
    }

    /**
     * @param int $FileNumber
     * @return $this
     */
    public function setFileNumber($FileNumber)
    {
        $this->FileNumber = $FileNumber;
        return $this;
    }

    /**
     * @param int $SenderID
     * @return $this
     */
    public function setSenderID($SenderID)
    {
        $this->SenderID = $SenderID;
        return $this;
    }

    /**
     * @param int $RecipientID
     * @return $this
     */
    public function setRecipientID($RecipientID)
    {
        $this->RecipientID = $RecipientID;
        return $this;
    }

    /**
     * @param \DateTime|string $DatePreparation
     * @return $this
     */
    public function setDatePreparation($DatePreparation)
    {
        $DatePreparation = $DatePreparation instanceof \DateTime ? : new \DateTime($DatePreparation);
        $this->DatePreparation = $DatePreparation->format("d.m.Y H:i:s");
        return $this;
    }

    /**
     * @return itemType
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * @return int
     */
    public function getFileTypeID()
    {
        return $this->FileTypeID;
    }

    /**
     * @return int
     */
    public function getFileNumber()
    {
        return $this->FileNumber;
    }

    /**
     * @return int
     */
    public function getSenderID()
    {
        return $this->SenderID;
    }

    /**
     * @return int
     */
    public function getRecipientID()
    {
        return $this->RecipientID;
    }

    /**
     * @return string
     */
    public function getDatePreparation()
    {
        return $this->DatePreparation;
    }
}