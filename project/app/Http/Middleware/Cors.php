<?php


namespace App\Http\Middleware;

use Closure;

class Cors
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');

        return $response;
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
        ];
        if ($request->getMethod() == "OPTIONS") {
            //The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return response()->json('OK', 200, $headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }
        return $response;
    }

}
