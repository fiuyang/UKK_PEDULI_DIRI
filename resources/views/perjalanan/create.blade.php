@extends('layouts.main')
@section('title','Isi Data')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success alert-block" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong class="success-msg"></strong>
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form action="">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" name="tanggal" id="tanggal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <input type="time" class="form-control" name="jam" id="jam">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Yang Dikunjungi</label>
                        <textarea class="form-control" id="lokasi" name="lokasi" style="height:150px"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="suhu_tubuh">Suhu Tubuh</label>
                        <input type="float" class="form-control" name="suhu_tubuh" id="suhu_tubuh">
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger link-button" data-href="{{ route('perjalanan.index')}}">Kembali</button>
                        <button class="btn btn-primary" id="btn-submit" value="create">Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".link-button").click(function () {
        window.location.href = $(this).data('href');
    });

    $(document).ready(function () {
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            startDate: moment(),
            locale: {
                format: 'YYYY-MM-DD',
            }
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $("#btn-submit").click(function(e){
            e.preventDefault();
            var _url = "{{ route('perjalanan.store') }}";
            var tanggal = $("#tanggal").val();
            var jam = $("#jam").val();
            var lokasi = $("#lokasi").val();
            var suhu_tubuh = $("#suhu_tubuh").val();
    
            $.ajax({
                url: _url,
                async: false,
                type:'POST',
                data: {
                    tanggal:tanggal,
                    jam:jam,
                    lokasi:lokasi,
                    suhu_tubuh:suhu_tubuh
                },
                success: function(data) {
                    console.log(data);
                    if($.isEmptyObject(data.error)){
                        $('#success_message').fadeIn().html(data.success);
                        setTimeout(function(){
                            $('#success_message').fadeOut("slow");
                        }, 2000);
                        window.location.assign = "{{ route('perjalanan.index') }}";
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
        }); 

        
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });
</script>    
@endsection