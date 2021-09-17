<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Api\UserResource;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()->with('roles')->get();
        return response()->json(['code' => 200, 'data' => UserResource::collection($users)]);
    }

    public function assignRole(Request $request)
    {
        $user = User::query()->findOrFail($request->userid);

        $roles = Role::query()->whereIn('id', $request->roles)->get();
        $user->syncRoles($roles);

        return response()->json(['code' => 200, 'data' => $user]);
    }

    public function roles(Request $request)
    {
        $user = User::query()->with('roles')->findOrFail($request->id);
        return response()->json(['code' => 200, 'data' => $user]);
    }

    public function domains(Request $request)
    {
        $user = User::query()->findOrFail($request->id);
        $user->domains()->sync($request->domains);

        return response()->json(['code' => 200, 'data' => '']);
    }

    public function domainsList(Request $request)
    {
        $user = auth('api')->user();
        $domains = $user->domains()->get();;
        
        return response()->json(['code' => 200, 'data' => $domains]);
    }
}
