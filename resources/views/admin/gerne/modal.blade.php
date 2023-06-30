<!-- Create Modal -->
<div class="modal fade" id="createGerne" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#gerneCreate') }}" method="Post" id="GerneCreate" style="background-color: rgb(236, 236, 236)">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="text-center">Create Gerne</h5>

                <div class="mt-3 name_gp">
                    <label for="name">Gerne Name :</label>
                    <input type="text" class="form-control mt-1" name="name" id="name" placeholder="name...">

                </div>

                <button type="submit" class="btn btn-primary float-end my-3" id="genCreateBtn">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<!--Delete Modal -->
<div class="modal fade" id="deleteGenre" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#gerneDelete') }}" method="Post" id="GerneDelete" style="background-color: rgb(236, 236, 236)">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h2>Are you Sure?</h2>

                <input type="text" name="gen_id" id="gen_id" hidden>
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
<div class="modal fade" id="updateGerne" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#gerneUpdate') }}" method="Post" id="GerneUpdate" style="background-color: rgb(236, 236, 236)">
            @csrf
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="text-center">Edit Gerne</h5>

                <input type="text" name="id" id="up_id" hidden>
                <div class="mt-3 up_name_gp">
                    <label for="up_name">Gerne Name :</label>
                    <input type="text" class="form-control mt-1" name="name" id="up_name" placeholder="name..." autocomplete="off">

                </div>

                <button type="submit" class="btn btn-primary float-end my-3 up_gen" id="genEditBtn">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
