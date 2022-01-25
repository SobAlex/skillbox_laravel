<?php

namespace App\Services;

class Pushall
{
    private $id;
    private $apiKey;

    protected $url = 'https://pushall.ru/api.php';

    public function __construct($apiKey, $id)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    public function send($email, $message)
    {
        $data = [
            'type' => 'self',
            'id' => $this->id,
            'key' => $this->apiKey,
            'text' => $message,
            'title' => $email
        ];

        $client = new \GuzzleHttp\Client(['base_uri' => $this->url]);

        return $client->post('', ['form_params' => $data]);
    }
}
