<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 13:45
 */

namespace RPItemDataService\Model;

use RPItemDataService\Ornamental\ExtendProperties;
use Symfony\Component\Validator\Constraints as Assert;

class Request
{
    use ExtendProperties;
    /**
     * @var string
     * @Assert\Type("string")
     */
    protected $login;
    /**
     * @var string
     * @Assert\Type("string")
     */
    protected $password;
    /**
     * @var string
     * @Assert\Type("string")
     */
    protected $language = 'RUS';

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

}