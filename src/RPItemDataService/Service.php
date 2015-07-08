<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 14:06
 */

namespace RPItemDataService;


use Doctrine\Common\Annotations\Reader;
use RPItemDataService\Creational\Singleton;
use RPItemDataService\Model\answerByTicketRequestType;
use RPItemDataService\Model\answerByTicketResponseType;
use RPItemDataService\Model\Request;
use RPItemDataService\Model\ticketRequestType;
use RPItemDataService\Model\ticketResponseType;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorBuilderInterface;
use Zend\Soap\Client;

class Service
{
    use Singleton;
    const WSDL          = "http://vfc.russianpost.ru:8080/FederalClient/ItemDataService?wsdl";

    protected $login;
    protected $password;
    /** @var  Client */
    protected $client;
    /** @var  Reader */
    protected $annotationReader;
    /** @var  ValidatorBuilderInterface */
    protected $validatorBuilder;

    /**
     * @param string|null $login
     * @param string|null $password
     * @param array $options
     * @param ValidatorBuilderInterface $validatorBuilderInterface
     */
    protected function create($login = null, $password = null, array $options = [], Reader $annotationReader = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->client = new Client(self::WSDL, array_merge(['soap_version' => SOAP_1_1], $options));
        $this->annotationReader = $annotationReader;
        $this->validatorBuilder = Validation::createValidatorBuilder()->enableAnnotationMapping($this->annotationReader);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return $this
     */
    protected function __setRequest(Request $request)
    {
        if (null !== $this->login && !$request->getLogin()) {
            $request->setLogin($this->login);
        }
        if (null !== $this->password && !$request->getPassword()) {
            $request->setPassword($this->password);
        }
        if (($constraints = $this->validatorBuilder->getValidator()->validate($request)) && $constraints->count()) {
            $error = $constraints->get(0);
            throw new ValidatorException($error->getPropertyPath() . ": " . $error->getMessage());
        }
        return $this;
    }

    /**
     * @param ticketRequestType $ticketRequest
     * @return ticketResponseType
     */
    public function getTicket(ticketRequestType $ticketRequest)
    {
        return new ticketResponseType($this->__setRequest($ticketRequest)->client->getTicket($ticketRequest));
    }

    /**
     * @param answerByTicketRequestType $answerByTicketRequest
     * @return answerByTicketResponseType
     */
    public function getResponseByTicket(answerByTicketRequestType $answerByTicketRequest)
    {
        return new answerByTicketResponseType($this->__setRequest($answerByTicketRequest)->client->getResponseByTicket($answerByTicketRequest), $this->annotationReader);
    }
}