<?php

/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 15:18
 */
class ServiceTest extends PHPUnit_Framework_TestCase
{
    protected static $annotationReader;

    public static function setUpBeforeClass()
    {
        static::$annotationReader = new \Doctrine\Common\Annotations\CachedReader(new \Doctrine\Common\Annotations\AnnotationReader(), new \Doctrine\Common\Cache\ArrayCache());
    }

    public function testGetTicket()
    {
        $ticketRequest = new \RPItemDataService\Model\ticketRequestType([
            'request' => new \RPItemDataService\Model\fileType([
                'FileTypeID' => 1,
                'Item' => new \RPItemDataService\Model\itemType([
                    'Barcode' => '11111111111111'
                ])
            ])
        ]);
        $response = \RPItemDataService\Service::getInstance('login', 'password',[], static::$annotationReader)->getTicket($ticketRequest);
    }

    public function testGetResponseByTicket()
    {
        $answerByTicketRequest = new \RPItemDataService\Model\answerByTicketRequestType([
            'ticket' => '20150708144222564LOGIN'
        ]);
        $response = \RPItemDataService\Service::getInstance('login', 'password', [], static::$annotationReader)->getResponseByTicket($answerByTicketRequest);
    }
}
