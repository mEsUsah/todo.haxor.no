<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListsController extends Controller
{
    public static function index(){
        $lists = DB::table('lists')->select(['id', 'name'])->get();
        return view('sections.index', [
            'lists' => $lists]
        );
    }

    public static function create(Request $request){
        $validated = $request->validate([
            'name' => ['required','string', 'max:255']
        ]);

        $list = new Lists;
        $list->name = $validated['name'];
        $list->data = "";

        $list->save();
        return redirect('/lists');
    }

    public static function show($id){
        $list = DB::table('lists')->where('id', $id);

        return view('sections.lists', [
            'id'    => $list->id,
            'name'  => $list->name,
            'data'  => $list->data
        ]);
    }
}
