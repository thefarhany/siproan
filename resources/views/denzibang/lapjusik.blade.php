@extends('layouts.denzibang')

@section('title')
<title>DENZIBANG | Lapjusik</title>
@endsection

@section('content')
<h3 class="mb-4 pt-3 font-weight-bold">Laporan Kemajuan Fisik</h3>

<div class="card mt-3">
  <div class="card-header">
    <h3 class="card-title">Lapjusik</h3>
  </div>

  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-center">
          <th class="align-middle" width="2">No</th>
          <th class="align-middle" width="3">No/Tanggal/SPMK</th>
          <th class="align-middle" width="6">Nama Pekerjaan</th>
          <th class="align-middle" width="2">Laporan Rencana</th>
          <th class="align-middle" width="2">Laporan Ril</th>
          <th class="align-middle" width="2">Laporan Deviasi</th>
          <th class="align-middle" width="2">Terakhir Update</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}} </td>
          <td class="align-middle">{{ $d->no_tgl_spmk}} </td>
          <td class="align-middle">{{ $d->nama_pekerjaan}} </td>
          <td class="align-middle">{{ $d->lapju_rencana}} %</td>
          <td class="align-middle">{{ $d->lapju_ril}} %</td>
          <td class="align-middle">{{ $d->lapju_deviasi}} %</td>
          <td class="align-middle">{{ $d->updated_at->format('d M Y H:i:s') }} </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
  <!-- /.card-body -->
</div>
@endsection