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
        $databate = Database::query()->with(['tables' => function ($query) {
            $query->where('type_id', 2);
        }])->findOrFail($request->id);
        setDatabase($databate);
        foreach ($databate->tables as $table) {
            $res = DB::connection('order')->table($table->name)->latest($table->time_column)->paginate(10);
        }

        return response()->json(['code' => 200, 'data' => $res]);
    }


}
