<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Secondtable;

class SecondTableController extends Controller
{
    public function store(Request $req){
        $validated = $req->validate([
            'stext' => ['required', 'string', 'max:255'],
            'ft_id' => ['required'],
        ],
        [
            'stext.required' => 'Text is required',
            'stext.string' => 'Text must be a string',
            'stext.max' =>'Text must not be greater than 255 characters',
            'ft_id.required' => 'Text is required'
        ]);

        $secondtable = new Secondtable;
        $secondtable -> stext = $req -> stext;
        $secondtable -> ft_id = $req -> ft_id;
        $secondtable->save();
        return response()->json([
            'message' => 'Data successfully added'
        ],200);
    }
    public function show(){
        $secondtables = Secondtable::with('firsttables')->orderBy('stext', 'ASC')->get();
        return $secondtables;
    }
    public function edit($id){
        $secondtable = Secondtable::with('firsttables')->where('id', $id)->first();
        return $secondtable;
    }
    public function update(Request $req){
        $validatedData = $req->validate([
            'stext' => ['required', 'string', 'max:255'],
            'ft_id' => ['required'],
        ],
        [
            'stext.required' => 'Text is required',
            'stext.string' => 'Text must be a string',
            'stext.max' =>'Text must not be greater than 255 characters',
            'ft_id.required' => 'Text is required'
        ]);

        $secondtable = Secondtable::findorfail($req->id);
        $secondtable -> stext = $req -> stext;
        $secondtable -> ft_id = $req -> ft_id;
        $secondtable -> save();
        return response()->json([
            'message' => 'Data successfully updated'
        ],200);
    }
    public function destroy(Request $req){
        Secondtable::findorfail($req->id)->delete();
        return response()->json([
            'message' => 'Data successfully deleted'
        ],200);
    }
}
