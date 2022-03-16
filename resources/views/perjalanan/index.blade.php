@extends('layouts.main')
@section('title','Catatan Perjalanan')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="form-group">
                    <button class="btn btn-primary btn-sm link-button" type="button" data-href="{{ route('perjalanan.create')}}">
                            Create 
                    </button>
                </div>
            </div>
            <div class="card-body">
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

    $(".link-button").on('click',function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.href = $(this).data('href');
    });

    $(document).ready(function() {
        // init datatable.
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
</script>
@endsection
