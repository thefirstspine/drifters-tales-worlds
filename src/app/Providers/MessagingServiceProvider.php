<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class MessagingServiceProvider extends ServiceProvider
{

    private Client $client;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->client = new Client([
            'base_uri' => env('MESSAGING_URL'),
        ]);
    }

    public function sendMessage(array $to, string $subject, array $message)
    {
        try
        {
            \Log::debug("Send message to messaging service", [
                'to' => $to,
                'subject' => $subject,
                'message' => $message,
            ]);

            $response = $this->client->post(
                '/api',
                [
                    'body' => json_encode([
                        'to' => $to,
                        'subject' => $subject,
                        'message' => $message,
                    ]),
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-Client-Cert' => base64_encode(env('MESSAGING_PUBLIC_KEY')),
                        'X-Client-Cert-Encoding' => 'base64',
                    ]
                ]
            );

            \Log::debug("Response from messaging service",  [$response->getBody()->getContents()]);
            return $response->getBody()->getContents();
        }
        catch (\Exception $e)
        {
            \Log::error("Error from messaging service",  [$e]);
            return null;
        }
    }

}
