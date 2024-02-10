<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTaskOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route('task')->user_id !== $request->user()->id) {
            return response()->json(['You not are the owner this task'], 403);
        }

        return $next($request);
    }
}
