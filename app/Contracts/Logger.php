<?php namespace App\Contracts;

interface Logger
{
    /**
     * Sends a error message to the logger
     * @param String $message
     * @param array $data
     */
    public function error(string $message, $data = array()): bool;

    /**
     * Sends a info message to the logger
     * @param string $message
     * @param array $data
     *
     * @return mixed
     */
    public function info(string $message, $data = array()): bool;

    /**
     * Sends a debug error to the logger
     * @param string $message
     * @param array $data
     *
     * @return mixed
     */
    public function debug(string $message, $data = array()): bool;
}