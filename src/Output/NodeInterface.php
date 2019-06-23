<?php


namespace MEGAcmdWrapper\Output;


interface NodeInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return \DateTimeImmutable
     */
    public function getDate();

    /**
     * @param \DateTimeImmutable $date
     * @return $this
     */
    public function setDate($date);

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion($version);

    /**
     * @return string
     */
    public function getFlags();

    /**
     * @param string $flags
     * @return $this
     */
    public function setFlags($flags);

    /**
     * @return string
     */
    public function getSize();

    /**
     * @param string $size
     * @return $this
     */
    public function setSize($size);
}