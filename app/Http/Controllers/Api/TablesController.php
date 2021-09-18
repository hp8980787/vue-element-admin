<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;

class TablesController extends Controller
{
    public function index()
    {
        $tables = Table::query()->with(['database','format'])->paginate(30);
        return response()->json(['code' => 200, 'data' => $tables]);
    }
}
