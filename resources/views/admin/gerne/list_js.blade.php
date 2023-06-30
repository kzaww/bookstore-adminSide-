
<script>
    $(document).ready(function(){
        $('#create').click(function(){
            $('#createGerne').modal('show');
        })

        $(document).on('click','.deleteShow',function(e){
            e.preventDefault();
            $genId = $(this).val();
            $('#gen_id').val($genId);

            $('#deleteGenre').modal('show');
        });

        $(document).on('click','.updateShow',function(e){
            e.preventDefault();
            $genId = $(this).data('id');
            $genName = $(this).data('name');
            $('#up_id').val($genId);
            $('#up_name').val($genName);


            $('#updateGerne').modal('show');
        });

        //create ajax
        $('#GerneCreate').submit(function(e){
            e.preventDefault();
            $('#genCreateBtn').text('loading...');
            $url = $(this).attr('action');
            $type = $(this).attr('method');
            $data =$('#GerneCreate').serialize();

            $.ajax({
                url:$url,
                type:$type,
                data: $data,
                success:function(res){
                    $('.error_msg').remove();
                    if(res.errors){
                        $('#name').addClass('is-invalid');
                        $('.name_gp').append(`
                            <small class="invalid-feedback error_msg">${res.errors.name}</small>
                        `);
                    }
                    if(res.status == 'success'){
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Added</span></div>
                        `);

                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);
                        $('#createGerne').modal('hide');
                        $('#genCreateBtn').text('Save changes');
                        $('#GerneCreate')[0].reset();
                        $('#name').removeClass('is-invalid');
                        $('#genreTotal').load(location.href+' #genreTotal');
                        $('.table').load(location.href+' .table'); //reload only table
                    }

                }
            })
        })

        //delete ajax
        $('#GerneDelete').submit(function(e){
            e.preventDefault();
            $url = $(this).attr('action');
            $type = $(this).attr('method');
            $data = $('#GerneDelete').serialize();
            $.ajax({
                type:$type,
                url:$url,
                data:$data,
                success:function(res){
                    $('.info').append(`
                    <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Deleted</span></div>
                    `);

                    setTimeout(() => {
                        $('.alert_info').remove();
                    }, 1000);
                    $('#deleteGenre').modal('hide');
                    $('#genreTotal').load(location.href+' #genreTotal');
                    $('.table').load(location.href+' .table'); //reload only table
                }
            })
        })

        //update ajax
        $(document).on('click','.up_gen',function(e){
            e.preventDefault();
            $('#genEditBtn').text('loading...');
            $url = '{{ route('admin#gerneUpdate') }}';
            $type = 'post';
            $data = $('#GerneUpdate').serialize();
            $.ajax({
                type:$type,
                url:$url,
                data:$data,
                success:function(res){
                    $('.error_msg').remove();
                    if(res.errors){
                        $('#up_name').addClass('is-invalid');
                        $('.up_name_gp').append(`
                            <small class="invalid-feedback error_msg">${res.errors.name}</small>
                        `);
                    }

                    if(res.status == 'success'){
                        $('.info').append(`
                        <div class="alert alert-success alert_info d-flex" style="margin-left: 30%;width:400px"><span style="font-size: 0.8rem;transform:translateY(-10px)">Successfully Updated</span></div>
                        `);

                        setTimeout(() => {
                            $('.alert_info').remove();
                        }, 1000);
                        $('#updateGerne').modal('hide');
                        $('#genEditBtn').text('Save changes');
                        $('#GerneUpdate')[0].reset();
                        $('.table').load(location.href+' .table'); //reload only table
                    }
                }
            })
        })

        //search
        $('#gerneSearch').keyup(function(e){
            e.preventDefault();
            $val = $(this).val();

            $.ajax({
                type: 'get',
                url:'{{ route('admin#gerneSearch') }}',
                data: {'data':$val},
                success:function(res){
                    $(".table_data").html(res.data)
                }
            })
        })
    })
</script>
