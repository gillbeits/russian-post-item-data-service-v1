<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 14:58
 */

namespace RPItemDataService\Model;


use Symfony\Component\Validator\Constraints\Type;

class answerByTicketResponseType extends Response
{
    /**
     * @var fileType
     * @Type("\RPItemDataService\Model\fileType")
     */
    protected $value;
    /**
     * @var errorType
     * @Type("\RPItemDataService\Model\errorType")
     */
    protected $error;

    /**
     * @return fileType
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return errorType
     */
    public function getError()
    {
        return $this->error;
    }

}