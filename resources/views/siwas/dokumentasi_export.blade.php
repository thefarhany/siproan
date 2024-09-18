<!DOCTYPE html>
<html>

<head>
  <title>Data Pekerjaan</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 10px;
      text-align: center;
    }
  </style>
</head>

<body>
  <h1>Data Pekerjaan</h1>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Program/Kegiatan/Uraian</th>
        <th>Kondisi Awal</th>
        <th>Kondisi Akhir</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d)

      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nama_pekerjaan }}</td>
        <td>
          @if(!$d->img_awal)
          Gambar Belum Diunggah
          @else
          @php
          $path = public_path('storage/' . $d->img_awal);
          if (file_exists($path)) {
          $type = pathinfo($path, PATHINFO_EXTENSION);
          $data = file_get_contents($path);
          $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
          }
          @endphp
          @if(isset($base64))
          <img src="{{ $base64 }}" alt="Kondisi Awal" style="max-width: 100px;">
          @else
          Gambar Tidak Tersedia
          @endif
          @endif
        </td>
        <td>
          @if(!$d->img_akhir)
          Gambar Belum Diunggah
          @else
          @php
          $path = public_path('storage/' . $d->img_akhir);
          if (file_exists($path)) {
          $type = pathinfo($path, PATHINFO_EXTENSION);
          $data = file_get_contents($path);
          $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
          }
          @endphp
          @if(isset($base64))
          <img src="{{ $base64 }}" alt="Kondisi Akhir" style="max-width: 100px;">
          @else
          Gambar Tidak Tersedia
          @endif
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>