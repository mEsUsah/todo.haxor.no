<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Lists;
use Illuminate\Http\Request;

class ListsXhrController extends Controller
{
    public static function index()
    {
        $lists = Lists::select('id','name')->get();
        return response()->json($lists);
    }

    public static function show($id)
    {
        $tasks = Task::where('list', $id)
            ->select('id', 'title','complete')
            ->get();

        return response()->json($tasks);
    }
}
