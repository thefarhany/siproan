@extends('layouts.siwas')

@section('title')
<title>SIWAS | Data Pekerjaan</title>
@endsection

@section('content')
<h2 class="mb-4 pt-2">Data Pekerjaan</h2>

<div class="card mt-3">
  <div class="card-header">
    <a href="#" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#add-pekerjaan">Tambah Data</a>
  </div>

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="add-pekerjaan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Tambah Data Rehab</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('add-pekerjaan') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-6">
                <label for="kotama">Kotama/Kesatuan</label>
                <select class="form-control" id="kotama" name="kotama">
                  <option value="Zidam IV">Zidam IV</option>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="pembayaran">Pembayaran</label>
                <select class="form-control" id="pembayaran" name="pembayaran">
                  <option value="Reguler">Reguler</option>
                  <option value="Swakelola">Swakelola</option>
                  <option value="SBSN">SBSN</option>
                  <option value="Hibah">Hibah</option>
                  <option value="BLU">BLU</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="nama_pekerjaan">Nama Pekerjaan</label>
              <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" placeholder="Nama Pekerjaan">
            </div>
            <div class="form-group">
              <label for="no_tgl_spmk">Nomor/Tanggal/SPMK</label>
              <input type="text" class="form-control" id="no_tgl_spmk" name="no_tgl_spmk" placeholder="Nomor/Tanggal/SPMK">
            </div>
            <div class="form-group">
              <label for="nilai_kontrak">Nilai Kontrak</label>
              <input type="text" class="form-control" id="nilai_kontrak" name="nilai_kontrak" placeholder="Nilai Kontrak">
            </div>
            <div class="form-group">
              <label for="penyedia_jasa">Penyedia Jasa</label>
              <input type="text" class="form-control" id="penyedia_jasa" name="penyedia_jasa" placeholder="Penyedia Jasa">
            </div>
            <div class="form-group">
              <label for="tanggal_mulai">Tanggal Mulai</label>
              <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="Tanggal Mulai">
            </div>
            <div class="form-group">
              <label for="tanggal_selesai">Tanggal Selesai</label>
              <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" placeholder="Tanggal Selesai">
            </div>
            <div class="form-group">
              <label for="daya_serap">Daya Serap</label>
              <input type="number" step="0.01" class="form-control" id="daya_serap" name="daya_serap" placeholder="Daya Serap">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Tambah Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah Data -->

  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Nama Kegiatan</th>
          <th>Nomor/Tanggal/SPMK</th>
          <th>Nilai Kontrak</th>
          <th>Status Rehab</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="text-center">
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d->nama_pekerjaan }}</td>
          <td>{{ $d->no_tgl_spmk }}</td>
          <td>{{ $d->nilai_kontrak }}</td>
          <td><span class="badge bg-warning">{{ $d->lapju_ril }} %</span></td>
          <td class="align-middle">
            <a href="{{ route('find-pekerjaan', ['id' => $d->id]) }}" class="mr-2" data-toggle="modal" data-target="#edit-pekerjaan{{ $d->id }}"><i class="far fa-edit"></i></a>
            <a href="{{ route('find-pekerjaan', ['id' => $d->id]) }}" data-toggle="modal" data-target="#hapus-pekerjaan{{ $d->id }}"><i class=" far fa-trash-alt"></i></a>
          </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit-pekerjaan{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>Edit Data Pekerjaan</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('edit-pekerjaan', ['id' => $d->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                  <div class="form-group">
                    <label for="kotama">Kotama</label>
                    <input type="text" class="form-control" id="kotama" name="kotama" value="{{ $d->kotama }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nama_pekerjaan">Nama Pekerjaan</label>
                    <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" value="{{ $d->nama_pekerjaan }}">
                  </div>
                  <div class="form-group">
                    <label for="no_tgl_spmk">Nomor/Tanggal/SPMK</label>
                    <input type="text" class="form-control" id="no_tgl_spmk" name="no_tgl_spmk" value="{{ $d->no_tgl_spmk }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nilai_kontrak">Nilai Kontrak</label>
                    <input type="text" class="form-control" id="nilai_kontrak" name="nilai_kontrak" value="{{ $d->nilai_kontrak }}" placeholder="Nilai Kontrak">
                  </div>
                  <div class="form-group">
                    <label for="daya_serap">Daya Serap</label>
                    <input type="number" step="0.01" class="form-control" id="daya_serap" name="daya_serap" value="{{ $d->daya_serap }}" placeholder="Status Rehab">
                  </div>
                  <div class="form-group">
                    <label for="lapju_rencana">Lapju Rencana</label>
                    <input type="number" step="0.01" class="form-control" id="lapju_rencana" name="lapju_rencana" value="{{ $d->lapju_rencana }}">
                  </div>
                  <div class="form-group">
                    <label for="lapju_ril">Lapju Ril</label>
                    <input type="number" step="0.01" class="form-control" id="lapju_ril" name="lapju_ril" value="{{ $d->lapju_ril }}">
                  </div>
                  <div class="form-group">
                    <label for="lapju_deviasi">Lapju Deviasi</label>
                    <input type="number" step="0.01" class="form-control" id="lapju_deviasi" name="lapju_deviasi" value="{{ $d->lapju_deviasi }}">
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
        <!-- End Modal Edit -->

        <!-- Modal Delete -->
        <div class="modal fade" id="hapus-pekerjaan{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Hapus Data Pekerjaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin Akan Hapus <b>{{ $d->nama_pekerjaan }}</b> ?</p>
              </div>
              <div class="modal-footer">
                <form action="{{ route('delete-pekerjaan', ['id' => $d->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-default float-left" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal Delete -->

        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection