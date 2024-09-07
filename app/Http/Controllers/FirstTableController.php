<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Firsttable;
use Image;

class FirstTableController extends Controller
{
    public function store(Request $req){
        $validated = $req->validate([
            'text' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer'],
            'image' => ['image'],
        ],
        [
            'text.required' => 'Text is required',
            'text.string' => 'Text must be a string',
            'text.max' =>'Text must not be greater than 255 characters',
            'number.required' => 'Number is required',
            'number.integer' => 'Number must be an integer',
            'image.image' => 'Image must be an image',
        ]);

        $firsttable = new Firsttable;
        $image = request()->file('image');
        if($image){
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/firsttable/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(300,300);
            $resize_image->save('images/firsttable/'.$fullname);
            $firsttable -> text = $req -> text;
            $firsttable -> number = $req -> number;
            $firsttable -> image = $url;
            $firsttable -> save();
            return response()->json([
                'message' => 'Data successfully added'
            ],200);
        }
        else{
            $firsttable -> text = $req -> text;
            $firsttable -> number = $req -> number;
            $firsttable -> save();
            return response()->json([
                'message' => 'Data successfully added'
            ],200);
        }
    }
    public function show(){
        $firsttables = Firsttable::with('secondtables')->orderBy('text', 'ASC')->get();
        return $firsttables;
    }
    public function edit($id){
        $firsttable = Firsttable::findorfail($id);
        return $firsttable;
    }
    public function update(Request $req){
        $validatedData = $req->validate([
            'text' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer'],
            'image' => ['image'],
        ],
        [
            'text.required' => 'Text is required',
            'text.string' => 'Text must be a string',
            'text.max' =>'Text must not be greater than 255 characters',
            'number.required' => 'Number is required',
            'number.integer' => 'Number must be an integer',
            'image.image' => 'Image must be an image',
        ]);

        $firsttable = Firsttable::findorfail($req->id);
        $image = request()->file('image');
        if($image){
            $old_image=$firsttable->image;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/firsttable/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(300,300);
            $resize_image->save('images/firsttable/'.$fullname);
            $firsttable -> text = $req -> text;
            $firsttable -> number = $req -> number;
            $firsttable -> image = $url;
            $firsttable -> save();
            return response()->json([
                'message' => 'Data successfully updated'
            ],200);
        }
        else{
            $firsttable -> text = $req -> text;
            $firsttable -> number = $req -> number;
            $firsttable -> save();
            return response()->json([
                'message' => 'Data successfully updated'
            ],200);
        }
    }
    public function destroy(Request $req){
        $firsttable = Firsttable::findorfail($req->id);
        $image  = $firsttable->image;
        if(file_exists($image)){
            unlink($image);
        }
        $firsttable->delete();
        return response()->json([
            'message' => 'Data successfully deleted'
        ],200);
    }
}
