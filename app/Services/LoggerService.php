<?php namespace App\Services;

use Psr\Log\LoggerInterface;
use App\Contracts\Logger;

class LoggerService implements Logger
{
    /**
     * @var Psr\Log\LoggerInterface
     */
    protected $monolog;

    public function __construct(LoggerInterface $monolog)
    {
        $this->monolog = $monolog;
    }

    public function error($message, $data = array ())
    {
        $this->monolog->error($message, $data);
    }

    public function info($message, $data = array())
    {
        $this->monolog->info($message, $data);
    }

    public function debug($message, $data = array())
    {
        $this->monolog->debug($message, $data);
    }
}