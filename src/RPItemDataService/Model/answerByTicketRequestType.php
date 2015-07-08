<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 14:55
 */

namespace RPItemDataService\Model;

use Symfony\Component\Validator\Constraints as Assert;

class answerByTicketRequestType extends Request
{
    /**
     * @var string
     * @Assert\Type("string")
     */
    protected $ticket;

    /**
     * @param string $ticket
     * @return $this
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }
}