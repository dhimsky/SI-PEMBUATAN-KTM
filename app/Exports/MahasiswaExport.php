<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class MahasiswaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
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
        $query = Mahasiswa::query()->with('alamat', 'kuliah', 'keluarga');

        if ($this->prodiId) {
            $query->where('prodi_id', $this->prodiId);
        }

        if ($this->tahunAngkatan) {
            $query->where('angkatan_id', $this->tahunAngkatan);
        }

        $mahasiswa = $query->get();

        $data = [];

        foreach ($mahasiswa as $mhs) {
            $prov = $this->getWilayahNama($mhs->alamat->provinsi);
            $kab = $this->getWilayahNama($mhs->alamat->kabupaten);
            $kec = $this->getWilayahNama($mhs->alamat->kecamatan);
            $ds = $this->getWilayahNama($mhs->alamat->desa_kelurahan);

            $data[] = [
                $mhs->nim,
                $mhs->nama_lengkap,
                $mhs->nik,
                $mhs->tempat_lahir,
                $mhs->tanggal_lahir,
                $mhs->jenis_kelamin,
                $mhs->agama->nama_agama,
                $mhs->email,
                $mhs->nohp,
                empty($mhs->pas_foto) ? 'Foto tidak tersedia' : $mhs->pas_foto,
                
                'Jalan ' . $mhs->alamat->nama_jalan . ', ' . 'RT.' . $mhs->alamat->rt . '/RW.' . $mhs->alamat->rw . ', ' . 'Desa ' . mb_convert_case($ds, MB_CASE_TITLE) . ', ' . 'Kecamatan ' . mb_convert_case($kec, MB_CASE_TITLE) . ', ' . mb_convert_case($kab, MB_CASE_TITLE) . ', ' . mb_convert_case($prov, MB_CASE_TITLE) . ', ' . $mhs->alamat->kode_pos,
                
                $mhs->keluarga->nama_ayah,
                $mhs->keluarga->nik_ayah,
                $mhs->keluarga->tempat_lahir_ayah,
                $mhs->keluarga->tanggal_lahir_ayah,
                $mhs->keluarga->pendidikan_ayah,
                $mhs->keluarga->pekerjaan_ayah,
                $mhs->keluarga->penghasilan_ayah,
                $mhs->keluarga->nama_ibu,
                $mhs->keluarga->nik_ibu,
                $mhs->keluarga->tempat_lahir_ibu,
                $mhs->keluarga->tanggal_lahir_ibu,
                $mhs->keluarga->pendidikan_ibu,
                $mhs->keluarga->pekerjaan_ibu,
                $mhs->keluarga->penghasilan_ibu,
                $mhs->keluarga->nama_wali,
                $mhs->keluarga->alamat_wali,
                $mhs->keluarga->jumlah_tanggungan_keluarga_yang_masih_sekolah,
                $mhs->keluarga->anak_ke,
                $mhs->kuliah->asal_sekolah,
                $mhs->kuliah->jurusan_asal_sekolah,
                $mhs->kuliah->pengalaman_organisasi,
                $mhs->kuliah->prodi->nama_prodi,
                $mhs->kuliah->ukt,
                $mhs->kuliah->angkatan->tahun_angkatan,
                $mhs->kuliah->status_mhs,
                $mhs->kuliah->jenis_tinggal_di_cilacap,
                $mhs->kuliah->alat_transportasi_ke_kampus,
                $mhs->kuliah->sumber_biaya_kuliah,
                $mhs->kuliah->penerima_kartu_prasejahtera,
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
            'NIM',
            'NAMA LENGKAP',
            'NIK',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'JENIS KELAMIN',
            'AGAMA',
            'EMAIL',
            'NO. HP',
            'PAS FOTO',
            'ALAMAT LENGKAP',
            'NAMA AYAH',
            'NIK AYAH',
            'TEMPAT LAHIR AYAH',
            'TANGGAL LAHIR AYAH',
            'PENDIDIKAN TERAKHIR AYAH',
            'PEKERJAAN AYAH',
            'PENGHASILAN AYAH',
            'NAMA IBU',
            'NIK IBU',
            'TEMPAT LAHIR IBU',
            'TANGGAL LAHIR IBU',
            'PENDIDIKAN TERAKHIR IBU',
            'PEKERJAAN IBU',
            'PENGHASILAN IBU',
            'NAMA WALI',
            'ALAMAT WALI',
            'JUMLAH TANGGUNGAN KELUARGA (MASIH SEKOLAH)',
            'ANAK KE',
            'ASAL SEKOLAH',
            'JURUSAN ASAL SEKOLAH',
            'PENGALAMAN ORGANISASI',
            'PROGRAM STUDI',
            'UKT',
            'TAHUN ANGKATAN',
            'STATUS MAHASISWA',
            'JENIS TINGGAL DI CILACAP',
            'ALAT TRANSPORTASI KE KAMPUS',
            'SUMBER BIAYA KULIAH',
            'PENERIMA KARTU PRASEJAHTERA',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        // Menerapkan teks tebal (bold) dan rata tengah (center align) pada heading
        $sheet->getStyle('A1:AT1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:AT'.$lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Menerapkan perataan kiri pada kolom A dari baris 2 ke bawah
        $sheet->getStyle('B2:B'.$sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ]);

        for ($row = 2; $row <= $lastRow; $row++) {
            $cell = $sheet->getCell('B' . $row);
            $cell->setValue(strtoupper($cell->getValue()));
        }
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'V' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'M' => NumberFormat::FORMAT_NUMBER,
            'T' => NumberFormat::FORMAT_NUMBER,
            'AH' => NumberFormat::FORMAT_NUMBER,
            'AI' => NumberFormat::FORMAT_NUMBER,
            'AB' => NumberFormat::FORMAT_NUMBER,
            'AC' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}