<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if(!canDo(['register'])) 
        {

            return response()->json(['message' => 'You are not allowed to register'], 403);
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // password_confirmation
        ]);

        $group = Group::where('name', 'User')->first();

        if(!$group) 
        {

            return response()->json(['message' => 'Default group not found'], 404);
        }

        $groupId = $group->id;

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'group_id' => $groupId,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if(!canDo(['login'])) 
        {

            return response()->json(['message' => 'You are not allowed to login'], 403);
        }

        $validated = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) 
        {

            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        if(!canDo(['logout'])) 
        {

            return response()->json(['message' => 'You are not allowed to logout'], 403);
        }

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function index(Request $request)
    {
        if(!canDo(['users_list'])) 
        {

            return response()->json(['message' => 'You are not allowed to list users'], 403);
        }

        return response()->json([
            'message' => 'List of users'
        ]);
    }

    public function profile(Request $request)
    {
        if(!canDo(['profile'])) 
        {

            return response()->json(['message' => 'You are not allowed to view profile'], 403);
        }

        return response()->json($request->user());
    }

    public function permissions(Request $request)
    {
        if(!canDo(['permissions'])) 
        {

            return response()->json(['message' => 'You are not allowed to view permissions'], 403);
        }

        $user = Auth::guard('sanctum')->user();
        
        if (!$user) {
            return response()->json(['home', 'register', 'login', 'permissions']);
        }
        
        return response()->json($user->group->permissions);
    }
}
