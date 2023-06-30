@extends('admin.layout.layout')

@section('title','Author List')

@section('content')
    <div class="wrapper">
        <div class="d-flex justify-content-between">
            <h1 class="title1">Author List</h1>
            <div  class="searchbox1">
                <input type="text" name="search" id="authorSearch" placeholder="..." autocomplete="off">
            </div>

            <span id="authorTotal">Total:(<b id="total">{{ count($data) }}</b>)</span>
        </div>

        <div class="d-flex info" style="height:40px">
            <button class="btn btn-success" id="create" title="Add Author" data-bs-target="#createAuthor" data-bs-toggle="modal">+</button>
        </div>
        <div class="list_data">
            <ul class="p-0">
                <li class="list_item head" style="font-weight:500;height:50px !important">
                    <span style="width:10%">No</span>
                    <span style="width:20%">Image</span>
                    <span style="width:20%">Name</span>
                    <span style="width:30%">Biography</span>
                    <div style="width:20%"></div>
                </li>
                <?php $i=1; ?>
                <div class="list_data_body">
                    @foreach ($data as $item)
                        <li class="list_item" style="">
                            <span style="width: 10%" class="pt-2 ps-2">{{ $i }}</span>
                            <span class="" style="width:20%">
                                <img class="img-thumbnail" src="{{ asset('storage/author_images/'.$item['author_image']) }}" alt="" style="width:45%;height:90%;margin-top:2%">
                            </span>
                            <span style="width: 20%" class="pt-2">{{ $item->author_name }}</span>
                            <span style="width: 35%"  class="bio pt-2">{{ $item->bio }}</span>
                            <div class="author_btn ps-5 pt-2" style="width:15%">
                                <button style="border:none;" title="delete" class="btn_delete" data-id="{{ $item->author_id }}" data-bs-target="#deleteAuthor" data-bs-toggle="modal"><i class="material-icons mt-1 fs-6">delete</i></button>
                                <button style="border:none;" title="edit" class="btn_edit"
                                    data-id="{{ $item->author_id }}" data-name="{{ $item->author_name }}"
                                    data-image="{{ $item->author_image }}" data-bio="{{ $item->bio }}"
                                     data-bs-target="#updateAuthor" data-bs-toggle="modal"><i class="material-icons mt-1 fs-6">edit</i>
                                </button>
                            </div>
                        </li>
                        <?php $i++; ?>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
@include('admin.author.modal')

@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
    @include('admin.author.list_js')
@endsection
