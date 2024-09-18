@extends('layouts.denzibang')

@section('title')
<title>DENZIBANG | Input Gambar</title>
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
          <th class="align-middle">No</th>
          <th class="align-middle">No/Tanggal/SPMK</th>
          <th class="align-middle">Nama Pekerjaan</th>
          <th class="align-middle">Kondisi Awal</th>
          <th class="align-middle">Kondisi Saat Ini</th>
          <th class="align-middle">Kondisi Akhir</th>
          <th class="align-middle">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}} </td>
          <td class="align-middle">{{ $d->no_tgl_spmk}} </td>
          <td class="align-middle">{{ $d->nama_pekerjaan}} </td>
          <td class="align-middle">
            @if(!$d->img_awal)
            <span class="badge bg-warning">Gambar Belum Diunggah</span>
            @else
            <img src="{{ asset('storage/' . $d->img_awal) }}" alt="Gambar Kondisi Awal" class="img-fluid" style="max-width: 180px; max-height: 180px;">
            @endif
          </td>
          <td class="align-middle">
            @if(!$d->img_awal)
            <span class="badge bg-warning">Gambar Belum Diunggah</span>
            @else
            <img src="{{ asset('storage/' . $d->img_progress) }}" alt="Gambar Kondisi Saat Ini" class="img-fluid" style="max-width: 180px; max-height: 180px;">
            @endif
          </td>
          <td class="align-middle">
            @if(!$d->img_awal)
            <span class="badge bg-warning">Gambar Belum Diunggah</span>
            @else
            <img src="{{ asset('storage/' . $d->img_akhir) }}" alt="Gambar Kondisi Akhir" class="img-fluid" style="max-width: 180px; max-height: 180px;">
            @endif
          </td>
          <td class="align-middle">
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#input-gambar{{ $d->id }}">Input Gambar</a>
          </td>
        </tr>

        <!-- Modal Upload Gambar -->
        <div class="modal fade" id="input-gambar{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>Input Gambar</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('add-gambar', ['id' => $d->id]) }}" method="POST" enctype="multipart/form-data">
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
                  <label>Upload Gambar</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="img_awal_{{ $d->id }}" name="img_awal" placeholder="Kondisi Awal">
                    <label class="custom-file-label" for="img_awal_{{ $d->id }}">
                      @if (!$d->img_awal)
                      Kondisi Awal
                      @else
                      {{ $d->img_awal }}
                      @endif
                    </label>
                  </div>
                  <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input" id="img_progress_{{ $d->id }}" name="img_progress" placeholder="Kondisi Saat Ini">
                    <label class="custom-file-label" for="img_progress_{{ $d->id }}">
                      @if (!$d->img_progress)
                      Kondisi Saat Ini
                      @else
                      {{ $d->img_progress }}
                      @endif
                    </label>
                  </div>
                  <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input" id="img_akhir_{{ $d->id }}" name="img_akhir" placeholder="Kondisi Akhir">
                    <label class="custom-file-label" for="img_akhir_{{ $d->id }}">
                      @if (!$d->img_akhir)
                      Kondisi Akhir
                      @else
                      {{ $d->img_akhir }}
                      @endif
                    </label>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Simpan Gambar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal Upload Gambar -->

        @endforeach
      </tbody>
    </table>

  </div>
  <!-- /.card-body -->
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua input file dengan class "custom-file-input"
    const fileInputs = document.querySelectorAll('.custom-file-input');

    // Iterasi setiap input file
    fileInputs.forEach(input => {
      // Tambahkan event listener untuk setiap input file
      input.addEventListener('change', function() {
        // Ambil label yang sesuai dengan input file saat ini
        const label = document.querySelector(`label[for='${input.id}']`);

        // Jika file dipilih, perbarui teks label dengan nama file
        if (input.files.length > 0) {
          label.innerText = input.files[0].name;
        }
      });
    });
  });
</script>
@endsection