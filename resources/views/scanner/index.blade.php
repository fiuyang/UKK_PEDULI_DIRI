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
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group text-center">
                <h4>Masukkan Suhu Tubuh Anda</h4>
                <input type="number" name="suhu_tubuh" class="form-control" id="suhuTubuh">
                <div class="form-group mt-3">
                    <button type="button" class="btn btn-info mr-2" id="submitSuhu" onclick="submit_suhu()">Konfirmasi</button>
                    <button type="button" class="btn btn-danger" id="resetSuhu" onclick="reset_suhu()">Reset</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group text-center">
                <h4>Scan QR</h4>
                <div id="scannerContainer"></div>
            </div>
        </div>
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
        <input type="text" id="scanner" name="scanner" class="form-control" readonly="true">
    </form>
</div>

@endsection

@section('script')

<script type="text/javascript">
    var suhu_tubuh;
    var scanner;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function submit_suhu() {
        suhu_tubuh = $('#suhuTubuh').val();
        if (suhu_tubuh && suhu_tubuh != '') {
            $('#suhuTubuh').prop('readonly', true);
            var html = '<video id="preview" style="width:500px;" style="display:none;"></video>';
            $('#scannerContainer').html(html);
            scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: true });
            scanner.addListener('scan', function(content) {
                document.getElementById('scanner').value = content;

                $.ajax({
                    url: "{{ route('scanner.store') }}",
                    type:"POST",
                    data:{
                        "lokasi": content,
                        "suhu_tubuh": suhu_tubuh
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
                            Swal.fire({
                                text: ""+response.message+"",
                                icon: 'error',
                                title: 'Error',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
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
        } else {
            return false;
        }
    }

    function reset_suhu() {
        suhu_tubuh = false;
        $('#suhuTubuh').val('');
        $('#suhuTubuh').prop('readonly', false);
        scanner.stop();
        $('#scannerContainer').html('');
    }

</script>
@endsection
    