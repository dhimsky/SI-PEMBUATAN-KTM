<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Color;

class PengajuanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $prodiId;
    protected $tahunAngkatan;

    public function __construct($prodiId = null, $tahunAngkatan = null)
    {
        $this->prodiId = $prodiId;
        $this->tahunAngkatan = $tahunAngkatan;
    }

    public function collection()
    {
        $query = Pengajuan::query();

        // Filter data berdasarkan prodi_id jika diberikan
        if ($this->prodiId) {
            $query->where('prodi_id', $this->prodiId);
        }

        // Filter data berdasarkan tahun_angkatan jika diberikan
        if ($this->tahunAngkatan) {
            $query->where('angkatan_id', $this->tahunAngkatan);
        }

        $pengajuan = $query->get();

        $data = [];

        foreach ($pengajuan as $p) {
            $prov = $this->getWilayahNama($p->provinsi);
            $kab = $this->getWilayahNama($p->kabupaten);
            $kec = $this->getWilayahNama($p->kecamatan);
            $ds = $this->getWilayahNama($p->desa_kelurahan);

            $data[] = [
                $p->id_pengajuan,
                $p->status,
                $p->nim_id,
                $p->nama_lengkap,
                $p->nik,
                $p->tempat_lahir,
                $p->tanggal_lahir,
                $p->jenis_kelamin,
                $p->agama->nama_agama,
                $p->email,
                $p->nohp,
                empty($p->pas_foto) ? 'Foto tidak tersedia' : $p->pas_foto,
                mb_convert_case($prov, MB_CASE_TITLE),
                mb_convert_case($kab, MB_CASE_TITLE),
                mb_convert_case($kec, MB_CASE_TITLE),
                mb_convert_case($ds, MB_CASE_TITLE),
                $p->rt,
                $p->rw,
                $p->alamat_jalan,
                $p->nama_ayah,
                $p->nik_ayah,
                $p->tempat_lahir_ayah,
                $p->tanggal_lahir_ayah,
                $p->pendidikan_ayah,
                $p->pekerjaan_ayah,
                $p->penghasilan_ayah,
                $p->nama_ibu,
                $p->nik_ibu,
                $p->tempat_lahir_ibu,
                $p->tanggal_lahir_ibu,
                $p->pendidikan_ibu,
                $p->pekerjaan_ibu,
                $p->penghasilan_ibu,
                $p->nama_wali,
                $p->alamat_wali,
                $p->asal_sekolah,
                $p->jurusan_asal_sekolah,
                $p->pengalaman_organisasi,
                $p->prodi->nama_prodi,
                $p->ukt,
                $p->angkatan->tahun_angkatan,
                $p->jenis_tinggal_di_cilacap,
                $p->alat_transportasi_ke_kampus,
                $p->sumber_biaya_kuliah,
                $p->penerima_kartu_prasejahtera,
                $p->jumlah_tanggungan_keluarga_yang_masih_sekolah,
                $p->anak_ke,
            ];
        }
        return collect($data);
    }

    private function getWilayahNama($kode)
    {
        $wilayah = DB::table('wilayah')
            ->select('nama')
            ->where('kode', $kode)
            ->first();
        return $wilayah ? $wilayah->nama : null;
    }

    public function headings(): array
    {
        return [
            'ID PENGAJUAN',
            'STATUS',
            'NIM',
            'NAMA LENGKAP',
            'NIK',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'JENIS KELAMIN',
            'AGAMA',
            'EMAL',
            'No. HP',
            'PAS FOTO',
            'PROVINSI',
            'KABUPATEN',
            'KECAMATAN',
            'DESA/KELURAHAN',
            'RT',
            'RW',
            'ALAMAT JALAN',
            'NAMA AYAH',
            'NIK AYAH',
            'TEMPAT LAHIR AYAH',
            'TANGGAL LAHIR AYAH',
            'PENDIDIKAN AYAH',
            'PEKERJAAN AYAH',
            'PENGHASILAN AYAH',
            'NAMA IBU',
            'NIK IBU',
            'TEMPAT LAHIR IBU',
            'TANGGAL LAHIR IBU',
            'PENDIDIKAN IBU',
            'PEKERJAAN IBU',
            'PENGHASILAN IBU',
            'NAMA WALI',
            'ALAMAT WALI',
            'ASAL SEKOLAH',
            'JURUSAN ASAL SEKOLAH',
            'PENGALAMAN ORGANISASI',
            'PROGRAM STUDI',
            'UKT',
            'TAHUN ANGKATAN',
            'JENIS TINGGAL DI CILACAP',
            'ALAT TRANSPORTASI KE KAMPUS',
            'SUMBER BIAYA KULIAH',
            'PENERIMA KARTU PRASEJAHTERA',
            'JUMLAH TANGGUNGAN KELUARGA (MASIH SEKOLAH)',
            'ANAK KE',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        // Menerapkan teks tebal (bold) dan rata tengah (center align) pada heading
        $sheet->getStyle('A1:AU1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:AU'.$lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Menerapkan perataan kiri pada kolom A dari baris 2 ke bawah
        $sheet->getStyle('D2:D'.$lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ]);

        // Menentukan range berdasarkan seluruh data (misalnya dari A2 sampai AU$lastRow)
        $range = 'A2:AU'.$lastRow;

        // Mendapatkan conditional styles dari range yang ditentukan
        $conditionalStyles = $sheet->getStyle($range)->getConditionalStyles();

        // Conditional Style for "proses" (blue font color)
        $conditional1 = new Conditional();
        $conditional1->setConditionType(Conditional::CONDITION_CELLIS);
        $conditional1->setOperatorType(Conditional::OPERATOR_EQUAL);
        $conditional1->addCondition('proses');
        $conditional1->getStyle()->getFont()->getColor()->setARGB(Color::COLOR_BLUE);

        // Conditional Style for "diterima" (green font color)
        $conditional2 = new Conditional();
        $conditional2->setConditionType(Conditional::CONDITION_CELLIS);
        $conditional2->setOperatorType(Conditional::OPERATOR_EQUAL);
        $conditional2->addCondition('diterima');
        $conditional2->getStyle()->getFont()->getColor()->setARGB(Color::COLOR_GREEN);

        // Conditional Style for "ditolak" (red font color)
        $conditional3 = new Conditional();
        $conditional3->setConditionType(Conditional::CONDITION_CELLIS);
        $conditional3->setOperatorType(Conditional::OPERATOR_EQUAL);
        $conditional3->addCondition('ditolak');
        $conditional3->getStyle()->getFont()->getColor()->setARGB(Color::COLOR_RED);
    }


    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'W' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AD' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'Q' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
            'U' => NumberFormat::FORMAT_NUMBER,
            'AB' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}