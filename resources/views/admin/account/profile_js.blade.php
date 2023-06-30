<script>
        Dropzone.autoDiscover = false;

$(document).ready(function(){
    var dropzone = new Dropzone('#imageUpload', {
      thumbnailWidth: 200,
      maxFilesize: 1,
      maxFile:1,
      init: function() {
      this.on('addedfile', function(file) {
        if (this.files.length > 1) {
          this.removeFile(this.files[0]);
        }
      });
      this.on("complete", function(file) {
           this.removeAllFiles(true);
        });
    },
    timeout: 5000,
    acceptedFiles: ".png,.jpg,.jpeg,.webg",
    success:function(file,res){
        if(res.status == 'success'){
            $image = `http://127.0.0.1:8000/storage/userImage/${res.data}`;
            console.log($image);
            $('#changePhoto').modal('hide');
            $('#userImage').attr('src',$image);
            $('#userImage1').attr('src',$image);
            $('#userImage2').attr('src',$image);

            Swal.fire(
              'Success!',
              'success'
            )
        }
    }
    //   addRemoveLinks: true
    });

    //edit btn click
    $("#edit").click(function(e){
        $('#updateProfile')[0].reset();

        $('#update').text('Update');
        $('.error_msg').remove();

        $('#u_name').removeClass('is-invalid is-valid');
        $('#u_email').removeClass('is-invalid is-valid');
        $('#u_phone').removeClass('is-invalid is-valid');
        $('#u_address').removeClass('is-invalid is-valid');
    })

    // Edit profile
    $('#updateProfile').submit(function(e){
        e.preventDefault();

        $('#update').text('loading');
        $url = $(this).attr('action');
        $type = $(this).attr('method');
        $data = new FormData(this); //FormData use yin processData: false, contentType:false is necessory
        $.ajax({
            url: $url,
            type: $type,
            data: $data,
            processData: false,
            contentType: false,
            success:function(res){
                $('#update').text('Update');
                $('.error_msg').remove();

                $('#u_name').removeClass('is-invalid is-valid');
                $('#u_email').removeClass('is-invalid is-valid');
                $('#u_phone').removeClass('is-invalid is-valid');
                $('#u_address').removeClass('is-invalid is-valid');

                if(res.errors){
                    if(res.errors.name){
                        $('#u_name').addClass('is-invalid');
                        $('.name_gp').append(`
                        <small class="invalid-feedback error_msg">${ res.errors.name }</small>
                        `);
                    }else{
                        $('#u_name').addClass('is-valid');
                    }

                    if(res.errors.email){
                        $('#u_email').addClass('is-invalid');
                        $('.email_gp').append(`
                        <small class="invalid-feedback error_msg">${ res.errors.email }</small>
                        `);
                    }else{
                        $('#u_email').addClass('is-valid');
                    }

                    if(res.errors.phone){
                        $('#u_phone').addClass('is-invalid');
                        $('.phone_gp').append(`
                        <small class="invalid-feedback error_msg">${ res.errors.phone }</small>
                        `);
                    }else{
                        $('#u_phone').addClass('is-valid');
                    }

                    if(res.errors.address){
                        $('#u_address').addClass('is-invalid');
                        $('.address_gp').append(`
                        <small class="invalid-feedback error_msg">${ res.errors.address }</small>
                        `);
                    }else{
                        $('#u_address').addClass('is-valid');
                    }

                    if(res.errors.gender){
                        $('.gender_gp').append(`
                        <small class="invalid-feedback error_msg">${ res.errors.gender }</small>
                        `);
                    }
                }

                if(res.status == 'success'){
                    Swal.fire(
                      'Success!',
                      'success'
                    );
                    $('#editProfile').modal('hide');
                    $('.profileInfo').load(location.href+' .profileInfo');
                }
            }
        })
    });

    $('#changePassword').submit(function(e){
        e.preventDefault();
        $('#passwordSubmit').text('loading...');
        $url = $(this).attr('action');
        $type = $(this).attr('method');
        $data = new FormData(this);
        // console.log($data);

        $.ajax({
            url : $url,
            type : $type,
            data : $data,
            processData : false,
            contentType : false,
            success : function(res){
                $('#passwordSubmit').text('Save');
                $('.error_msg').remove();

                if(res.errors){
                    if(res.errors.oldPass){
                        $('.old_gp').append(`
                        <small class="text-danger error_msg">${ res.errors.oldPass[0] }</small>
                        `);
                    }

                    if(res.errors.newPass){
                        $('.new_gp').append(`
                        <small class="text-danger error_msg">${ res.errors.newPass }</small>
                        `);
                    }
                    if(res.errors.confirmPass){
                        $('.con_gp').append(`
                        <small class="text-danger error_msg">${ res.errors.confirmPass }</small>
                        `);
                    }
                }

                if(res.status == 'success'){
                    $('#passwordSubmit').text('Save');
                    Swal.fire(
                      'Password Change Success!',
                      'success'
                    );
                    setTimeout(function(){
                        Swal.close();
                        location.reload(true);
                    },1000)

                }
            }
        })
    })

    //show last charactor in password
    $showLength = 1;
    $hideAll = setTimeout(function() {}, 0);
    $("#forShowConfirmPass").on("input", function() {
        var offset = $("#forShowConfirmPass").val().length - $("#confirmPass").val().length;
        if (offset > 0){   // while input offset = 1
            $("#confirmPass").val($("#confirmPass").val() + $("#forShowConfirmPass").val().substring($("#confirmPass").val().length, $("#confirmPass").val().length + offset));
            //to add last charactor of forshow pass to confirm pass
        }
        else if (offset < 0){ // while delete offset = -1
            $("#confirmPass").val($("#confirmPass").val().substring(0, $("#confirmPass").val().length + offset)); //to subtract last letter from password input not forshow password
        }

        // Change the visible string
        if ($(this).val().length > $showLength){  // to change charator to dot in forshow password and let the last charactor show
            $(this).val($(this).val().substring(0, $(this).val().length - $showLength).replace(/./g, "•") + $(this).val().substring($(this).val().length - $showLength, $(this).val().length));
        }

        // Set the timer
        clearTimeout($hideAll);  //clear timeout
        $hideAll = setTimeout(function() {  // reset timeout
          $("#forShowConfirmPass").val($("#forShowConfirmPass").val().replace(/./g, "•"));  //  /./g mean seperate every input eg input = hello ; input././g = h,e,l,l,o  and g mean global
        }, 1000);
      });
});

//click icon in change password
var pass = true;
function changeType(inputId,iconId){
var x= document.getElementById(inputId);
    if(pass){
        x.type = 'text';
        document.getElementById(iconId).innerText = 'visibility';
    }else{
        x.type = 'password';
        document.getElementById(iconId).innerText = 'visibility_off';
    }
    pass = !pass;
}
</script>