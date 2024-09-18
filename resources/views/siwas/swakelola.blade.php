@extends('layouts.siwas')

@section('title')
<title>SIWAS | SWAKELOLA</title>
@endsection

@section('content')
<h3 class="mb-4 pt-2 font-weight-bold">Data Pembayaran SWAKELOLA</h3>

<div class="card mt-3">
  <div class="card-header">
    <!-- <h3 class="card-title">Cetak Data</h3> -->
  </div>

  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle">No</th>
          <th class="align-middle">Nama Pekerjaan</th>
          <th class="align-middle">Nomor/Tanggal/SPMK</th>
          <th class="align-middle">Nilai Kontrak</th>
          <th class="align-middle">Penyedia Jasa</th>
          <th class="align-middle">Tanggal Mulai</th>
          <th class="align-middle">Tanggal Selesai</th>
          <th class="align-middle">Jumlah Hari</th>
          <th class="align-middle">Lapju Rencana</th>
          <th class="align-middle">Lapju Ril</th>
          <th class="align-middle">Lapju Deviasi</th>
          <th class="align-middle">Daya Serap</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration }}</td>
          <td class="align-middle">{{ $d->nama_pekerjaan }}</td>
          <td class="align-middle">{{ $d->no_tgl_spmk }}</td>
          <td class="align-middle">{{ $d->nilai_kontrak }}</td>
          <td class="align-middle">{{ $d->penyedia_jasa }}</td>
          <td class="align-middle">{{ date('d-m-Y', strtotime($d->tanggal_mulai)) }}</td>
          <td class="align-middle">{{ date('d-m-Y', strtotime($d->tanggal_selesai)) }}</td>
          <td class="align-middle">{{ $d->jumlah_hari }}</td>
          <td class="align-middle"><span class="badge bg-warning">{{ $d->lapju_rencana }} %</span></td>
          <td class="align-middle"><span class="badge bg-warning">{{ $d->lapju_ril }} %</span></td>
          <td class="align-middle"><span class="badge bg-warning">{{ $d->lapju_deviasi }} %</span></td>
          <td class="align-middle">{{ $d->daya_serap }} %</td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection