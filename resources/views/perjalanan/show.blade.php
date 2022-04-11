<table width="100%">
    <tr>
        <th width="200px"><h6>Tanggal</h6></th>
        <th class="text-left">{!! $perjalanan->tanggal !!}</th>
    </tr>
    <tr>
        <th width="200px"><h6>Jam</h6></th>
        <th class="text-left">{!! $perjalanan->jam !!}</th>
    </tr>
    <tr>
        <th width="200px"><h6>Lokasi</h6></th>
        <th class="text-left">{!! $perjalanan->lokasi !!}</th>
    </tr>
    <tr>
        <th width="200px"><h6>Latitude</h6></th>
        <th class="text-left">{!! $perjalanan->latitude !!}</th>
    </tr>
    <tr>
        <th width="200px"><h6>Longitude</h6></th>
        <th class="text-left">{!! $perjalanan->longitude !!}</th>
    </tr>
    <tr>
        <th width="200px"><h6>Suhu Tubuh</h6></th>
        <th class="text-left">{!! $perjalanan->suhu_tubuh !!}</th>
    </tr>
    {{-- <div class="row">
        <div class="col-md-9">
            <h6>Tanggal :</h6>
        </div>
        <div class="col-md-3">
            <p>{{ $perjalanan->tanggal }}</p>
        </div>
    </div> --}}
</table>