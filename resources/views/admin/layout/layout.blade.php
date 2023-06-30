<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dropzone/dropzone.css') }}">
    <!-- google font icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="{{ asset('dropzone/dropzone.js') }}"></script>

    <!-- jquery cdn -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar_header">
            <div class="logo_content">
                <div class="logo">
                    <i class="material-icons">auto_stories</i>
                </div>
                <div class="logo_name">
                    <span>BookStore</span>
                </div>
            </div>
        </div>
        <div class="sidebar_body">
            <ul>
                <li class="{{ (request()->is('dashboard'))? 'active':'' }}">
                    <a href="{{ route('admin#dashboard') }}"><i class="material-icons">assignment</i><span>Dashboard</span></a>
                </li>
                <li class="drop {{ (request()->is('account*'))? 'active':''}}">
                    <a href="javascript:{}" class="acc_btn"><i class="material-icons">account_circle</i><span>Account</span></a>
                    <i class="material-icons acc_drop" id="acc_drop" onclick="$('#acc_drop').prev().click();">expand_more</i>
                    <ul class="show">
                        <li class="{{(request()->is('account'))? 'sub_active':'';}}">
                            <a href="{{ route('admin#account') }}">Profile</a>
                        </li>
                        <li>
                            <a href="javascript:{}">User List</a>
                        </li>
                    </ul>
                </li>
                <li class="{{(request()->is('gernes*'))? 'active':'';}}">
                    <a href="{{ route('admin#gerneList') }}"><i class="material-icons">category</i><span>Gernes</span></a>
                </li>
                <li class="{{ (request()->is('author*'))? 'active' : '' }}">
                    <a href="{{ route('admin#authorList') }}"><i class="material-icons">attribution</i><span>Authors</span></a>
                </li>
                <li class="{{ (request()->is('book*'))? 'active' : '' }}">
                    <a href="{{ route("admin#bookList") }}"><i class="material-icons">inventory_2</i><span>Books</span></a>
                </li>
                <li>
                    <a href="javascript:{}"><i class="material-icons">list_alt</i><span>Orders</span></a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="javascript:{}" onclick="this.parentNode.submit()" id="logout"><i class="material-icons">logout</i><span>Log Out</span></a>
                    </form>
                </li>
            </ul>
            <div class="account">
                <img id="userImage2" src="@if(auth()->user()->image == null) {{asset('admin/defaultuserImage/download (1).png')}} @else {{ asset('storage/userImage/'.auth()->user()->image) }} @endif" alt="">
                <span>Admin</span>
            </div>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // console.log(document.querySelector("meta[name='_token']").content);
    $(document).ready(function(e){
        $('.acc_btn').click(function() {
            $('.acc_drop').toggleClass('rotate');
            $('.show').toggleClass('visible');
            $('body').toggleClass('child');
        })
    })

</script>
    @yield('script')

</html>
