<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try
        {
            $token = $request->bearerToken();
            if (empty($token))
            {
                throw new \Exception();
            }

            $client = new Client([
                'base_uri' => env('AUTH_URL'),
            ]);
            $response = $client->get(
                '/api/v2/me',
                [
                    'headers' => [
                        'Authorization' => "Bearer {$token}"
                    ]
                ]
            );

            $content = $response->getBody()->getContents();
            $contentJson = json_decode($content, true);
            if (empty($contentJson['user_id']))
            {
                throw new \Exception();
            }

            $request->attributes->set('user_id', $contentJson['user_id']);
            return $next($request);
        }
        catch (\Exception $e)
        {
            throw new HttpResponseException(response()->json(['error' => 'invalid bearer token'], 400));
        }
        catch (GuzzleException $e)
        {
            throw new HttpResponseException(response()->json(['error' => 'invalid bearer token'], 400));
        }
    }
}
