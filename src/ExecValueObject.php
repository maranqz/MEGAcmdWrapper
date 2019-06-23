<?php


namespace MEGAcmdWrapper;


class ExecValueObject
{
    const SUCCESS_EXIT = 0;

    /**
     * @var array
     */
    private $output;
    /**
     * @var int
     */
    private $returnVar;

    public function __construct($output, $returnVar)
    {
        $this->output = $output;
        $this->returnVar = $returnVar;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function getReturnVar()
    {
        return $this->returnVar;
    }

    public function checkSuccess()
    {
        if (!$this->isSuccess()) {
            throw new MegaException(implode("\n", $this->getOutput()));
        }

        return true;
    }


    public function isSuccess()
    {
        return self::SUCCESS_EXIT === $this->getReturnVar();
    }
}