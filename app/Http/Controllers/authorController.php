<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class authorController extends Controller
{
    //direct author page
    public function list()
    {
        $data = Author::get();
        return view('admin.author.list',compact('data'));
    }

    //create author
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|unique:authors,author_name',
            'photo' => 'required|mimes:png,jpg,jpeg,webg|max:2048',
            'bio' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'fail',
                'errors' => $validate->errors()
            ]);
        }
        if($request->file('photo')){
            $file = $request->file('photo');
            $image_name= uniqid().'_'.$file->getClientOriginalName();

            Author::create([
                'author_name' => $request->name,
                'bio' => $request->bio,
                'author_image' => $image_name
            ]);
            $file->storeAs('public/author_images',$image_name);
            return response()->json([
                'status' => 'success',
            ],200);
        }
    }

    //delete author
    public function delete(Request $request)
    {
        $image = Author::where('author_id',$request->author_id)->first();
        $image = $image['author_image'];

        if(File::exists(public_path('storage/author_images/'.$image))){
            Storage::delete('public/author_images/'.$image);
        }
        Author::where('author_id',$request->author_id)->delete();
        return response()->json([
            'status'=>'success'
        ],200);
    }

    //update author
    public function update(Request $request)
    {
        $id = $request->up_author_id;
        $validate = Validator::make($request->all(),[
            'up_name' => "required|unique:authors,author_name,$id,author_id",
            'up_bio' => "required",
            'up_photo' => 'mimes:png,jpg,jpeg,webg'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'fail',
                'errors' => $validate->errors()
            ]);
        }

        if($request->file('up_photo')){
            $old_image = Author::where('author_id',$id)->first();
            $old_image = $old_image['author_image'];
            $file = $request->file('up_photo');
            $image_name = uniqid().'_'.$file->getClientOriginalName();
            if(File::exists(public_path('storage/author_images/'.$old_image))){
                Storage::delete('public/author_images/'.$old_image);
            }
            Author::where('author_id',$id)->update([
                'author_name' => $request->up_name,
                'author_image'=> $image_name,
                'bio'=>$request->up_bio,
                'updated_at' => Carbon::now()
            ]);
            $file->storeAs('public/author_images',$image_name);
        }

        Author::where('author_id',$id)->update([
            'author_name' => $request->up_name,
            'bio'=>$request->up_bio,
            'updated_at' => Carbon::now()
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    //search author
    public function search(Request $request)
    {
        $data = Author::where('author_name','like','%'.$request->data.'%')->get();


        $list ='';
        $i =1;
        foreach($data as $item)
        {
            $list .= '
            <li class="list_item" style="">
                <span style="width: 10%" class="pt-2 ps-2">'.$i.'</span>
                <span class="" style="width:20%">
                    <img class="img-thumbnail" src="http://127.0.0.1:8000/storage/author_images/'.$item->author_image.'" alt="" style="width:45%;height:90%;margin-top:2%">
                </span>
                <span style="width: 20%" class="pt-2">'.$item->author_name.'</span>
                <span style="width: 35%"  class="bio pt-2">'.$item->bio .'</span>
                <div class="author_btn ps-5 pt-2" style="width:15%">
                    <button style="border:none;" title="delete" class="btn_delete" data-id="'.$item->author_id .'" data-bs-target="#deleteAuthor" data-bs-toggle="modal"><i class="material-icons mt-1 fs-6">delete</i></button>
                    <button style="border:none;" title="edit" class="btn_edit"
                        data-id="'.$item->author_id.'" data-name="'.$item->author_name .'"
                        data-image="'.$item->author_image .'" data-bio="'. $item->bio .'"
                         data-bs-target="#updateAuthor" data-bs-toggle="modal"><i class="material-icons mt-1 fs-6">edit</i>
                    </button>
                </div>
            </li>
            ';
            $i++;
        }

        $count = count($data);

        if(!empty($request->data)){
            $com = Author::where('author_name','like','%'.$request->data.'%')->get();
            $auto = '<ul class="list-unstyled" id="autocomplete" style="background-color: #eeeeee;">';
            foreach($com as $item)
            {
                $auto.='
                    <li class="auto_list">&nbsp'.$item->author_name.'</li>
                ';
            }

            $auto .='</ul>';
            return response()->json([
                'status' => 'success',
                'data' => $list,
                'auto' => $auto,
                'count' => $count
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $list,
            'count' => $count
        ]);
    }

}
