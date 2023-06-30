<ul class="p-0">
    <li class="list_item head" style="font-weight:500;height:50px !important">
        <span style="width:5%">No</span>
        <span style="width:10%">Image</span>
        <span style="width:10%">Name</span>
        <span style="width:10%">Genre</span>
        <span style="width:10%">Author</span>
        <span style="width:10%">Price</span>
        <span style="width:10%">View</span>
        <span style="width:25%">Description</span>
        <div style="width:10%"></div>
    </li>

    <?php $i=1; ?>
    <div class="list_data">
        @if (count($data) > 0)
            @foreach ($data as $item)
                <li class="list_item pt-2" style="">
                    <span style="width:5%">{{ $i }}</span>
                    <span style="width:10%">
                        <img class="img-thumbnail" src="{{ asset('storage/book_images/'.$item->product_image) }}" style="width:45%;height:90%;margin-top:2%">
                    </span>
                    <span style="width:10%;hyphens:auto;overflow-wrap: break-word;word-wrap: break-word;">{{ $item->product_name }}</span>
                    <span style="width:10%;padding-left:5px">{{ $item->genre_name }}</span>
                    <span style="width:10%">{{ $item->author_name }}</span>
                    <span style="width:10%">{{ $item->price }} Kyats</span>
                    <span style="width:10%">0</span>
                    <span style="width:25%">{{ $item->description }}</span>
                    <div style="width:10%">
                        <button style="border:none;" title="delete" class="btn_delete" data-id="{{ $item->product_id }}" data-bs-target="#deleteBook" data-bs-toggle="modal"><i class="material-icons mt-1 fs-6">delete</i></button>
                        <button style="border:none;" title="edit" class="btn_edit"
                            data-id="{{ $item->product_id }}" data-name="{{ $item->product_name }}"
                            data-image="{{ $item->product_image }}" data-genre="{{ $item->genre_name }}" data-genre_id="{{ $item->genre_id }}"
                            data-author="{{ $item->author_name }}" data-author_id="{{ $item->authur_id }}" data-price="{{ $item->price }}" data-des="{{ $item->description }}"
                            data-bs-target="#editBook" data-bs-toggle="modal"><i class="material-icons mt-1 fs-6">edit</i>
                        </button>
                    </div>
                </li>
                <?php $i++;?>
            @endforeach
        @else
            <li class="list_item justify-content-center" style="display:table;width:100%;">
                <span style="display:table-cell; vertical-align:middle;width:100%;text-align:center;font-size:1.6rem;color:red">There is No Data</span>
            </li>
        @endif
    </div>
        <div class="">
            <span style="font-size:0.7rem;margin:10px"> Search Key : {{ $search }}</span>
        </div>
</ul>

