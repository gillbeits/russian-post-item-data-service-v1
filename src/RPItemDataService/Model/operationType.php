<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 13:00
 */

namespace RPItemDataService\Model;


use RPItemDataService\Ornamental\ExtendProperties;
use RPItemDataService\Types;
use Symfony\Component\Validator\Constraints as Assert;

class operationType
{
    use ExtendProperties;
    /**
     * @var int
     * @Assert\Type("int")
     */
    protected $OperTypeID;
    /**
     * @var int
     * @Assert\Type("int")
     */
    protected $OperCtgID;
    /**
     * @var string
     * @Assert\Type("string")
     */
    protected $OperName;
    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\Length(min = 10, max = 19)
     * @Assert\Regex("/([0-3][0-9]\.[0-1][0-9]\.[0-9]{4,4}[ ][0-2]?[0-9][:][0-5][0-9][:][0-5][0-9])|([0-3][0-9]\.[0-1][0-9]\.[0-9]{4,4})/")
     */
    protected $DateOper;
    /**
     * @var int
     * @Assert\Type("int")
     * @Assert\Length(min = 6, max = 6)
     */
    protected $IndexOper;

    /**
     * @param mixed $OperTypeID
     * @return $this
     */
    public function setOperTypeID($OperTypeID)
    {
        $this->OperTypeID = $OperTypeID;
        return $this;
    }

    /**
     * @param int $OperCtgID
     * @return $this
     */
    public function setOperCtgID($OperCtgID)
    {
        $this->OperCtgID = $OperCtgID;
        return $this;
    }

    /**
     * @param string $OperName
     * @return $this
     */
    public function setOperName($OperName)
    {
        $this->OperName = $OperName;
        return $this;
    }

    /**
     * @param \DateTime|string $DateOper
     * @return $this
     */
    public function setDateOper($DateOper)
    {
        $DateOper = $DateOper instanceof \DateTime ? : new \DateTime($DateOper);
        $this->DateOper = $DateOper->format('d.m.Y H:i:s');
        return $this;
    }

    /**
     * @param int $IndexOper
     *
     * @return $this
     */
    public function setIndexOper($IndexOper)
    {
        $this->IndexOper = $IndexOper;
        return $this;
    }

    /**
     * @return int
     */
    public function getOperTypeID()
    {
        return $this->OperTypeID;
    }

    /**
     * @return int
     */
    public function getOperCtgID()
    {
        return $this->OperCtgID;
    }

    /**
     * @return string
     */
    public function getOperName()
    {
        return $this->OperName;
    }

    /**
     * @return string
     */
    public function getDateOper()
    {
        return $this->DateOper;
    }

    /**
     * @return int
     */
    public function getIndexOper()
    {
        return $this->IndexOper;
    }

    public function getDescription()
    {
        return Types::getInstance()->get($this->getOperTypeID(), $this->getOperCtgID());
    }
}