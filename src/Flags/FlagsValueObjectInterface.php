<?php


namespace MEGAcmdWrapper\Flags;

interface FlagsValueObjectInterface
{
    /**
     * @return string
     */
    public function getValue();

    /**
     * @return string
     */
    public function __toString();
}