@extends('layouts.main')
@section('title','Isi Data')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-inner--text">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('perjalanan.update', $perjalanan->id) }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="tanggal" id="tanggal" value="{{ old('tanggal',$perjalanan->tanggal) }}" readonly>
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
                            <input type="time" class="form-control" name="jam" id="jam" value="{{ date('H:i:s') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Yang Dikunjungi</label>
                        <textarea class="form-control" id="lokasi" name="lokasi" style="height:150px">{{ old('lokasi',$perjalanan->lokasi) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="suhu_tubuh">Suhu Tubuh</label>
                        <input type="float" class="form-control" name="suhu_tubuh" id="suhu_tubuh" value="{{ old('suhu_tubuh',$perjalanan->suhu_tubuh) }}">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('perjalanan.index') }}" class="btn btn-danger" button="submit">Kembali</a>
                        <button class="btn btn-primary" type="submit">Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    $(document).ready(function () {
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            startDate: moment(),
            locale: {
                format: 'YYYY-MM-DD',
            }
        });
    });

</script>    
@endsection