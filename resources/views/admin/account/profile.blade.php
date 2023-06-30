@extends('admin.layout.layout')

@section('title','Profile')

@section('content')
    <div class="wrapper">
        <div class="col-6 offset-3 mt-3 info"></div>
        <div class="card col-6 offset-3" style="margin-top:80px">
            <div class="profileInfo">
                <div class="card-body">
                    <h2 class="text-center" style="text-decoration: underline;user-select:none">Profile</h2>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div style="width: 100%;height:250px">
                                <img id="userImage" style="width:100%;height:250px;cursor: pointer;object-fit:contain" data-bs-target="#changePhoto" data-bs-toggle="modal" src="@if(auth()->user()->image == null) {{asset('admin/defaultuserImage/download (1).png')}} @else {{ asset('storage/userImage/'.auth()->user()->image) }} @endif" alt="">
                            </div>
                        </div>
                        <div class="col-6 row">
                            <div class="col-4">
                                <pre>Name</pre>
                                <pre>Email</pre>
                                <pre>Phone</pre>
                                <pre>Gender</pre>
                                <pre>Address</pre>
                            </div>
                            <div class="col-8">
                                <pre>:{{ auth()->user()->name }}</pre>
                                <pre>:{{ auth()->user()->email }}</pre>
                                <pre>:{{ auth()->user()->phone }}</pre>
                                <pre>:@if (auth()->user()->gender == 1)Male @elseif (auth()->user()->gender == 2)Female @elseif(auth()->user()->gender == 3)Other @endif</pre>
                                <pre>:{{ auth()->user()->address }}</pre>
                            </div>
                            <div class="col-6 offset-6">
                                <a href="javascript:{}" data-bs-toggle="modal" data-bs-target="#changePass" style="font-size: 0.7rem;float:right;transform:translateY(-20px)">Change Password?</a>
                                <button class="btn-sm w-100 btn-primary" data-bs-toggle="modal" data-bs-target="#editProfile" id="edit">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.account.modal')
@endsection
@section('script')
    @include('admin.account.profile_js')
@endsection
