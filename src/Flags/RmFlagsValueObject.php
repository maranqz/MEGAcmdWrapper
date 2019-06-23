<?php


namespace MEGAcmdWrapper\Flags;

/**
 * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#rm}
 */
class RmFlagsValueObject implements FlagsValueObjectInterface
{
    /**
     * -r
     *
     * @var bool
     */
    private $isRecursive = false;

    /**
     * -f
     *
     * @var bool
     */
    private $isForce = false;

    /**
     * @param bool $isRecursive
     * @return $this
     */
    public function setIsRecursive(bool $isRecursive)
    {
        $this->isRecursive = $isRecursive;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        $result = [];

        if ($this->isRecursive) {
            $result[] = '-r';
        }

        if ($this->isForce) {
            $result[] = '-f';
        }

        return implode(' ', $result);
    }

    public function __toString()
    {
        return $this->getValue();
    }
}