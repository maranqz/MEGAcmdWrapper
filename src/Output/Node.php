<?php


namespace MEGAcmdWrapper\Output;


class Node implements NodeInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $flags;

    /**
     * @var string
     */
    private $size;

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * {@inheritDoc}
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritDoc}
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * {@inheritDoc}
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * {@inheritDoc}
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }
}