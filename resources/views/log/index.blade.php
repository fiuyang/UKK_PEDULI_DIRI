@extends('layouts.main')
@section('title','Log Activity')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="activities">
            @foreach ($logs as $log)
                @if(auth()->user()->id)
                    <div class="activity">
                        @switch($log->tipe)
                            @case('1')
                                <div class="activity-icon bg-primary text-white shadow-primary"><i class="fas fa-plus"></i></div>
                                @break

                            @case('2')
                                <div class="activity-icon bg-info text-white shadow-info"><i class="fas fa-edit"></i></div>
                                @break

                            @case('3')
                                <div class="activity-icon bg-danger text-white shadow-primary"><i class="fas fa-trash"></i></div>
                                @break
                        @endswitch
                        <div class="activity-detail">
                            <span class="text-job text-primary">
                                @php
                                    $logWaktu = \Carbon\Carbon::parse( $log->waktu );
                                    $now = \Carbon\Carbon::now();
                                @endphp
                                {{ $logWaktu->diffForHumans($now) }}
                            </span>
                                <button class="btn btn-danger float-right" data-id="{{ $log->id }}" data-action="{{ route('log.destroy',$log->id) }}" onclick="destroy({{$log->id}})">Hapus</button>
                            <p>{{ $log->users->username}}</p>
                            <p>{{ $log->aksi}}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>  
@endsection

@section('script')
    <script>
        function destroy(id) {
        swal.fire({
            title: 'Delete',
            text: 'Apakah anda yakin akan menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        }).then(function (e) {
            if (e.value === true) {
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type: 'DELETE',
                    url: "log/"+id,
                    data: {
                        _token: token
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                text: ""+response.message+"",
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            return location.reload();
                        } else {
                            swal.fire("Error!", 'Masih ada yang salah.', "error");
                        }
                    },
                    error: function (response) {
                        swal.fire("Error!", 'Masih ada yang salah.', "error");
                    }
                });
            } 
        })
    }
    </script>
@endsection