<?php namespace App\Contracts;

interface Request
{
    /**
     * Send a get request
     * @param string $url
     * @throws Exception
     * @return string
     */
    public function sendGetRequest($url): string;
}