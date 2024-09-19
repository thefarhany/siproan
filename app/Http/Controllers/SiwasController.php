<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use App\Models\DataPekerjaan;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use ZipArchive;

class SiwasController extends Controller
{
    public function dashboard()
    {
        return view('siwas.dashboard');
    }

    public function data_pekerjaan()
    {
        $data = DataPekerjaan::get();
        return view('siwas.data_pekerjaan', compact('data'));
    }

    public function add_pekerjaan(Request $request)
    {
        $data['pagu'] = $request->pagu;
        $data['pembayaran'] = $request->pembayaran;
        $data['nama_pekerjaan'] = $request->nama_pekerjaan;
        $data['no_tgl_spmk'] = $request->no_tgl_spmk;
        $data['nilai_kontrak'] = $request->nilai_kontrak;
        $data['penyedia_jasa'] = $request->penyedia_jasa;
        $data['tanggal_mulai'] = $request->tanggal_mulai;
        $data['tanggal_selesai'] = $request->tanggal_selesai;
        $data['daya_serap'] = $request->daya_serap;

        $tanggal_mulai = Carbon::parse($request->tanggal_mulai);
        $tanggal_selesai = Carbon::parse($request->tanggal_selesai);

        $data['jumlah_hari'] = $tanggal_mulai->diffInDays($tanggal_selesai);

        DataPekerjaan::create($data);

        return redirect()->route('data-pekerjaan');
    }

    public function find_pekerjaan(Request $request, $id)
    {
        $data = DataPekerjaan::find($id);

        return view('siwas.data_pekerjaan', compact('data'));
    }

    public function edit_pekerjaan(Request $request, $id)
    {
        $data['nama_pekerjaan'] = $request->nama_pekerjaan;
        $data['nilai_kontrak'] = $request->nilai_kontrak;
        $data['daya_serap'] = $request->daya_serap;
        $data['lapju_rencana'] = $request->lapju_rencana;
        $data['lapju_ril'] = $request->lapju_ril;
        $data['lapju_deviasi'] = $request->lapju_deviasi;

        DataPekerjaan::whereId($id)->update($data);

        return redirect()->route('data-pekerjaan');
    }

    public function delete_pekerjaan($id)
    {
        $data = DataPekerjaan::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('data-pekerjaan');
    }

    public function filter_pekerjaan(Request $request)
    {
        $query = DataPekerjaan::query();

        if ($request->filled('pembayaran') && $request->pembayaran !== '') {
            $query->where('pembayaran', $request->pembayaran);
        }

        $data = $query->get();

        return view('siwas.data_pekerjaan', compact('data'));
    }

    // Jenis Pembayaran
    public function reguler()
    {
        $data = DataPekerjaan::where('pembayaran', 'Reguler')->get();

        return view('siwas.reguler', compact('data'));
    }

    public function swakelola()
    {
        $data = DataPekerjaan::where('pembayaran', 'Swakelola')->get();

        return view('siwas.swakelola', compact('data'));
    }

    public function sbsn()
    {
        $data = DataPekerjaan::where('pembayaran', 'SBSN')->get();

        return view('siwas.sbsn', compact('data'));
    }

    public function hibah()
    {
        $data = DataPekerjaan::where('pembayaran', 'Hibah')->get();

        return view('siwas.hibah', compact('data'));
    }

    public function blu()
    {
        $data = DataPekerjaan::where('pembayaran', 'BLU')->get();

        return view('siwas.blu', compact('data'));
    }

    // Lapjusik
    public function lapjusik()
    {
        $data = DataPekerjaan::get();

        return view('siwas.lapjusik', compact('data'));
    }

    // Cetak Data
    public function cetak_data()
    {
        $data = DataPekerjaan::get();

        return view('siwas.cetak', compact('data'));
    }

    public function filter_data(Request $request)
    {
        // Inisialisasi query
        $query = DataPekerjaan::query();

        // Filter berdasarkan jenis pembayaran jika ada
        if ($request->filled('pembayaran')) {
            $query->where('pembayaran', $request->pembayaran);
        }

        // Filter berdasarkan rentang tanggal jika ada
        if ($request->filled('start_date') && $request->filled('end_date')) {
            // Pastikan tanggal menggunakan format Carbon
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('updated_at', [$startDate, $endDate]);
        }

        // Mendapatkan data berdasarkan filter
        $data = $query->get();

        // Kirim data ke view
        return view('siwas.cetak', compact('data'));
    }

    // Method untuk export data ke Excel
    public function print_data(Request $request)
    {
        $startDate = $request->query('start_date') ? Carbon::parse($request->query('start_date'))->startOfDay() : null;
        $endDate = $request->query('end_date') ? Carbon::parse($request->query('end_date'))->endOfDay() : null;

        $pembayaran = $request->query('pembayaran');

        return Excel::download(new ExportData($startDate, $endDate, $pembayaran), 'report.xlsx');
    }

    public function download_gambar($id)
    {
        $pekerjaan = DataPekerjaan::find($id);
        if (!$pekerjaan) {
            return abort(404, 'Data not found');
        }

        $files = [
            'storage/' . $pekerjaan->img_awal,
            'storage/' . $pekerjaan->img_progress,
            'storage/' . $pekerjaan->img_akhir,
        ];

        $zip = new ZipArchive;
        $zipFileName = 'images_' . $id . '.zip';
        $zipFilePath = storage_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    $zip->addFile($file, basename($file));
                }
            }
            $zip->close();
        } else {
            return abort(500, 'Failed to create ZIP file');
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    // Dokumentasi
    public function dokumentasi()
    {
        $data = DataPekerjaan::get();

        return view('siwas.dokumentasi', compact('data'));
    }

    public function export_pdf()
    {
        $data = DataPekerjaan::all(); // Ambil data yang ingin diexport

        $pdf = FacadePdf::loadView('siwas.dokumentasi_export', compact('data')); // Buat tampilan PDF

        return $pdf->download('data_pekerjaan.pdf');
    }

    public function about()
    {
        return view('siwas.about');
    }
}
