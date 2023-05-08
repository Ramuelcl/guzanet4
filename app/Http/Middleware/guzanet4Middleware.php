<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class guzanet4Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $needles): Response
    {
        $needles = explode('|', $needles);
        // $needles[] =  'client';
        // dump($needles);
        $haystack = Role::all()->pluck('name')->toArray();
        // $haystack = array_keys($roles->toArray());
        $accesoRol = false;
        foreach ($needles as $needle) {
            $accesoRol = in_array($needle, $haystack) ? true : $accesoRol;
        }
        // dump(['haystack' => $haystack, 'needles' => $needles, 'accesoRol' => $accesoRol]);
        if ($accesoRol)
            return $next($request);

        $accesoPer = fncHasPermissions($needles);

        if ($accesoPer) {
            return $next($request);
        }
        abort(403, 'Usted no tiene permisos para ver esta página');
    }
}
