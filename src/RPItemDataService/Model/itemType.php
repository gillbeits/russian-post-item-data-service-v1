<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 12:58
 */

namespace RPItemDataService\Model;

use RPItemDataService\Ornamental\ExtendProperties;
use Symfony\Component\Validator\Constraints as Assert;

class itemType
{
    use ExtendProperties;
    /**
     * @var operationType[]
     * @Assert\Type("array")
     */
    protected $Operation;
    /**
     * @var errorType
     * @Assert\Type("\RPItemDataService\Model\errorType")
     * @Assert\Valid
     */
    protected $Error;
    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(min = 13, max = 14)
     * @Assert\Regex("/([0-9]{14,14})|([a-z,A-Z]{2,2}[0-9]{9,9}[a-z,A-Z]{2,2})/")
     */
    protected $Barcode;

    /**
     * @param operationType[] $Operation
     * @return $this
     */
    public function setOperation($Operation)
    {
        if (is_object($Operation)) $Operation = [$Operation];
        foreach ($Operation as &$op) {
            $op = new operationType($op, $this->annotationReader);
        }
        $this->Operation = $Operation;
        return $this;
    }

    /**
     * @param mixed $Error
     * @return $this
     */
    public function setError($Error)
    {
        $this->Error = $Error;
        return $this;
    }

    /**
     * @param string $Barcode
     * @return $this
     */
    public function setBarcode($Barcode)
    {
        $this->Barcode = $Barcode;
        return $this;
    }

    /**
     * @return operationType[]
     */
    public function getOperation()
    {
        return $this->Operation;
    }

    /**
     * @return errorType
     */
    public function getError()
    {
        return $this->Error;
    }

    /**
     * @return string
     */
    public function getBarcode()
    {
        return $this->Barcode;
    }
}