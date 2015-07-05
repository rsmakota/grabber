<?php
/**
 * Created by PhpStorm.
 * User: rodion
 * Date: 05.07.15
 * Time: 20:31
 */

namespace Grabber\Bundle\GrabBundle\Monolog\Handler;


use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;

class ContextBasedStreamHandler extends AbstractProcessingHandler
{
    protected $handlers;

    protected $filename;

    protected $maxFiles;

    protected $level;

    protected $bubble;

    /**
     * @param int      $filename
     * @param bool|int $level
     * @param bool     $bubble
     */
    public function __construct($filename, $level = Logger::DEBUG, $bubble = true)
    {
        $this->filename = $filename;
        $this->level    = $level;
        $this->bubble   = $bubble;
    }

    /**
     * @param string $filename
     *
     * @return RotatingFileHandler
     */
    protected function createHandler($filename)
    {
        return new StreamHandler($filename, $this->level, $this->bubble);
    }

    /**
     * @param array $record
     *
     * @return AbstractProcessingHandler
     */
    protected function getHandler(array $record)
    {
        $filename = $this->formatFilename($record);

        if (!isset($this->handlers[$filename])) {
            $this->handlers[$filename] = $this->createHandler($filename);
        }

        return $this->handlers[$filename];
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        $this->getHandler($record)->write($record);
    }

    protected function formatFilename(array $record)
    {
        return sprintf($this->filename, date('Y-m-d'));
    }
}