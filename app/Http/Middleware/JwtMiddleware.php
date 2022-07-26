<?php

namespace App\Http\Middleware;

use Closure;

use JWTAuth;

use Exception;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware

{


    public function handle($request, Closure $next)

    {
        
       
        try {
          
            $user = JWTAuth::parseToken()->authenticate();
           
            if (!$user) throw new Exception('User Not Found');
        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                return response()->json(
                    [
                        'data' => null,
                           'status' => 'errors',
                            'message' => 'Token Invalid',
                    ]

                );
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return response()->json(
                    [
                        'data' => null,
                           'status' => 'errors',
                            'message' => 'Token Expired',
                    ]

                );
            } else {

                if ($e->getMessage() === 'User Not Found') {

                    return response()->json(
                        [
                            'data' => null,
                               'status' => 'errors',
                                'message' => 'User not found',
                        ]

                    );
                }

                return response()->json(
                    [
                        'data' => null,
                           'status' => 'errors',
                            'message' => 'Authorization token not found',
                    ]

                );
            }
        }

        return $next($request);
    }
}
