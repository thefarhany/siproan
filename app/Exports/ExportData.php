<?php

namespace App\Exports;

use App\Models\DataPekerjaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportData implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $startDate;
    protected $endDate;
    protected $pembayaran;

    public function __construct($startDate = null, $endDate = null, $pembayaran = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->pembayaran = $pembayaran;
    }

    public function headings(): array
    {
        return [
            'Nomor/Tanggal/SPMK',
            'Kotama',
            'Nama Pekerjaan',
            'Nilai Kontrak',
            'Penyedia Jasa',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Jumlah Hari',
            'Lapju Rencana',
            'Lapju Ril',
            'Lapju Deviasi',
            'Daya Serap',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 50,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
        ];
    }

    public function collection()
    {
        $query = DataPekerjaan::select(
            'no_tgl_spmk',
            'kotama',
            'nama_pekerjaan',
            'nilai_kontrak',
            'penyedia_jasa',
            'tanggal_mulai',
            'tanggal_selesai',
            'jumlah_hari', // Tambahkan logika untuk menghitung jumlah hari
            'lapju_rencana',
            'lapju_ril',
            'lapju_deviasi',
            'daya_serap'
        );

        // Filter berdasarkan jenis pembayaran jika ada
        if ($this->pembayaran) {
            $query->where('pembayaran', $this->pembayaran);
        }

        // Filter berdasarkan tanggal jika ada
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('updated_at', [$this->startDate, $this->endDate]);
        }

        // Mengembalikan data hasil filter
        return $query->get();
    }
}
