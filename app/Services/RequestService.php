<?php namespace App\Services;

use Exception;
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

    public function sendGetRequest($endpoint, $conditions = array(), $headers = array()): string
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
            throw new Exception('There was en error retrieving the request.');
        }
    }
}