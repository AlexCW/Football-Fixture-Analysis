<?php namespace App\Contracts;

interface Logger
{
    /**
     * sends a error message to the logger
     * @param       $message
     * @param array $data
     */
    public function error($message, $data = array ());

    /**
     * sends a info message to the logger
     * @param       $message
     * @param array $data
     *
     * @return mixed
     */
    public function info($message, $data = array());

    /**
     * sends a debug error to the logger
     * @param       $message
     * @param array $data
     *
     * @return mixed
     */
    public function debug($message, $data = array());
}