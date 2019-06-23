<?php


namespace MEGAcmdWrapper;


use MEGAcmdWrapper\Flags\FlagsValueObjectInterface;
use MEGAcmdWrapper\Flags\LsFlagsValueObject;
use MEGAcmdWrapper\Flags\PutFlagsValueObject;
use MEGAcmdWrapper\Flags\RmFlagsValueObject;

class MEGAcmdWrapper
{
    /**
     * @var AuthValueObject
     */
    private $authValueObject;

    /**
     * Dependent by platform {@see https://github.com/meganz/MEGAcmd#platforms}
     *
     * @var string
     */
    private $clientPath;

    /**
     * @var array
     */
    private $output;

    /**
     * @var int
     */
    private $returnVar;

    private function __construct(AuthValueObject $authValueObject, $clientPath = 'mega-')
    {
        $this->authValueObject = $authValueObject;
        $this->clientPath = $clientPath;
    }

    /**
     * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#login}
     *
     * @param AuthValueObject $authValueObject
     * @return bool
     */
    public function login(AuthValueObject $authValueObject)
    {
        $this->authValueObject = $authValueObject;

        return $this->exec('login ' . $this->authValueObject->getValue())
            ->isSuccess();
    }

    /**
     * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#logout}
     *
     * @param bool $keepSession
     * @return bool
     */
    public function logout($keepSession)
    {
        $cmd = 'logout';

        if (boolval($keepSession)) {
            $cmd .= ' --keep-session';
        }

        return $this->exec($cmd)->isSuccess();
    }

    /**
     * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#mkdir}
     *
     * @param string $path
     * @param bool $isParents
     * @return bool
     */
    public function mkdir($path, $isParents)
    {
        $cmd = 'mkdir ';

        if (boolval($isParents)) {
            $cmd .= '-p ';
        }

        return $this->exec($cmd . $path)->isSuccess();
    }

    /**
     * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#cd}
     *
     * @param string $path
     * @return bool
     */
    public function cd($path)
    {
        return $this->exec('cd ' . $path)->isSuccess();
    }

    /**
     * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#ls}
     *
     * @param string $path
     * @param LsFlagsValueObject $flags
     * @return array
     */
    public function ls($path, LsFlagsValueObject $flags = null)
    {
        if (isset($flags)) {
            $flags = $flags->getValue();
        }

        $result = $this->exec('ls ' . $flags . ' ' . $path);

        return $result->getOutput();
    }


    /**
     * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#put}
     *
     * @param string $localPath
     * @param string $remotePath
     * @param PutFlagsValueObject|null $flags
     * @return bool
     */
    public function put($localPath, $remotePath = '', PutFlagsValueObject $flags = null)
    {
        $flags = $this->getNullValueObject($flags, PutFlagsValueObject::class);

        return $this->exec(
            'put ' . $flags->getValue() . ' ' .
            $localPath . ' ' . $remotePath
        )->isSuccess();
    }

    /**
     * @param string $path
     * @param RmFlagsValueObject $flags
     * @return bool
     */
    public function rm($path, RmFlagsValueObject $flags)
    {
        $flags = $this->getNullValueObject($flags, RmFlagsValueObject::class);

        return $this->exec('rm ' . $flags->getValue() . ' ' . $path)
            ->isSuccess();
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function getReturnVar()
    {
        return $this->returnVar;
    }

    /**
     * @param FlagsValueObjectInterface|null $flags
     * @param string $class
     * @return FlagsValueObjectInterface
     */
    protected function getNullValueObject($flags, $class)
    {
        if (false === isset($flags)) {
            $flags = new $class;
        }

        return $flags;
    }

    protected function exec($cmd)
    {
        $output = [];
        $returnVar = null;

        exec(
            $this->clientPath . ' ' . $cmd,
            $output,
            $returnVar
        );

        $this->output = $output;
        $this->returnVar = $returnVar;

        $result = new ExecValueObject($output, $returnVar);

        $result->checkSuccess();

        return $result;
    }
}