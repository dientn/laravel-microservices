<?php

namespace App\Http\Middleware;

use App\Http\Request;
use Closure;
use Symfony\Component\HttpFoundation\Response;

class AddCORSHeader
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        dd($request->getMethod());
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];

        if ($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }
        /**
         * @var Response $response
         */
        $response = $next($request);
//        $response->headers->set('Access-Control-Allow-Origin', '*');
        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }

        return $response;
    }
}
