<?php


namespace MEGAcmdWrapper\Output;


class NodeFactory
{
    /**
     * @var NodeInterface
     */
    private $directoryClass;

    /**
     * @var NodeInterface
     */
    private $fileClass;

    /**
     * @var NodeInterface
     */
    private $nodeClass;

    public function __construct(
        $directoryClass = Directory::class,
        $fileClass = File::class,
        $nodeClass = Node::class
    ) {
        if (empty($nodeClass) ||
            !$directoryClass instanceof $nodeClass ||
            !$fileClass instanceof $nodeClass) {
            throw new \InvalidArgumentException('$directoryClass and $fileClass should be child of $nodeClass');
        }

        $this->directoryClass = $directoryClass;
        $this->fileClass = $fileClass;
        $this->nodeClass = $nodeClass;
    }

    public function initFromLine($line, $short = true)
    {
        if ($short) {
            /** @var NodeInterface $node */
            $node = new $this->nodeClass;
            $node->setName($line);
        } else {
            list($flags, $version, $size, $date, $name) = explode("\t", $line);

            if ('d' === $flags[0]) {
                $node = new Directory();
            } else {
                $node = new File();
            }
        }

        return $node;
    }
}