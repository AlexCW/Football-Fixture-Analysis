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

    public function error(string $message, $data = array()): bool
    {
        return $this->monolog->error($message, $data);
    }

    public function info(string $message, $data = array()): bool
    {
        return $this->monolog->info($message, $data);
    }

    public function debug(string $message, $data = array()): bool
    {
        return $this->monolog->debug($message, $data);
    }
}