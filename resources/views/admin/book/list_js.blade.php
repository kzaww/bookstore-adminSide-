<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });
        //search btn activate
        $('#bookSearch').focus(function(){
            $('#search_ic').css({'color':'rgb(0,0,0)','pointer-events':'auto'});
            //if autocomplete is hide function (go to bottom section u will see why)
            if($("#autocomplete").hide()){
                $("#autocomplete").show();
            }
        })

        $('#bookSearch').blur(function(){
            $search = $(this).val();
            //if input is not empty then search button is enable
            if($search.length > 0){
                $('#search_ic').css({'color':'rgb(0,0,0)','pointer-events':'auto'});
            }else{
                $('#search_ic').css({'color':'rgb(0,0,0,0.2)','pointer-events':'none'});
            }
        })

        //select box
        //create
        $('#genre').click(function(){
            $('#gen_info').toggleClass('show');
            if($('#gen_info').hasClass('show')){
                $('#search_gen').focus();
            }
        })

        $('#author').click(function(){
            $('#author_info').toggleClass('show');
            if($('#author_info').hasClass('show')){
                $('#search_author').focus();
            }
        })

        //edit
        $('#u_genre').click(function(){
            $('#u_gen_info').toggleClass('show');
            if($('#u_gen_info').hasClass('show')){
                $('#u_search_gen').focus();
            }
        })

        $('#u_author').click(function(){
            $('#u_author_info').toggleClass('show');
            if($('#u_author_info').hasClass('show')){
                $('#u_search_author').focus();
            }
        })

        //end select box

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
        //create image preview
        $(document).on('change','#book_photo',function(e){
            readUrl(this,'#preview');
            $('#preview').css('height','200px');
        });

        //update image preview
        $(document).on('change','#u_book_photo',function(e){
            if($('#new_image')){
                $('#new_image').remove();
            }
            readUrl(this,'#up_preview');
            $label = '<label id="new_image" class="d-block">New Image:</label>';
            $('.up_preview_container').prepend($label);
            $('#up_preview').css('max-width','100%');
            $('#up_preview').css('height','195px');
        })

        //enter event

        //enter at create
        $(document).on('keypress','#photo_click',function(e){
            if(e.keyCode === 13){
                e.preventDefault();
                $('#book_photo').click();
            }

        })

        //enter at update
        $(document).on('keypress','#u_photo_click',function(e){
            if(e.keyCode === 13){
                e.preventDefault();
                $('#u_book_photo').click();
            }

        })



        //gen_serach ajax
        $('#search_gen').keyup(function(){
            $val = $(this).val();

            $.ajax({
                url:'{{ route('admin#gen_search') }}',
                type:'get',
                data:{'data':$val},
                success:function(res){
                    if(res.status == 'success'){
                        $('.gen_items').html(res.data);
                    }
                }
            })
        })


        //u_gen_serach ajax
        $('#u_search_gen').keyup(function(){
            $val = $(this).val();

            $.ajax({
                url:'{{ route('admin#gen_search') }}',
                type:'get',
                data:{'data':$val},
                success:function(res){
                    if(res.status == 'success'){
                        $('.u_gen_items').html(res.data);
                    }
                }
            })
        })

        //author search ajax
        $('#search_author').keyup(function(){
            $val = $(this).val();

            $.ajax({
                url:'{{ route('admin#author_search') }}',
                type:'get',
                data:{'data':$val},
                success:function(res){
                    if(res.status == 'success'){
                        $('.author_items').html(res.data);
                    }
                }
            })
        })

        //update author search ajax
        $('#u_search_author').keyup(function(){
            $val = $(this).val();

            $.ajax({
                url:'{{ route('admin#author_search') }}',
                type:'get',
                data:{'data':$val},
                success:function(res){
                    if(res.status == 'success'){
                        $('.u_author_items').html(res.data);
                    }
                }
            })
        })

        //gen_item on click
        $(document).on('click','.gen_items_data',function(){
            $text = $(this).text();
            $id = $(this).data('id');
            $('#genre').text($text);
            $('#genre').attr('data-id',$id);
            $('#search_gen').val('');
            $('#gen_info').removeClass('show');
        })

        //u_gen_item on click
        $(document).on('click','.u_gen_items_data',function(){
            $text = $(this).text();
            $id = $(this).data('id');
            $('#u_genre').text($text);
            $('#u_genre').attr('data-id',$id);
            $('#u_search_gen').val('');
            $('#u_gen_info').removeClass('show');
        })


        //author_item on click
        $(document).on('click','.author_items_data',function(){
            $text = $(this).text();
            $id = $(this).data('id');
            $('#author').text($text);
            $('#author').attr('data-id',$id);
            $('#search_author').val('');
            $('#author_info').removeClass('show');
        })

        //u_author_item on click
        $(document).on('click','.u_author_items_data',function(){
            $text = $(this).text();
            $id = $(this).data('id');
            $('#u_author').text($text);
            $('#u_author').attr('data-id',$id);
            $('#u_search_author').val('');
            $('#u_author_info').removeClass('show');
        })

        //create btn click
        $('#create').click(function(){
            $('#preview').attr('src','');
            $('#bookCreate')[0].reset();
            $('#genre').text('');
            $('#genre').removeAttr('data-id');
            $('.author_gp #author').text('');
            $('.author_gp #author').removeAttr('data-id');

            $('#name').removeClass(['is-invalid','is-valid']);
            $('#description').removeClass(['is-invalid','is-valid']);
            $('#price').removeClass(['is-invalid','is-valid']);
            $('#genre').removeClass(['is-invalid','is-valid']);
            $('#author').removeClass(['is-invalid','is-valid']);
            $('#photo_click').removeClass(['text-danger','text-success']);
        })

        //delete btn click
        $(document).on('click',".btn_delete",function(){
            $id = $(this).data('id');
            $('.book_id').val($id);
        })

        //edit btn click
        $(document).on('click',".btn_edit",function(){
            $('#bookUpdateBtn').text('Update');

            $('#BookUpdate')[0].reset();
            if($('#new_image')){
                $('#new_image').remove();
            }
            $('#up_preview').attr('src','');
            $('#old_image').attr('src','');
            $('#u_author_info').removeClass('show');
            $('#u_gen_info').removeClass('show');

            $('#u_name').removeClass(['is-invalid','is-valid']);
            $('#u_description').removeClass(['is-invalid','is-valid']);
            $('#u_price').removeClass(['is-invalid','is-valid']);
            $('#u_genre').removeClass(['is-invalid','is-valid']);
            $('#u_author').removeClass(['is-invalid','is-valid']);
            $('#u_photo_click').removeClass(['text-danger','text-success']);


            $id = $(this).data('id');
            $name = $(this).data('name');
            $image = $(this).data('image');
            $gen = $(this).data('genre');
            $gen_id = $(this).data('genre_id');
            $author_id = $(this).data('author_id');
            $author = $(this).data('author');
            $price = $(this).data('price');
            $des = $(this).data('des');
            $path='http://127.0.0.1:8000/storage/book_images/'+$image;


            $('#u_book_id').val($id);
            $('#u_name').val($name);
            $('#old_image').attr('src',$path);
            $('#u_genre').text($gen);
            $('#u_genre').attr('data-id',$gen_id);
            $('#u_author').attr('data-id',$author_id);
            $('#u_author').text($author);
            $('#u_price').val($price);
            $('#u_description').text($des);
        })

        //create event
        $('#bookCreate').submit(function(e){
            e.preventDefault();

            $('#bookCreateBtn').text('loading...');

            $url = $(this).attr('action');
            $type = $(this).attr('method');
            $data = new FormData(this);
            $gen = $('#genre').data('id') ?? "";
            $author = $('#author').data('id') ?? "";
            if($gen != ''){
                $data.append('gen',parseInt($gen));
            }
            if($author != ''){
                $data.append('author',parseInt($author));
            }

            $.ajax({
                url : $url,
                type : $type,
                data : $data,
                contentType:false,
                processData:false,
                success:function(res){
                    $('#name').removeClass(['is-invalid','is-valid']);
                    $('#description').removeClass(['is-invalid','is-valid']);
                    $('#price').removeClass(['is-invalid','is-valid']);
                    $('#genre').removeClass(['is-invalid','is-valid']);
                    $('#author').removeClass(['is-invalid','is-valid']);
                    $('#photo_click').removeClass(['text-danger','text-success']);

                    $('.error_msg').remove();
                    if(res.errors){
                        if(res.errors.name){
                            $('#name').addClass('is-invalid');
                            $('.name_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.name }</small>
                            `);
                        }else{
                            $('#name').addClass('is-valid');
                        }
                        if(res.errors.price){
                            $('#price').addClass('is-invalid');
                            $('.price_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.price }</small>
                            `);
                        }else{
                            $('#price').addClass('is-valid');
                        }
                        if(res.errors.description){
                            $('#description').addClass('is-invalid');
                            $('.des_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.description }</small>
                            `);
                        }else{
                            $('#description').addClass('is-valid');
                        }
                        if(res.errors.gen){
                            $('#genre').addClass('is-invalid');
                            $('.gen_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.gen }</small>
                            `);
                        }else{
                            $('#genre').addClass('is-valid');
                        }
                        if(res.errors.author){
                            $('#author').addClass('is-invalid');
                            $('.author_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.author }</small>
                            `);
                        }else{
                            $('#author').addClass('is-valid');
                        }
                        if(res.errors.photo){
                            $('#photo_click').addClass('text-danger');
                            $('.photo_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.photo }</small>
                            `);
                        }else{
                            $('#photo_click').addClass('text-success');
                        }
                    }

                    if(res.status == 'success')
                    {
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Updated</span></div>
                        `);
                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);
                        $('#bookCreateBtn').text('Create');
                        $('#createBook').modal('hide');
                        $('#bookTotal').load(location.href+' #bookTotal');
                        $('.list_data').load(location.href+' .list_data'); //reload only table
                    }
                }
            })
        })

        //end create event

        //delete event
        $('#bookDelete').submit(function(e){
            e.preventDefault();
            $url = $(this).attr('action');
            $type = $(this).attr('method');
            $data = $(this).serialize();

            $.ajax({
                url : $url,
                type : $type,
                data : $data,
                success : function(res){
                    if(res.status == 'success'){
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Deleted</span></div>
                        `);

                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);

                        $('#deleteBook').modal('hide');
                        $('#bookTotal').load(location.href+' #bookTotal');
                        $('.list_data').load(location.href+' .list_data'); //reload only table
                    }
                }
            })
        })

        //end delete event

        //edit event
        $('#BookUpdate').submit(function(e){
            e.preventDefault();

            $('#bookUpdateBtn').text('loading...');

            $url = $(this).attr('action');
            $type = $(this).attr('method');
            $data = new FormData(this);
            $gen = $('#u_genre').data('id') ?? '';
            $author = $('#u_author').data('id') ?? '';
            if($gen != ''){
                $data.append('u_gen',parseInt($gen));
            }
            if($author != ''){
                $data.append('u_author',parseInt($author));
            }

            $.ajax({
                url : $url,
                type : $type,
                data : $data,
                contentType:false,
                processData:false,
                success:function(res){
                    $('#bookUpdateBtn').text('Update');
                    $('.error_msg').remove();

                    $('#u_name').removeClass('is-invalid is-valid');
                    $('#u_description').removeClass('is-invalid is-valid');
                    $('#u_price').removeClass('is-invalid is-valid');
                    $('#u_genre').removeClass('is-invalid is-valid');
                    $('#u_author').removeClass('is-invalid is-valid');
                    $('#u_photo_click').removeClass('text-danger text-success');
                    if(res.errors){
                        if(res.errors.u_name){
                            $('#u_name').addClass('is-invalid');
                            $('.u_name_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.u_name }</small>
                            `);
                        }else{
                            $('#u_name').addClass('is-valid');
                        }
                        if(res.errors.u_price){
                            $('#u_price').addClass('is-invalid');
                            $('.u_price_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.u_price }</small>
                            `);
                        }else{
                            $('#u_price').addClass('is-valid');
                        }
                        if(res.errors.u_description){
                            $('#u_description').addClass('is-invalid');
                            $('.u_des_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.u_description }</small>
                            `);
                        }else{
                            $('#u_description').addClass('is-valid');
                        }
                        if(res.errors.u_gen){
                            $('#u_genre').addClass('is-invalid');
                            $('.u_gen_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.u_gen }</small>
                            `);
                        }else{
                            $('#u_genre').addClass('is-valid');
                        }
                        if(res.errors.u_author){
                            $('#u_author').addClass('is-invalid');
                            $('.u_author_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.u_author }</small>
                            `);
                        }else{
                            $('#u_author').addClass('is-valid');
                        }
                        if(res.errors.u_photo){
                            $('#u_photo_click').addClass('text-danger');
                            $('.u_photo_gp').append(`
                            <small class="invalid-feedback error_msg">${ res.errors.u_photo }</small>
                            `);
                        }else{
                            $('#u_photo_click').addClass('text-success');
                        }
                    }
                    if(res.status == 'success'){
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Updated</span></div>
                        `);

                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);

                        $('#editBook').modal('hide');
                        $('#bookTotal').load(location.href+' #bookTotal');
                        $('.list_data').load(location.href+' .list_data'); //reload only table
                    }
                }
            })
        })

        $current = -1;
        //search event
        $('#bookSearch').keyup(function(e){
            e.preventDefault();
            $val = $(this).val();

            if((e.keyCode != 40) && (e.keyCode !=13) && e.keyCode !=38 && e.keyCode !=27){
                $(this).attr('data-val',$val);
                $.ajax({
                    url : '{{ route('admin#book_auto') }}',
                    type : 'get',
                    data : {'data':$val},
                    success: function(res){
                        // $all = res.auto;
                        // console.log(typeof($all));
                        $('#autocomplete').remove();
                        $ul = '<ul class="list-unstyled" id="autocomplete" style="">'
                        if(res.auto){
                            $ul +=res.auto;
                            $ul +='</ul>';
                            $('.searchbox1').append($ul);
                        }

                    }
                })
            }

            $li = $('#autocomplete').find('.auto_list');

            //key navigation
            if(e.keyCode === 13){ //enter
                e.preventDefault();
                $('#search_ic').click();
            }else if(e.keyCode === 40){ //down arrow
                $current ++;
                active($li);

            }else if(e.keyCode === 38){ //up arrow
                $current --;
                active($li);
            }else if(e.keyCode === 27){ //escape key
                $old = $(this).data('val');
                $('#bookSearch').val($old);
                $("#autocomplete").remove();
            }
        })

        //add active function
        function active(li){
            if(!li) return;
            remove(li);
            if($current>li.length-1) $current=0;
            if($current < 0) $current = li.length-1;
            li[$current].classList.add('active');
            $val = $.trim(li[$current].innerText);
            $('#bookSearch').val($val);
        }

        //remove active function
        function remove(li){
            for (var i = 0; i < li.length; i++) {
              li[i].classList.remove("active");
            }
        }


        //autocomplete onclick
        $(document).on('click','.auto_list',function(){
            $val = $.trim($(this).text());
            $('#bookSearch').val($val);
            $('#bookSearch').focus();
            $("#autocomplete").remove();
        })

        // search btn click event
        $('#search_ic').click(function(e){
            e.preventDefault();
            $val = $('#bookSearch').val();
            $token = $('input[name="_token"]').val();

            //data
            $.ajax({
                url: '{{ route('admin#bookSearch') }}',
                method: 'POST',
                data:{'data' : $val,'token' : $token},
                success:function(res){
                    $('.list_data').html(res);
                }
            })

            //total
            $.ajax({
                url: '{{ route('admin#bookTotal') }}',
                method: 'POST',
                data:{'data' : $val,'token' : $token},
                success:function(res){
                    $('#total').text(res.data);
                }
            })
        })

    })
    // autocomplete off if u click not target event
    document.addEventListener('click',e=>{

        if(e.target.closest('[data-autocomplete]') != null){
            return
        }else{
            $("#autocomplete").hide();
        }
    })
</script>
