@extends('layouts.main')
@section('title','Scan Perjalanan Anda')
@section('content')
<style>
    body {
        font-family: 'Nunito';
    }
</style>
<div class="container">
    <div class="alert alert-success d-none" id="message">
        <span id="response_message"></span>
    </div>
    <div class="row mt-5 justify-content-center">
        <video id="preview"></video>
    </div>
    <div class="text-center mt-5">
        <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
            <label class="btn btn-primary active mr-4">
                <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
            </label>
        </div>
    </div>
    <form name="scanner_form" method="post" id="scanner_form">
        @csrf
        <input type="text" id="scanner" name="scanner" class="form-control" style="height:150px" readonly="true">
    </form>
</div>

@endsection

@section('script')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });

    scanner.addListener('scan', function(content) {
            document.getElementById('scanner').value = content;

        $.ajax({
            url: "{{ route('scanner.store') }}", 
            type:"POST",
            data:{
                "scanner": content
            },
            success: function(response){
                if(response.message) {
                    Swal.fire({
                        text: ""+response.message+"",
                        icon: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return window.location.href = "{{ route('perjalanan.index') }}";
                } else {
                    swal.fire("Error!", 'Masih ada yang salah.', "error");
                }
            // $('#response_message').show();
                // $('#response_message').html(response.message);
                // $('#message').removeClass('d-none');
        
                // document.getElementById("scanner_form").reset();
                // setTimeout(function(){
                // $('#response_message').hide();
                // $('#message').hide();
                // },4000);
            },
        });
    });
    Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length>0){
            scanner.start(cameras[0]);
            $('[name="options"]').on('change',function(){
                if($(this).val()==1){
                    if(cameras[0]!=""){
                        scanner.start(cameras[0]);
                    }else{
                        alert('No Front camera found!');
                    }
                }else if($(this).val()==2){
                    if(cameras[1]!=""){
                        scanner.start(cameras[1]);
                    }else{
                        alert('No Back camera found!');
                    }
                }
            });
        }else{
            console.error('No cameras found.');
            alert('No cameras found.');
        }
    }).catch(function(e){
        console.error(e);
        alert(e);
    });

</script>
@endsection
    