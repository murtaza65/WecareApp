<?php
namespace App\Http\Middleware;

use App\Models\Community;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultCommunityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $default_community = Community::where('created_by', auth()->id())->where('name', Community::DEFAULT_COMMUNITY)->first();
        if (! $default_community) {
            Community::createDefaultCommunity();
        }
        return $next($request);
    }
}
