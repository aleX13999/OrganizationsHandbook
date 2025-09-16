<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY') ?? $request->query('api_key');

        // Статический ключ, можно вынести в .env
        $validApiKey = env('API_KEY');

        if (!$apiKey || $apiKey !== $validApiKey) {
            return response()->json(['error' => 'Unauthorized: invalid API key'], 401);
        }

        return $next($request);
    }
}
