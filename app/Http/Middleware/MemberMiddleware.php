<?php

namespace App\Http\Middleware;

use App\Models\CompanyUser;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

     if (!auth()->check()) {
            return redirect()->route('login');
        }

        $companyUser = CompanyUser::with('role')
            ->where('user_id', auth()->id())
            ->first();

        if (!$companyUser || $companyUser->role?->name !== Role::MEMBER) {
            abort(403, 'Unauthorized access.');
        }
        
        return $next($request);
    }
}
