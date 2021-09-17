<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class OrdersController extends Controller
{
    public function database(Request $request)
    {
        $databate = Database::query()->with(['tables'=>function($query){
            $query->where('type_id',2);
        }])->findOrFail($request->id);
        Config::set('database.connections.order',[
            'driver' => 'mysql',
            'host' =>$databate->ip,
            'port' => $databate->port,
            'database' => $databate->database,
            'username' => $databate->username,
            'password' => $databate->passwd,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
        ]);
        foreach($databate->tables as $table){
           $res = DB::connection('order')->table($table->name)->limit(5)->get();
           dd($res);
        }

        return response()->json(['code' => 200, 'data' => '']);
    }
}
