<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Resources\AuthAdminResource;
use Illuminate\Http\Request;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getAdminPermissions(Request $request)
    {
        $admin = auth()->guard('admin')->user()->load('permissions');

        return response()->json([
            'admin' => AuthAdminResource::make($admin),
            'permissions' => $admin->getPermissionNames()
        ]);
    }
    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:admins', 'password' => 'required']);

        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials, true)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $request->session()->regenerate();
        $admin = auth()->guard('admin')->user();

        return response()->json([
            'message' => 'Login successful',
            'admin' => $admin,
            'permissions' => $admin->getAllPermissions()->pluck('name'),
        ], 200);
    }


    public function logout(Request $request)
    {

        auth('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
