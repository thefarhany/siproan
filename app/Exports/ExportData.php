<?php

namespace App\Exports;

use App\Models\DataPekerjaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportData implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnWidths, WithEvents
{
    use RegistersEventListeners;

    public function headings(): array
    {
        return [
            // Baris pertama header (merge)
            ['NO', 'PROGRAM / KEGIATAN / URAIAN', 'PAGU', 'NO/TGL. SP NILAI KONTRAK', 'PENYEDIA JASA', 'PELAKSANAAN', '', '', 'DAYA SERAP', 'JUJIK (%)', '', '', 'JUMIN', 'KETERANGAN'],
            // Baris kedua header (detail subkolom)
            ['', '', '', '', '', 'MULAI', 'SELESAI', 'JML HARI', '', 'RENC', 'RIIL', 'DEVIASI', '', ''],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 30,  // Program / Kegiatan / Uraian
            'C' => 20,  // Pagu Rp
            'D' => 20,  // Kosong untuk merge
            'E' => 30,  // No / Tgl SP Nilai Kontrak
            'F' => 30,  // Penyedia Jasa
            'G' => 20,  // Tanggal Mulai
            'H' => 20,  // Tanggal Selesai
            'I' => 15,  // Jumlah Hari
            'J' => 10,  // Lapju Rencana
            'K' => 10,  // Lapju Ril
            'L' => 10,  // Lapju Deviasi
            'M' => 10,  // Jumin
        ];
    }

    public function collection()
    {
        // Ambil data dari database
        $data = DataPekerjaan::select(
            'nama_pekerjaan',
            'pagu',
            'no_tgl_spmk',
            'penyedia_jasa',
            'tanggal_mulai',
            'tanggal_selesai',
            'jumlah_hari',
            'lapju_rencana',
            'lapju_ril',
            'lapju_deviasi',
            'daya_serap',
            'ket'
        )->get();

        // Tambahkan nomor urut menggunakan map
        return $data->map(function ($item, $index) {
            return [
                'no' => $index + 1, // Nomor urut
                'nama_pekerjaan' => $item->nama_pekerjaan,
                'pagu' => $item->pagu,
                'no_tgl_spmk' => $item->no_tgl_spmk,
                'penyedia_jasa' => $item->penyedia_jasa,
                'tanggal_mulai' => $item->tanggal_mulai,
                'tanggal_selesai' => $item->tanggal_selesai,
                'jumlah_hari' => $item->jumlah_hari,
                'lapju_rencana' => $item->lapju_rencana,
                'lapju_ril' => $item->lapju_ril,
                'lapju_deviasi' => $item->lapju_deviasi,
                'daya_serap' => $item->daya_serap,
                'ket' => $item->ket,
            ];
        });
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Merge cells untuk header
        $event->sheet->mergeCells('A1:A2'); // NO
        $event->sheet->mergeCells('B1:B2'); // PROGRAM / KEGIATAN / URAIAN
        $event->sheet->mergeCells('C1:C2'); // PAGU
        $event->sheet->mergeCells('D1:D2'); // NO/TGL. SP NILAI KONTRAK
        $event->sheet->mergeCells('E1:E2'); // PENYEDIA JASA
        $event->sheet->mergeCells('F1:H1'); // PELAKSANAAN (kolom mulai, selesai, jml hari)
        $event->sheet->mergeCells('I1:I2'); // DAYA SERAP
        $event->sheet->mergeCells('J1:L1'); // JUJIK (%)
        $event->sheet->mergeCells('M1:M2'); // JUMIN
        $event->sheet->mergeCells('N1:N2'); // KETERANGAN

        // Style untuk header
        $event->sheet->getStyle('A1:N2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                ],
            ],
        ]);

        $event->sheet->getStyle('D1:D1000')->getAlignment()->setWrapText(true);
    }
}
