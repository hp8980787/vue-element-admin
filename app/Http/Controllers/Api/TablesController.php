<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Database;
use Illuminate\Http\Request;
use App\Models\Table;

class TablesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $tables = Table::query()->with(['database', 'format'])->paginate(30);
        return response()->json(['code' => 200, 'data' => $tables]);
    }

    public function store(Request $request)
    {
        $data = [];
        $user = auth('api')->user();
        $data = $request->only('database_id', 'name', 'type_id', 'display_column', 'full_column', 'time_column');
        $data['author'] = $user->name;
        Table::query()->create($data);
        return response()->json(['code' => 200, 'data' => '']);
    }

    public function destroy($id)
    {
        Table::query()->where('id', $id)->delete();
        return response()->json(['code' => 200, 'data' => '']);
    }

    public function show(Request $request,$id)
    {
        $database = Database::query()->findOrFail($id);
        $table = Table::query()->where('type_id', 2)
            ->where('name',$request->name)
            ->where('database_id', $database->id)->first();
        return response()->json(['code' => 200, 'data' => $table]);
    }

}
