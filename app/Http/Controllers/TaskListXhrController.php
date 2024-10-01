<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListXhrController extends Controller
{
    public static function index()
    {
        $lists = TaskList::select('id','name')->get();
        return response()->json($lists);
    }

    public static function show($id)
    {
        $tasks = TaskList::where('list', $id)
            ->select('id', 'title','complete')
            ->get();

        return response()->json($tasks);
    }
}
