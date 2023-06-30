<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class bookController extends Controller
{
    //redirect book page
    public function list()
    {
        $gen = Genre::get();
        $author = Author::get();
        $data = Product::Select('products.*','genres.genre_name','authors.author_name')
                        ->leftjoin('genres','products.genre_id','genres.genre_id')
                        ->leftjoin('authors','products.authur_id','authors.author_id')
                        ->get();
        // dd($data->toArray());
        return view('admin.book.list',compact('gen','author','data'));
    }

    //for genre select search
    public function gen_search(Request $request)
    {
        $data = Genre::where('genre_name','like','%'.$request->data.'%')->get();
        $list = '';
        if(count($data) > 0){
            foreach($data as $item)
            {
                $list .='
                    <span class="form-control fs-9 mt-1 gen_items_data" data-id="'.$item->genre_id.'">'. $item->genre_name .'</span>
                ';
            }
        }else{
            $list .='
            <span class="form-control fs-9 mt-1" style="text-align:center;cursor:auto;">There is no Data</span>
            ';
        }

        return response()->json([
            'status'=> 'success',
            'data' => $list
        ]);
    }

    //for author select search
    public function author_search(Request $request)
    {
        $data = Author::where('author_name','like','%'.$request->data.'%')->get();
        $list = '';
        if(count($data) > 0){
            foreach($data as $item)
            {
                $list .='
                    <span class="form-control fs-9 mt-1 author_items_data" data-id="'.$item->author_id.'">'. $item->author_name .'</span>
                ';
            }
        }else{
            $list .='
            <span class="form-control fs-9 mt-1" style="text-align:center;cursor:auto;">There is no Data</span>
            ';
        }

        return response()->json([
            'status'=> 'success',
            'data' => $list
        ]);
    }

    //create book
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|unique:products,product_name',
            'price' => 'required',
            'description' => 'required',
            'gen' => 'required',
            'author' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg,webg|max:2048',
        ]);
        if($validate->fails())
        {
            return response()->json([
                'status' => 'fail',
                'errors' => $validate->errors()
            ]);
        }

        $file = $request->file('photo');
        $image_name = uniqid().'_'.$file->getClientOriginalName();
        Product::create([
            'product_name' => $request->name,
            'description' => $request->description,
            'genre_id' => $request->gen,
            'authur_id' => $request->author,
            'product_image' => $image_name,
            'price' => $request->price,
            'view' => 0,
        ]);
        $file->storeAs('public/book_images/'.$image_name);

        return response()->json([
            'status' => 'success'
        ]);
    }

    //delete book
    public function delete(Request $request)
    {
        // logger($request->all());
        $image = Product::where('product_id',$request->book_id)->first();
        $image = $image['product_image'];

        if(File::exists(public_path('storage/book_images/'.$image))){
            Storage::delete('public/book_images/'.$image);
        }
        Product::where('product_id',$request->book_id)->delete();
        return response()->json([
            'status'=>'success'
        ],200);
    }

    //update book
    public function update(Request $request)
    {
        $id = $request->book_id;
        $validate = Validator::make($request->all(),[
            'u_name' => "required|unique:products,product_name,$id,product_id",
            'u_price' => 'required',
            'u_description' => 'required',
            'u_photo' => 'mimes:png,jpg,jpeg,webg|max:2048',
            'u_gen' => 'required',
            'u_author' => 'required'
            ],[
                'required' => 'This Field Is Required!!'
            ]
        );

        if($validate->fails()){
            return response()->json([
                'status' => 'fail',
                'errors' => $validate->errors()
            ]);
        }
        $file = $request->file('u_photo');
        if($file){
            $image_name = uniqid().'_'.$file->getClientOriginalName();
            $oldimage = Product::where('product_id',$id)->first();
            $oldimage = $oldimage->product_image;
            if(File::exists(public_path('storage/book_images/'.$oldimage))){
                Storage::delete('public/book_images/'.$oldimage);
            }
            Product::where('product_id',$id)->update([
                'product_name' => $request->u_name,
                'description' =>   $request->u_description,
                'genre_id' => $request->u_gen,
                'authur_id' => $request->u_author,
                'price' => $request->u_price,
                'product_image' => $image_name,
                'updated_at' => Carbon::now()
            ]);
            $file->storeAs('public/book_images/'.$image_name);
        }else{
            Product::where('product_id',$id)->update([
                'product_name' => $request->u_name,
                'description' =>   $request->u_description,
                'genre_id' => $request->u_gen,
                'authur_id' => $request->u_author,
                'price' => $request->u_price,
                'updated_at' => Carbon::now()
            ]);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    //search autocomplete
    public function book_auto(Request $request)
    {
        $search = $request->data;
        //autocomplete
        if(!empty($search)){
            $book = Product::select('product_name')
                            ->where('product_name','like',"%{$search}%")->get();
            $price = Product::select('price')
                            ->where('price','like',"%{$search}%")->get();
            $genre = Genre::select('genre_name')
                        ->where('genre_name','like',"%{$search}%")->get();
            $author = Author::select('author_name')
                        ->where('author_name','like',"%{$search}%")->get();
            $auto = '';

            if($book){
                foreach($book as $item)
                {
                    $auto.='
                        <li class="auto_list" >&nbsp'.$item->product_name.'</li>
                    ';
                }
            }
            if($price){
                foreach($price as $item)
                {
                    $auto.='
                        <li class="auto_list" >&nbsp'.$item->price.'</li>
                    ';
                }
            }
            if($genre){
                foreach($genre as $item)
                {
                    $auto.='
                        <li class="auto_list" >&nbsp'.$item->genre_name.'</li>
                    ';
                }
            }
            if($author){
                foreach($author as $item)
                {
                    $auto.='
                        <li class="auto_list" >&nbsp'.$item->author_name.'</li>
                    ';

                }
            }

            return response()->json([
                'status' => 'success',
                'auto' => $auto
            ]);
        }
    }

    //book search data
    public function bookSearch(Request $request)
    {
        $search = $request->data;
        if($search == ''){
            $data = Product::Select('products.*','genres.genre_name','authors.author_name')
                            ->leftjoin('genres','products.genre_id','genres.genre_id')
                            ->leftjoin('authors','products.authur_id','authors.author_id')
                            ->get();
        }else{
            $data = Product::Select('products.*','genres.genre_name','authors.author_name')
                            ->leftjoin('genres','products.genre_id','genres.genre_id')
                            ->leftjoin('authors','products.authur_id','authors.author_id')
                            ->where('product_name','like','%'.$search.'%')
                            ->orwhere('genre_name','like','%'.$search.'%')
                            ->orwhere('author_name','like','%'.$search.'%')
                            ->orwhere('price','like','%'.$search.'%')
                            ->get();
        }

        return view('admin.book.searchData',compact('data','search'))->render();
    }

    //search and change total
    public function bookTotal(Request $request)
    {
        $search = $request->data;
        $data = Product::Select('products.*','genres.genre_name','authors.author_name')
                        ->leftjoin('genres','products.genre_id','genres.genre_id')
                        ->leftjoin('authors','products.authur_id','authors.author_id')
                        ->where('product_name','like','%'.$search.'%')
                        ->orwhere('genre_name','like','%'.$search.'%')
                        ->orwhere('author_name','like','%'.$search.'%')
                        ->orwhere('price','like','%'.$search.'%')
                        ->get();
        $count = count($data);

        return response()->json([
            'status' => 'success',
            'data' => $count
        ]);
    }
}
