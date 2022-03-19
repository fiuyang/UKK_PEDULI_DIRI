@extends('layouts.main')
@section('title','Catatan Perjalanan')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="form-group">
                    @if(Auth::user()->level == 'admin')
                    <a href="{{ route('perjalanan.create') }}" class="btn btn-primary btn-sm">
                        Create 
                    </a>
                    @endif
                </div>
            </div>
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
                <div class="table-responsive">
                    <table id="table" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Lokasi </th>
                                <th>Suhu Tubuh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>

    setTimeout(function() {
        $('.alert').slideUp();
    }, 5000);

    $(document).ready(function() {
        dataTable = $('#table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            // pageLength: 5,
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: '{{ route('perjalanan.get') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'jam', name: 'jam'},
                {data: 'lokasi', name: 'lokasi'},
                {data: 'suhu_tubuh', name: 'suhu_tubuh'},
                {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });
    });

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
                    url: "perjalanan/"+id,
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
                            dataTable.ajax.reload();
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
