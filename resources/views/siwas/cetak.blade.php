@extends('layouts.siwas')

@section('title')
<title>SIWAS | Print Data</title>
@endsection

@section('content')
<h3 class="mb-4 pt-2 font-weight-bold">Cetak Data</h3>

<div class="card mt-3">
  <div class="card-header">
    <form class="d-flex flex-wrap mr-3" action="{{ route('filter-data') }}" method="GET">
      <div class="form-group mx-3">
        <label for="pembayaran">Jenis Pembayaran</label>
        <select class="custom-select custom-select" id="pembayaran" name="pembayaran">
          <option value="">Pilih Jenis Pembayaran</option>
          <option value="Reguler">Reguler</option>
          <option value="Swakelola">Swakelola</option>
          <option value="SBSN">SBSN</option>
          <option value="Hibah">Hibah</option>
          <option value="BLU">BLU</option>
        </select>
      </div>
      <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" class="form-control">
      </div>
      <div class="form-group mx-3">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" class="form-control">
      </div>
      <button style="height: 38px; margin-top: 31px;" type="submit" class="btn btn-primary">Filter</button>
      <a href="{{ route('print-data', ['pembayaran' => request('pembayaran'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" style="height: 38px; margin-top: 31px;" class="ml-3 btn btn-warning">Export</a>
    </form>
  </div>

  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle">No</th>
          <th class="align-middle">Nama Pekerjaan</th>
          <th class="align-middle">Pagu</th>
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
          <td class="align-middle">Rp {{ $d->pagu }}</td>
          <td class="align-middle">{{ $d->no_tgl_spmk }}</td>
          <td class="align-middle">Rp {{ $d->nilai_kontrak }}</td>
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