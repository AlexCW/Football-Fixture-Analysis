<?php namespace App\Contracts;

interface Request
{
    /**
     * Send a get request
     * @param string $url
     */
    public function sendGetRequest($url);
}