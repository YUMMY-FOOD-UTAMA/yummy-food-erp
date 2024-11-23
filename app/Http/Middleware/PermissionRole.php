<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class PermissionRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        $guard = Auth::getDefaultDriver();
        $authGuard = app('auth')->guard($guard);
        if ($authGuard->guest()) {
            return redirect()->route('login');
        }

        if (!is_null($permission)) {
            $permissions = is_array($permission)
                ? $permission
                : explode('|', $permission);
        }

        if (is_null($permission)) {
            $permission = $request->route()->getName();

            $permissions = array($permission);
        }

        // Loop through the permissions
        foreach ($permissions as $permission) {
            $temp_permission = ''; // Initialize the variable

            $temp_module = explode('.', $permission);
            $temp_func = end($temp_module);

            array_pop($temp_module);
            if ($temp_func == 'index' || $temp_func == 'show' || $temp_func == 'read' || $temp_func == 'trashed') {
                $temp_permission = $temp_module[0] . '.read';
            } else if ($temp_func == 'store' || $temp_func == 'create') {
                $temp_permission = $temp_module[0] . '.create';
            } else if ($temp_func == 'update' || $temp_func == 'edit') {
                $temp_permission = $temp_module[0] . '.update';
            } else if ($temp_func == 'destroy' || $temp_func == 'delete' || $temp_func == 'force-delete') {
                $temp_permission = $temp_module[0] . '.delete';
            } else if ($temp_func == 'restore') {
                $temp_permission = $temp_module[0] . '.restore';
            } else if ($temp_func == 'copy' || $temp_func == 'generate') {
                $temp_permission = $temp_module[0] . '.copy';
            }

            // Check permission
//            dd($permission, $temp_permission);
            if ($authGuard->user()->can($permission) || $authGuard->user()->can($temp_permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
