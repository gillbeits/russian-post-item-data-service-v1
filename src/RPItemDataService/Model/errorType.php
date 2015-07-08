<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 12:59
 */

namespace RPItemDataService\Model;

use RPItemDataService\Ornamental\ExtendProperties;
use Symfony\Component\Validator\Constraints as Assert;

class errorType
{
    use ExtendProperties;
    /**
     * @var int
     * @Assert\Type("int")
     */
    protected $ErrorTypeID;
    /**
     * @var string
     * @Assert\Type("string")
     */
    protected $ErrorName;

    /**
     * @param int $ErrorTypeID
     */
    public function setErrorTypeID($ErrorTypeID)
    {
        $this->ErrorTypeID = $ErrorTypeID;
    }

    /**
     * @param string $ErrorName
     */
    public function setErrorName($ErrorName)
    {
        $this->ErrorName = $ErrorName;
    }

    /**
     * @return int
     */
    public function getErrorTypeID()
    {
        return $this->ErrorTypeID;
    }

    /**
     * @return string
     */
    public function getErrorName()
    {
        return $this->ErrorName;
    }
}