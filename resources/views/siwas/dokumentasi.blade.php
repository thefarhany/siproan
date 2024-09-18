@extends('layouts.siwas')

@section('title')
<title>SIWAS | Dokumentasi</title>
@endsection

@section('content')
<h3 class="mb-4 pt-2 font-weight-bold">Dokumentasi</h3>

<div class="card mt-3">
  <div class="card-header">
    <a href="{{ route('export-pdf') }}" class="btn btn-sm btn-primary float-right">Export Data</a>
  </div>

  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Nama Program/Kegiatan/Uraian</th>
          <th>Kondisi Awal</th>
          <th>Kondisi Akhir</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration }}</td>
          <td class="align-middle">{{ $d->nama_pekerjaan }}</td>
          <td class="align-middle">
            @if(!$d->img_awal)
            <span class="badge bg-warning">Gambar Belum Diunggah</span>
            @else
            <img src="{{ asset('storage/' . $d->img_awal) }}" alt="Gambar Kondisi Awal" class="img-fluid" style="max-width: 180px; max-height: 180px;">
            @endif
          </td>
          <td class="align-middle">
            @if(!$d->img_akhir)
            <span class="badge bg-warning">Gambar Belum Diunggah</span>
            @else
            <img src="{{ asset('storage/' . $d->img_akhir) }}" alt="Gambar Kondisi Awal" class="img-fluid" style="max-width: 180px; max-height: 180px;">
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection