<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class accountController extends Controller
{
    //profile
    public function list()
    {
        return view('admin.account.profile');
    }

    //update data
    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => "required|unique:users,email,$id,id",
            'phone' => "required|unique:users,phone,$id,id",
            'gender' => 'required',
            'address' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ]);
        }
        User::whereId($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address

        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }

    //change Password
    public function changePassword(Request $request)
    {
        $user = User::whereId(auth()->user()->id)->first();
        $dbpass = $user['password'];
        $oldpass = $request->oldPass;

        $validator = Validator::make($request->all(),[
            'oldPass' => 'required|string|min:6',
            'newPass' => 'required|string|min:6',
            'confirmPass' => 'required|same:newPass|min:6'
        ])->after(function($validator) use($oldpass,$dbpass){
            if(!Hash::check($oldpass , $dbpass)){
                $validator->errors()->add('oldPass' , 'old password does not match!');
            }
        });
        if($validator->fails()){
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ]);
        }
        $password = Hash::make($request->confirmPass);

        User::whereId(auth()->user()->id)->update([
            'password' => $password
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    //upload file
    public function photo(Request $request)
    {
        $file = $request->file('file');
        $imageName = uniqid().'_'.$file->getClientOriginalName();
        $dbImage = auth()->user()->image;
        if(File::exists(public_path('storage/userImage/'.$dbImage))){
            Storage::delete('public/userImage/'.$dbImage);
        }
        $user = User::where('id',auth()->user()->id)->update(['image' => $imageName]);
        $file->storeAs('public/userImage/'.$imageName);
        return response()->json([
            'status' => 'success',
            'data' => $imageName
        ]);
    }
}
