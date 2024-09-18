@extends('layouts.denzibang')

@section('title')
<title>DENZIBANG | Input Lapjusik</title>
@endsection

@section('content')
<h3 class="mb-4 pt-3 font-weight-bold">Laporan Kemajuan Fisik</h3>

<div class="card mt-3">
  <div class="card-header">
    <h3 class="card-title">Lapjusik</h3>
  </div>

  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="text-center">
          <th class="align-middle" width="2">No</th>
          <th class="align-middle" width="3">No/Tanggal/SPMK</th>
          <th class="align-middle" width="6">Nama Pekerjaan</th>
          <th class="align-middle" width="2">Laporan Rencana</th>
          <th class="align-middle" width="2">Laporan Ril</th>
          <th class="align-middle" width="2">Laporan Deviasi</th>
          <th class="align-middle" width="2">Aksi</th>
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
          <td class="align-middle">
            <a href="{{ route('find-lapjusik', ['id' => $d->id]) }}" class="btn btn-sm btn-success" data-toggle="modal" data-target="#input-lapju{{ $d->id }}">Input Lapju</a>
          </td>
        </tr>

        <!-- Modal Input Data -->
        <div class="modal fade" id="input-lapju{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>Input Lapju</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('update-lapjusik', ['id' => $d->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                  <div class="form-group">
                    <label for="no_tgl_spmk">No/Tanggal/SPMK</label>
                    <input type="text" class="form-control" id="no_tgl_spmk" name="no_tgl_spmk" value="{{ $d->no_tgl_spmk }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nama_pekerjaan">Nama Pekerjaan</label>
                    <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" value="{{ $d->nama_pekerjaan }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="lapju_rencana">Lapju Rencana</label>
                    <input type="number" step="0.01" class="form-control" id="lapju_rencana" name="lapju_rencana" value="{{ $d->lapju_rencana }}">
                    <small><b>Dalam satuan persen(%)</b></small>
                  </div>
                  <div class="form-group">
                    <label for="lapju_ril">Lapju Ril</label>
                    <input type="number" step="0.01" class="form-control" id="lapju_ril" name="lapju_ril" value="{{ $d->lapju_ril }}">
                    <small><b>Dalam satuan persen(%)</b></small>
                  </div>
                  <div class="form-group">
                    <label for="lapju_deviasi">Lapju Deviasi</label>
                    <input type="number" step="0.01" class="form-control" id="lapju_deviasi" name="lapju_deviasi" value="{{ $d->lapju_deviasi }}">
                    <small><b>Dalam satuan persen(%)</b></small>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal Input Data -->

        @endforeach
      </tbody>
    </table>

  </div>
  <!-- /.card-body -->
</div>
@endsection