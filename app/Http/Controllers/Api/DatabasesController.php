<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Database;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $databases = Database::query()->paginate(30);
        return response()->json(['code' => 200, 'data' => $databases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $databases = Database::query()->with(['tables','users'])->findOrFail($id);
        return response(['code' => 200, 'data'=>$databases]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allDatabases()
    {
        $databases = Database::query()->latest('created_at')->get();
        return response()->json(['code' => 200, 'data' => $databases]);
    }

    public function tablesName(Request $request, $id)
    {
        $database = Database::query()->findOrFail($id);
        setDatabase('order', $database);
        $names = DB::connection('order')->select("show tables");
        $data = [];
        foreach ($names as $name) {
            foreach ($name as $val) {
                $data[] = $val;
            }
        }

        return response()->json(['code' => 200, 'data' => $data]);
    }

    public function tablesInfo(Request $request, $id)
    {
        $data = [];
        $database = Database::query()->findOrFail($id);
        setDatabase('order', $database);
        if ($request->has('table_name')) {
            $table = $request->table_name;
            $columns = DB::connection('order')->select("show full columns from $table");
            foreach ($columns as $column) {
                $data[] = $column->Field;
            }
        }
        return response()->json(['code' => 200, 'data' => $data]);
    }
}
