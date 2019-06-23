<?php


namespace MEGAcmdWrapper\Flags;

/**
 * {@see https://github.com/meganz/MEGAcmd/blob/master/UserGuide.md#put}
 */
class PutFlagsValueObject implements FlagsValueObjectInterface
{
    /**
     * -c
     *
     * @var bool
     */
    private $isForceCreate = false;

    /**
     * -q
     *
     * @var bool
     */
    private $isQueueUpload = false;

    /**
     * --ignore-quota-warn
     *
     * @var bool
     */
    private $ignoreQuotaWarn = false;

    /**
     * @param bool $isForceCreate
     * @return $this
     */
    public function setIsForceCreate(bool $isForceCreate)
    {
        $this->isForceCreate = $isForceCreate;
        return $this;
    }

    /**
     * @param bool $isQueueUpload
     * @return $this
     */
    public function setIsQueueUpload(bool $isQueueUpload)
    {
        $this->isQueueUpload = $isQueueUpload;
        return $this;
    }

    /**
     * @param bool $ignoreQuotaWarn
     * @return $this
     */
    public function setIgnoreQuotaWarn(bool $ignoreQuotaWarn)
    {
        $this->ignoreQuotaWarn = $ignoreQuotaWarn;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        $result = [];

        if ($this->isForceCreate) {
            $result[] = '-c';
        }

        if ($this->isQueueUpload) {
            $result[] = '-q';
        }

        if ($this->ignoreQuotaWarn) {
            $result[] = '--ignore-quota-warn';
        }

        return implode(' ', $result);
    }

    public function __toString()
    {
        return $this->getValue();
    }
}