<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Database;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class OrdersController extends Controller
{
    public function database(Request $request)
    {
        if ($request->table_name) {
            $databate = Database::query()->findOrFail($request->id);
            setDatabase($databate);
            $table = Table::query()->where('database_id', $databate->id)->where('type_id', 2)
                ->where('name', $request->table_name)->first();
            $query = DB::connection('order')
                ->table($table->name)->latest($table->time_column);
            if ($request->search) {
                foreach ($table->full_column as $column){
                    $query->orWhere($column,'like',"%$request->search%");
                }
            }
            $res =$query->paginate(10);

        } else {
            $databate = Database::query()->with(['tables' => function ($query) {
                $query->where('type_id', 2);
            }])->findOrFail($request->id);
            setDatabase($databate);
            foreach ($databate->tables as $table) {
                $res[] = DB::connection('order')->table($table->name)->latest($table->time_column)->paginate(10);
            }
        }


        return response()->json(['code' => 200, 'data' => $res]);
    }


}
