<!-- Create Modal -->
<div class="modal fade" id="createAuthor" tabindex="-1" aria-labelledby="authorCreate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form action="{{ route('admin#authorCreate') }}" method="Post" id="AuthorCreate" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="text-center">Create Author</h5>

                <div class="mt-3 name_gp">
                    <label for="name">Author Name :</label>
                    <input type="text" class="form-control mt-1" name="name" id="name" placeholder="name...">
                </div>

                <div class="mt-3 photo_gp">
                    <label >Author Photo :</label>
                    <input type="file" name="photo" accept="image/*" id="author_photo" hidden>
                    <span onclick="$('#author_photo').click();" id="photo_click" tabindex="0" style="cursor: pointer;font-size:1.3rem;letter-spacing:2px;margin-left:14px;text-decoration:underline">Click Here To Upload Photo</span>
                </div>

                <div class="img_preview">
                    <img src="" id="preview">
                </div>

                <div class="mt-3 bio_gp">
                    <label for="bio">Author Bio :</label>
                    <textarea name="bio" id="bio" class="form-control" cols="30" rows="5" placeholder="bio..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary float-end my-3" id="authorCreateSubmit">Create</button>
            </div>
        </form>
    </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteAuthor" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form action="{{ route('admin#authorDelete') }}" method="Post" id="authorDelete">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2>Are you Sure?</h2>

                <input type="text" name="author_id" id="author_id" hidden>
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
<div class="modal fade" id="updateAuthor" tabindex="-1" aria-labelledby="authorUpdate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form action="{{ route('admin#authorUpdate') }}" method="Post" id="AuthorUpdate" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="text-center" id="authorUpdate">Create Author</h5>

                <input type="text" name="up_author_id" id="up_author_id" hidden>
                <div class="mt-3 up_name_gp">
                    <label for="name">Author Name :</label>
                    <input type="text" class="form-control mt-1" name="up_name" id="up_name" placeholder="name...">
                </div>

                <div class="mt-3 up_photo_gp">
                    <label >Author Photo :</label>
                    <input type="file" name="up_photo" accept="image/*" id="up_author_photo" hidden>
                    <span onclick="$('#up_author_photo').click();" id="up_photo_click" tabindex="0">Click Here To Update Photo</span>
                </div>

                <div class="up_img_preview row" style="border:dashed 1px rgb(0, 0, 0,0.5)">
                    <div class="col-6 up_preview_container">
                        <img src="" id="up_preview">
                    </div>
                    <div class="col-6">
                        <label for="">Old Image:</label>
                        <img src="" id="old_image" style="height:200px;max-width:100%">
                    </div>
                </div>

                <div class="mt-3 up_bio_gp">
                    <label for="bio">Author Name :</label>
                    <textarea name="up_bio" id="up_bio" class="form-control" cols="30" rows="5" placeholder="bio..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary float-end my-3" id="authorEditSubmit">Save changes</button>
            </div>
        </form>
    </div>
    </div>
</div>
