<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 11:44
 */

namespace RPItemDataService\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ticketRequestType extends Request
{
    /**
     * @var fileType
     * @Assert\Type("\RPItemDataService\Model\fileType")
     * @Assert\Valid
     */
    protected $request;

    /**
     * @return fileType
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param fileType $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
}