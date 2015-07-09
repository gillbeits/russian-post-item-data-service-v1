<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 14:57
 */

namespace RPItemDataService\Model;


class ticketResponseType extends Response
{
    /**
     * @var string
     */
    protected $value;
    /**
     * @var errorType
     */
    protected $error;

    /**
     * @return string
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