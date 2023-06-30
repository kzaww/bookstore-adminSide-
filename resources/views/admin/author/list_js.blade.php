<script>
    $(document).ready(function(){
        //image preview function

        function readUrl(input,id){
            if(input.files && input.files[0]){
                $reader = new FileReader();
                $reader.onload= function(e){
                    $(id).attr('src',$reader.result);
                }
                $reader.readAsDataURL(input.files[0]);
            }
        }
        //image preview
        $(document).on('change','#author_photo',function(e){
            readUrl(this,'#preview');
            $('#preview').css('height','200px');
        });

        //update image preview
        $(document).on('change','#up_author_photo',function(e){
            if($('#newimage')){
                $('#new_image').remove();
            }
            readUrl(this,'#up_preview');
            $label = '<label id="new_image">New Image:</label>';
            $('.up_preview_container').prepend($label);
            $('#up_preview').css('max-width','100%');
            $('#up_preview').css('height','195px');
        });

        //enter event
        $(document).on('keypress','#photo_click',function(e){
            if(e.key === 'Enter'){
                e.preventDefault();
                $('#author_photo').click();
            }

        })

        //create ajax
        $('#AuthorCreate').on('submit',function(e){
            e.preventDefault();
            $('#authorCreateSubmit').text('loading...');
            $url = $(this).attr('action');
            $type = $(this).attr('method');
            $data = new FormData(this);
            $.ajax({
                url:$url,
                type:$type,
                data:$data,
                contentType: false,
                processData: false,
                success:function(res){
                    $('#name').removeClass('is-invalid' || 'is-valid');
                    $('#bio').removeClass('is-invalid' || 'is-valid');
                    $('#photo_click').removeClass('text-danger' || 'text-success');

                    $('.error_msg').remove();
                    if(res.status=='fail'){
                        if(res.errors.name){
                            $('#name').addClass('is-invalid');
                            $('.name_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.name }</small>
                            `);
                        }else{
                            $('#name').addClass('is-valid');
                        }
                        if(res.errors.photo){
                            $('#photo_click').addClass('text-danger');
                            $('.photo_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.photo }</small>
                            `);
                        }else{
                            $('#photo_click').addClass('text-success');
                        }
                        if(res.errors.bio){
                            $('#bio').addClass('is-invalid');
                            $('.bio_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.bio }</small>
                            `);
                        }else{
                            $('#bio').addClass('is-valid');
                        }
                    }

                    if(res.status == 'success'){
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Added</span></div>
                        `);
                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);
                        $('#authorCreateSubmit').text('Create');
                        $('#createAuthor').modal('hide');
                        $('#AuthorCreate')[0].reset();
                        $('#preview').attr('src','');
                        $('#authorTotal').load(location.href+' #authorTotal');
                        $('.list_data').load(location.href+' .list_data'); //reload only table
                    }
                }
            })
        })

        //delete event
        $(document).on('click','.btn_delete',function(){
            $id = $(this).data('id');
            $('#author_id').val($id);
        })

        //delete ajax
        $('#authorDelete').submit(function(e){
            e.preventDefault();

            $url = $(this).attr('action');
            $type = $(this).attr('method');
            $data = $(this).serialize();

            $.ajax({
                url:$url,
                type:$type,
                data: $data,
                success:function(res){
                    if(res.status == 'success'){
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Deleted</span></div>
                        `);

                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);

                        $('#deleteAuthor').modal('hide');
                        $('#authorTotal').load(location.href+' #authorTotal');
                        $('.list_data').load(location.href+' .list_data'); //reload only table
                    }
                }
            })
        })

        //update event
        $(document).on('click','.btn_edit',function(){
            $('#AuthorUpdate')[0].reset();
            if($('#newimage')){
                $('#new_image').remove();
            }
            $('#up_preview').attr('src','');
            $id = $(this).data('id');
            $name = $(this).data('name');
            $bio = $(this).data('bio');
            $image = $(this).data('image');
            $path='http://127.0.0.1:8000/storage/author_images/'+$image;

            $('#up_author_id').val($id);
            $('#up_name').val($name);
            $('#old_image').attr('src',$path);
            $('#up_bio').text($bio);
        })

        //update ajax
        $('#AuthorUpdate').submit(function(e){
            e.preventDefault();
            $('#authorEditSubmit').text('loading...');
            $url =$(this).attr('action');
            $type =$(this).attr('method');
            $data = new FormData(this);

            $.ajax({
                url:$url,
                type:$type,
                data:$data,
                contentType:false,
                processData:false,
                success:function(res){
                    $('#up_name').removeClass('is-invalid' || 'is-valid');
                    $('#up_bio').removeClass('is-invalid' || 'is-valid');
                    $('#up_photo_click').removeClass('text-danger' || 'text-success');

                    $('.error_msg').remove();
                    if(res.errors){
                        if(res.status=='fail'){
                            if(res.errors.up_name){
                                $('#up_name').addClass('is-invalid');
                                $('.up_name_gp').append(`
                                <small class="invalid-feedback error_msg">${ res.errors.up_name }</small>
                                `);
                            }else{
                                $('#up_name').addClass('is-valid');
                            }
                            if(res.errors.up_photo){
                                $('#up_photo_click').addClass('text-danger');
                                $('.up_photo_gp').append(`
                                <small class="invalid-feedback error_msg">${ res.errors.up_photo }</small>
                                `);
                            }else{
                                $('#up_photo_click').addClass('text-success');
                            }
                            if(res.errors.up_bio){
                                $('#up_bio').addClass('is-invalid');
                                $('.up_bio_gp').append(`
                                <small class="invalid-feedback error_msg">${ res.errors.up_bio }</small>
                                `);
                            }else{
                                $('#up_bio').addClass('is-valid');
                            }
                        }
                    }

                    if(res.status == 'success'){
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Updated</span></div>
                        `);
                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);
                        $('#authorEditSubmit').text('Save changes');
                        $('#updateAuthor').modal('hide');
                        $('#AuthorCreate')[0].reset();
                        $('#authorTotal').load(location.href+' #authorTotal');
                        $('.list_data').load(location.href+' .list_data'); //reload only table
                    }
                }
            })
        })

        //search data
        $('#authorSearch').keyup(function(e){
            e.preventDefault();
            $val = $(this).val();

            $.ajax({
                url:'{{ route('admin#authorSearch') }}',
                type:'get',
                data:{'data':$val},
                success:function(res){
                    $('#autocomplete').html('');
                    $('.list_data_body').html(res.data);
                    $('#total').text(res.count);
                    if(res.auto){
                        $('.searchbox1').append(res.auto);
                    }
                }
            })
        })

        $(document).on('click','.auto_list',function(){
            $val = $(this).text();
            $('#authorSearch').val($val);
            $('#autocomplete').html('');
            $data = $('#authorSearch').val();
            $.ajax({
                url:'{{ route('admin#authorSearch') }}',
                type:'get',
                data:{'data':$val},
                success:function(res){
                    $('#autocomplete').remove();
                    $('.list_data_body').html(res.data);
                }
            })
        })
    })
</script>
