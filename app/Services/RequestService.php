<?php namespace App\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

use App\Contracts\Request;

class RequestService implements Request
{
    /**
     * @var GuzzleHttp\ClientInterface
     */
    protected $monolog;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function sendGetRequest($endpoint, $conditions = array(), $headers = array())
    {
        try 
        {
            $response = $this->client->get($endpoint, [
                'headers' => [
                    'Content-Type' => 'text/csv'
                ]
            ]);

            return $response->getBody()->getContents();
        } catch(GuzzleException $e) {
            return false;
        }
    }
}