<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;

class gerneController extends Controller
{
    //direct gerne page
    public function list()
    {
        $data=Genre::get();
        return view('admin.gerne.list',compact('data'));
    }

    //create gerne
    public function create(Request $request)
    {
        $validate= Validator::make($request->all(),[
            'name' => 'required|unique:genres,genre_name'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'fail',
                'errors' => $validate->errors()
            ]);
        }

        Genre::create([
            'genre_name' => $request->name
        ]);

        return response()->json([
            'status' => 'success'
        ],200);
    }

    //delete genre
    public function delete(Request $request)
    {
        Genre::where('genre_id',$request->gen_id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    //update genre
    public function update(Request $request)
    {
        $id = $request->id;
        $validate=Validator::make($request->all(),[
            'name' => "required|unique:genres,genre_name,$id,genre_id"
        ]);

        if($validate->fails()){
            return response()->json([
                'status'=>'fail',
                'errors'=>$validate->errors()
            ]);
        }

        Genre::where('genre_id',$id)->update([
            'genre_name'=>$request->name
        ]);
        return response()->json([
            'status'=>'success',
        ]);
    }

    //search
    public function search(Request $request)
    {
        $data=Genre::where('genre_name','like','%'.$request->data.'%')->get();

        $list = '';
        $i = 1;
        if(count($data) > 0){
            foreach($data as $item)
            {
                $list .= '
                    <tr>
                        <td>'.$i.'</td>
                        <td class="text-center">'.$item->genre_name.'</td>
                        <td class="text-center">
                            <button style="border:none;" title="delete" value="'.$item->genre_id.'" class="deleteShow" data-bs-toggle="modal" data-bs-target="#deleteGenre"><i class="material-icons mt-1 fs-6">delete</i></button>
                            <button style="border:none;" title="edit" data-bs-toggle="modal" data-bs-target="#updateGerne" data-id="'.$item->genre_id.'" data-name="'.$item->genre_name.'" class="updateShow"><i class="material-icons mt-1 fs-6">edit</i></button>
                        </td>
                    </tr>
                ';
                $i++;
            }
        }else{
            $list ='
                <tr>
                    <td colspan="3" class="text-center text-secondary">
                        <h1>There is no Data</h1>
                    </td>
                </tr>
            ';
        }

        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }
}
