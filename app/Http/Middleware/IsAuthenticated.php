<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Client;
use Illuminate\Http\Request;

// class IsAuthenticated
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//      * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
//      */
//     public function handle(Request $request, Closure $next)
//     {
//         $api_token  = $request->header('api_token');
//         if($api_token !== null){
//             $client = Client::where('api_token',$api_token)->first();
//             if($client){
//                 return $next($request);
//             } else {
//                 return response()->json([
//                     'msg' =>'Invalid token',
//                 ]);
//             }
//         } else {
//             return response()->json([
//                 'msg' =>'Token not sent',
//             ]);
//         }

//     }
}
