<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\User;
use App\Http\Resources\Api\UserResource;
class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()->with('roles')->get();
        return response()->json(['code' => 200, 'data' => UserResource::collection($users)]);
    }
}
