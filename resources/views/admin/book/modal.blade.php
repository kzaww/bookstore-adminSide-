<!-- Create Modal -->
<div class="modal fade" id="createBook" aria-labelledby="bookCreate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form action="{{ route('admin#bookCreate') }}" method="Post" id="bookCreate" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="text-center">Create Author</h5>

                <div class="mt-3 name_gp">
                    <label for="name">Book Name :</label>
                    <input type="text" class="form-control mt-1" name="name" id="name" placeholder="name...">
                </div>

                <div class="mt-3 photo_gp">
                    <label >Book Photo :</label>
                    <input type="file" name="photo" accept="image/*" id="book_photo" hidden>
                    <span onclick="$('#book_photo').click();" id="photo_click" tabindex="0" style="cursor: pointer;font-size:1.3rem;letter-spacing:2px;margin-left:14px;text-decoration:underline">Click Here To Upload Photo</span>
                </div>

                <div class="img_preview">
                    <img src="" id="preview">
                </div>

                <div class="gen_gp">
                    <label for="">Genre :</label>
                    <span id="genre" tabindex="0" class="form-control" name="gen" style="cursor: pointer;min-height:35px"></span>
                    <div class="form-control" id="gen_info" style="background-color: rgb(201, 201, 201);height:100px;overflow-y:auto;user-select:none">
                        <input type="text" id="search_gen" placeholder="search..." autocomplete="off">
                        <div class="gen_items">
                            @foreach ($gen as $item)
                                <span class="form-control fs-9 mt-1 gen_items_data" data-id="{{ $item->genre_id }}">{{ $item->genre_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="author_gp">
                    <label for="">Author :</label>
                    <span id="author" tabindex="0" class="form-control" name="author" style="cursor: pointer;min-height:35px"></span>
                    <div class="form-control" id="author_info" style="background-color: rgb(201, 201, 201);height:100px;overflow-y:auto;user-select:none">
                        <input type="text" id="search_author" placeholder="search..." autocomplete="off">
                        <div class="author_items">
                            @foreach ($author as $item)
                                <span class="form-control fs-9 mt-1 author_items_data" data-id="{{ $item->author_id }}">{{ $item->author_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-3 price_gp">
                    <label for="price">Price :</label>
                    <input type="number" class="form-control mt-1" name="price" id="price" placeholder="price...">
                </div>

                <div class="mt-3 des_gp">
                    <label for="description">Book Description :</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="description..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary float-end my-3" id="bookCreateBtn">Create</button>
            </div>
        </form>
    </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteBook" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form action="{{ route('admin#bookDelete') }}" method="Post" id="bookDelete">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2>Are you Sure?</h2>

                <input type="text" name="book_id" class="book_id" hidden>
                <div class="float-end my-3">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">No</button>
                    <button type="submit" class="btn btn-primary ">Yes</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editBook" aria-labelledby="bookEdit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form action="{{ route('admin#bookUpdate') }}" method="Post" id="BookUpdate" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="text-center">Edit Book</h5>

                <input type="text" name="book_id" id="u_book_id" hidden>

                <div class="mt-3 u_name_gp">
                    <label for="name">Book Name :</label>
                    <input type="text" class="form-control mt-1" name="u_name" id="u_name" placeholder="name...">
                </div>

                <div class="mt-3 u_photo_gp">
                    <label >Book Photo :</label>
                    <input type="file" name="u_photo" accept="image/*" id="u_book_photo" hidden>
                    <span onclick="$('#u_book_photo').click();" id="u_photo_click" tabindex="0" style="cursor: pointer;font-size:1.3rem;letter-spacing:2px;margin-left:14px;text-decoration:underline">Click Here To Upload Photo</span>
                </div>

                <div class="up_img_preview row">
                    <div class="col-6 up_preview_container">
                        <img src="" id="up_preview">
                    </div>
                    <div class="col-6">
                        <label class="d-block">Old Image:</label>
                        <img src="" id="old_image" style="max-height:200px;max-width:100%">
                    </div>
                </div>

                <div class="u_gen_gp">
                    <label for="">Genre :</label>
                    <span id="u_genre" tabindex="0" class="form-control" name="u_gen" style="cursor: pointer;min-height:35px"></span>
                    <div class="form-control" id="u_gen_info" style="background-color: rgb(201, 201, 201);height:100px;overflow-y:auto;user-select:none">
                        <input type="text" id="u_search_gen" placeholder="search..." autocomplete="off">
                        <div class="u_gen_items">
                            @foreach ($gen as $item)
                                <span class="form-control fs-9 mt-1 u_gen_items_data" data-id="{{ $item->genre_id }}">{{ $item->genre_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div><br>

                <div class="u_author_gp">
                    <label for="">Author :</label>
                    <span id="u_author" tabindex="0" class="form-control" name="u_author" style="cursor: pointer;min-height:35px"></span>
                    <div class="form-control" id="u_author_info" style="background-color: rgb(201, 201, 201);height:100px;overflow-y:auto;user-select:none">
                        <input type="text" id="u_search_author" placeholder="search..." autocomplete="off">
                        <div class="u_author_items">
                            @foreach ($author as $item)
                                <span class="form-control fs-9 mt-1 u_author_items_data" data-id="{{ $item->author_id }}">{{ $item->author_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-3 u_price_gp">
                    <label for="price">Price :</label>
                    <input type="number" class="form-control mt-1" name="u_price" id="u_price" placeholder="price...">
                </div>

                <div class="mt-3 u_des_gp">
                    <label for="description">Book Description :</label>
                    <textarea name="u_description" id="u_description" class="form-control" cols="30" rows="5" placeholder="description..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary float-end my-3" id="bookUpdateBtn">Update</button>
            </div>
        </form>
    </div>
    </div>
</div>
