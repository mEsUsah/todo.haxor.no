<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListsController extends Controller
{
    public static function show($id){
        $list = DB::table('lists')->where('id', $id);

        return view('sections.lists', [
            'id'    => $list->id,
            'name'  => $list->name,
            'data'  => $list->data
        ]);
    }
}
