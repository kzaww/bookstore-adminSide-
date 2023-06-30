{{-- edit profile --}}
<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="Edit" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('admin#accountUpdate') }}" id="updateProfile" method="POST">
            @csrf
            <div class="modal-body pt-1">
            <button type="button" class="btn-close float-end mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
            <h3 class="text-center">Profile Edit</h3>

            <div class="mt-3 name_gp">
                <label for="u_name">Name :</label>
                <input type="text" class="form-control mt-1" name="name" id="u_name" placeholder="name..." value="{{ auth()->user()->name }}">
            </div>
            <div class="mt-3 email_gp">
                <label for="u_email">Email :</label>
                <input type="text" class="form-control mt-1" name="email" id="u_email" placeholder="email..." value="{{ auth()->user()->email }}">
            </div>
            <div class="mt-3 ph_gp">
                <label for="u_phone">Phone :</label>
                <input type="text" class="form-control mt-1" name="phone" id="u_phone" placeholder="phone..." value="{{ auth()->user()->phone }}">
            </div>
            <div class="mt-3 gender_gp" style="user-select:none;">
                <label>gender :</label>
                Male<input type="radio" class="mt-1 ms-1" value="1" name="gender"  style="transform: translateY(2px)" @if (auth()->user()->gender == '1') checked  @endif>
                Female<input type="radio" class="mt-1 ms-1" value="2" name="gender" style="transform: translateY(2px)" @if (auth()->user()->gender == '2') checked  @endif>
                Other<input type="radio" class="mt-1 ms-1" value="3" name="gender" style="transform: translateY(2px)" @if (auth()->user()->gender == '3') checked  @endif>
            </div>
            <div class="mt-3 address_gp">
                <label for="u_address">Address :</label>
                <textarea name="address" class="form-control" id="u_address" cols="30" rows="5" placeholder="address...">{{ auth()->user()->address }}</textarea>
            </div>

            <div class="float-end mt-2">
                <button type="submit" id="update" class="btn btn-primary mb-2">Update</button>
            </div>
        </div>
    </form>
    </div>
</div>
</div>

{{-- change password --}}
<div class="modal fade" id="changePass" tabindex="-1" aria-labelledby="passwordChange" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#changePassword') }}" method="POST" id="changePassword">
            <div class="modal-body pb-2">
                <button type="button" class="btn-close float-end mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h3 class="text-center">Change Password</h3>

                @csrf
                <div class="mt-3 old_gp">
                    <label for="oldPass">Old Password :</label>
                    <div class="d-flex position-relative">
                        <input type="password" class="form-control mt-1" name="oldPass" id="oldPass" placeholder="Old Password...">
                        <i class="material-icons seeic" id="oldic" onclick="changeType('oldPass','oldic')">visibility_off</i>
                    </div>
                </div>
                <div class="mt-3 new_gp">
                    <label for="newPass">New Password :</label>
                    <div class="position-relative">
                        <input type="password" class="form-control mt-1" name="newPass" id="newPass" placeholder="New Password...">
                        <i class="material-icons seeic" id="newic" onclick="changeType('newPass','newic')">visibility_off</i>
                    </div>
                </div>
                <div class="mt-3 con_gp">
                    <label for="confirmPass">Confirm Password :</label>
                    <div class="">
                        <input type="text" class="form-control mt-1" id="forShowConfirmPass" placeholder="Confirm Password..." autocomplete="off">
                        <input type="text" class="form-control" name="confirmPass" id="confirmPass" hidden>
                    </div>
                </div>
                <div class="mt-2 mb-2 float-end">
                    <button type="submit" class="btn btn-primary px-4" id="passwordSubmit">Save</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- edit photo --}}
  <div class="modal fade" id="changePhoto" tabindex="-1" aria-labelledby="photoChange" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="btn-close float-end mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
            <h3 class="text-center">Change Photo</h3>
            <div class="row mt-4">
                <div class="col-6" >
                    <img id="userImage1" style="width:100%;height:150px;cursor: pointer;object-fit:contain" src="@if(auth()->user()->image == null) {{asset('admin/defaultuserImage/download (1).png')}} @else {{ asset('storage/userImage/'.auth()->user()->image) }} @endif" alt="">
                </div>
                <div class="col-6">
                    <form method="post" action="{{ route('admin#accountPhoto') }}" enctype="multipart/form-data" class="dropzone" id="imageUpload">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
