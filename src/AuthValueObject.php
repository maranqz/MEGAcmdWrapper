<?php


namespace MEGAcmdWrapper;


class AuthValueObject
{
    const TYPE_DEFAULT = 0;
    const TYPE_SESSION = 1;
    const TYPE_FOLDER = 2;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $authCode;

    /**
     * @var string
     */
    private $session;

    /**
     * @var string
     */
    private $url;

    private function __construct($type)
    {
        $this->type = $type;
    }

    public function init($email, $password, $authCode = null)
    {
        $object = new static(self::TYPE_SESSION);

        $object->email = $email;
        $object->password = $password;
        $object->authCode = $authCode;
    }

    public function initBySession($session)
    {
        $object = new static(self::TYPE_DEFAULT);

        $object->session = $session;
    }

    public function initByFolder($url)
    {
        $object = new static(self::TYPE_FOLDER);

        $object->url = $url;
    }

    protected function getEmail()
    {
        return $this->email;
    }

    protected function getPassword()
    {
        return $this->password;
    }

    protected function getAuthCode()
    {
        return $this->authCode;
    }

    protected function hasAuthCode()
    {
        return empty($this->getAuthCode());
    }

    protected function getSession()
    {
        return $this->session;
    }

    protected function getUrl()
    {
        return $this->url;
    }


    public function getValue()
    {
        $result = false;

        switch ($this->type) {
            case static::TYPE_DEFAULT:
                $result = "{$this->getEmail()} {$this->getPassword()}";

                if ($this->hasAuthCode()) {
                    $result .= "--auth-code={$this->getAuthCode()}";
                }
                break;

            case static::TYPE_SESSION:
                $result = $this->getSession();
                break;
            case static::TYPE_FOLDER:
                $result = $this->getUrl();
                break;
        }

        return $result;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}