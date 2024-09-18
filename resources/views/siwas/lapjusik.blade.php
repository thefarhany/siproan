@extends('layouts.siwas')

@section('title')
<title>SIWAS | Lapjusik</title>
@endsection

@section('content')
<h3 class="mb-4 pt-2 font-weight-bold">Data Pekerjaan</h3>

<div class="card mt-3">
  <div class="card-header">
    <h3 class="card-title">Data Pekerjaan</h3>
  </div>

  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Nama Kegiatan</th>
          <th>Nomor/Tanggal/SPMK</th>
          <th>Lapju Rencana</th>
          <th>Lapju Ril</th>
          <th>Lapju Deviasi</th>
          <th>Bukti Gambar</th>
          <th>Terakhir Update</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="text-center">
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d->nama_pekerjaan }}</td>
          <td>{{ $d->no_tgl_spmk }}</td>
          <td>{{ $d->lapju_rencana }}</td>
          <td><span class="badge bg-warning">{{ $d->lapju_ril }} %</span></td>
          <td>{{ $d->lapju_deviasi }}</td>
          <td class="align-middle">
            <a href="{{ route('find-pekerjaan', ['id' => $d->id]) }}" data-toggle="modal" data-target="#show-image{{ $d->id }}">
              <i class="fas fa-image"></i>
            </a>
          </td>
          <td>{{ $d->updated_at->format('d M Y H:i:s') }}</td>
        </tr>

        <div class="modal fade" id="show-image{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>Data Rehab</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Data Table -->
                <form action="">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="no_tgl_spmk">Nomor/Tanggal/SPMK</label>
                      <input type="text" class="form-control" id="no_tgl_spmk" name="no_tgl_spmk" value="{{ $d->no_tgl_spmk }}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="kotama">Kotama/Kesatuan</label>
                      <input type="text" class="form-control" id="kotama" name="kotama" value="{{ $d->kotama }}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="tgl_mulai">Tanggal Mulai</label>
                      <input type="text" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{ $d->tgl_mulai }}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="img_awal">Gambar Kondisi Awal</label>
                      <img src="{{ asset('storage/' . $d->img_awal) }}" alt="Gambar Kondisi Awal" class="img-fluid">
                    </div>
                    <div class="form-group">
                      <label for="img_progress">Gambar Saat Ini</label>
                      <img src="{{ asset('storage/' . $d->img_progress) }}" alt="Gambar Saat Ini" class="img-fluid">
                    </div>
                    <div class="form-group">
                      <label for="img_akhir">Gambar Detail Pekerjaan</label>
                      <img src="{{ asset('storage/' . $d->img_akhir) }}" alt="Gambar Detail Pekerjaan" class="img-fluid">
                    </div>
                  </div>
                  <div class="modal-footer float-right justify-content-between">
                    <a href="{{ route('download-gambar', $d->id) }}" class="btn btn-primary">Unduh Semua Gambar</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection