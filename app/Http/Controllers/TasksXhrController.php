<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksXhrController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return response()->json($tasks);
    }
}
