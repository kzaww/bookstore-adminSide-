@extends('admin.layout.layout')

@section('title','Gernes List')

@section('content')
    <div class="wrapper">
        <div class="d-flex justify-content-between">
            <h1 class="title1">Genres List</h1>
            <div  class="searchbox1">
                <input type="text" name="search" id="gerneSearch" placeholder="...">
            </div>

            <span id="genreTotal">Total:(<b>{{ count($data) }}</b>)</span>
        </div>

        <div class="d-flex info" style="height:40px">
            <button class="btn btn-success" id="create" title="Add Gernes">+</button>
        </div>
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <th >No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <?php $i=1; ?>
                <tbody class="table_data">
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td class="text-center">{{ $item->genre_name }}</td>
                            <td class="text-center">
                                <button style="border:none;" title="delete" value="{{ $item->genre_id }}" class="deleteShow" data-bs-toggle="modal" data-bs-target="#deleteGenre"><i class="material-icons mt-1 fs-6">delete</i></button>
                                <button style="border:none;" title="edit" data-bs-toggle="modal" data-bs-target="#updateGerne" data-id="{{ $item->genre_id }}" data-name="{{ $item->genre_name }}" class="updateShow"><i class="material-icons mt-1 fs-6">edit</i></button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.gerne.modal')
@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
        @include('admin.gerne.list_js')
@endsection
