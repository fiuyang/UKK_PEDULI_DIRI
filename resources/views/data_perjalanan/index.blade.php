@extends('layouts.main')
@section('title','Data Perjalanan')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="form-group">
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
            ajax: '{{ route('data-perjalanan.get') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'jam', name: 'jam'},
                {data: 'lokasi', name: 'lokasi'},
                {data: 'suhu_tubuh', name: 'suhu_tubuh'},
            ]
        });
    });
</script>
@endsection
