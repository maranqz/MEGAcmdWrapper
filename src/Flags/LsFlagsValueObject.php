<?php


namespace MEGAcmdWrapper\Flags;

/**
 * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#ls}
 */
class LsFlagsValueObject implements FlagsValueObjectInterface
{
    /**
     * -R|-r
     *
     * @var bool
     */
    private $isRecursive = false;

    /**
     * -l
     *
     * @var bool
     */
    private $isPrintSummary = false;

    /**
     * -h
     *
     * @var bool
     */
    private $isReadableSize = false;

    /**
     * -a
     *
     * @var bool
     */
    private $isExtraInformation = false;

    /**
     * --versions
     *
     * @var bool
     */
    private $hasVersion = false;

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
     * @param bool $isPrintSummary
     * @return $this
     */
    public function setIsPrintSummary(bool $isPrintSummary)
    {
        $this->isPrintSummary = $isPrintSummary;
        return $this;
    }

    /**
     * @param bool $isReadableSize
     * @return $this
     */
    public function setIsReadableSize(bool $isReadableSize)
    {
        $this->isReadableSize = $isReadableSize;
        return $this;
    }

    /**
     * @param bool $isExtraInformation
     * @return $this
     */
    public function setIsExtraInformation(bool $isExtraInformation)
    {
        $this->isExtraInformation = $isExtraInformation;
        return $this;
    }

    /**
     * @param bool $hasVersion
     * @return $this
     */
    public function setHasVersion(bool $hasVersion)
    {
        $this->hasVersion = $hasVersion;
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

        if ($this->isPrintSummary) {
            $result[] = '-l';
        }

        if ($this->isReadableSize) {
            $result[] = '-h';
        }

        if ($this->isExtraInformation) {
            $result[] = '-a';
        }

        if ($this->hasVersion) {
            $result[] = '--versions';
        }

        return implode(' ', $result);
    }

    public function __toString()
    {
        return $this->getValue();
    }
}