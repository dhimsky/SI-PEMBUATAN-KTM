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
    public function collection()
    {
        $mahasiswa = Mahasiswa::all();

        $data = [];

        foreach ($mahasiswa as $mhs) {
            $prov = $this->getWilayahNama($mhs->provinsi);
            $kab = $this->getWilayahNama($mhs->kabupaten);
            $kec = $this->getWilayahNama($mhs->kecamatan);
            $ds = $this->getWilayahNama($mhs->desa_kelurahan);

            $data[] = [
                $mhs->nim,
                $mhs->nama_lengkap,
                $mhs->nik,
                $mhs->tempat_lahir,
                $mhs->tanggal_lahir,
                $mhs->jenis_kelamin,
                $mhs->agama,
                $mhs->email,
                $mhs->nohp,
                empty($mhs->pas_foto) ? 'Foto tidak tersedia' : $mhs->pas_foto,
                mb_convert_case($prov, MB_CASE_TITLE),
                mb_convert_case($kab, MB_CASE_TITLE),
                mb_convert_case($kec, MB_CASE_TITLE),
                mb_convert_case($ds, MB_CASE_TITLE),
                $mhs->rt,
                $mhs->rw,
                $mhs->alamat_jalan,
                $mhs->nama_ayah,
                $mhs->nik_ayah,
                $mhs->tempat_lahir_ayah,
                $mhs->tanggal_lahir_ayah,
                $mhs->pendidikan_ayah,
                $mhs->pekerjaan_ayah,
                $mhs->penghasilan_ayah,
                $mhs->nama_ibu,
                $mhs->nik_ibu,
                $mhs->tempat_lahir_ibu,
                $mhs->tanggal_lahir_ibu,
                $mhs->pendidikan_ibu,
                $mhs->pekerjaan_ibu,
                $mhs->penghasilan_ibu,
                $mhs->nama_wali,
                $mhs->alamat_wali,
                $mhs->asal_sekolah,
                $mhs->jurusan_asal_sekolah,
                $mhs->pengalaman_organisasi,
                $mhs->prodi->nama_prodi,
                $mhs->ukt,
                $mhs->jenis_tinggal_di_cilacap,
                $mhs->alat_transportasi_ke_kampus,
                $mhs->sumber_biaya_kuliah,
                $mhs->penerima_kartu_prasejahtera,
                $mhs->jumlah_tanggungan_keluarga_yang_masih_sekolah,
                $mhs->anak_ke,
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
            'JENIS TINGGAL DI CILACAP',
            'ALAT TRANSPORTASI KE KAMPUS',
            'SUMBER BIAYA KULIAH',
            'PENERIMA KARTU PRASEJAHTERA',
            'JUMLAH TANGGUNGAN KELUARGA (MASIH SEKOLAH)',
            'ANAK KE',
        ];
    }
    // public function map($mahasiswa): array
    // {
    //     return [
    //         $mahasiswa->nim, // Menggunakan ="123456789" agar di Excel dianggap sebagai angka
    //         $mahasiswa->nama_lengkap,
    //         $mahasiswa->nik,
    //         $mahasiswa->tempat_lahir,
    //         $mahasiswa->tanggal_lahir,
    //         $mahasiswa->jenis_kelamin,
    //         $mahasiswa->agama,
    //         $mahasiswa->email,
    //         $mahasiswa->nohp,
    //         $mahasiswa->pas_foto,
    //         $mahasiswa->provinsi,
    //         $mahasiswa->kabupaten,
    //         $mahasiswa->kecamatan,
    //         $mahasiswa->desa_kelurahan,
    //         $mahasiswa->rt,
    //         $mahasiswa->rw,
    //         $mahasiswa->alamat_jalan,
    //         $mahasiswa->nama_ayah,
    //         $mahasiswa->nik_ayah,
    //         $mahasiswa->tempat_lahir_ayah,
    //         $mahasiswa->tanggal_lahir_ayah,
    //         $mahasiswa->pendidikan_ayah,
    //         $mahasiswa->pekerjaan_ayah,
    //         $mahasiswa->penghasilan_ayah,
    //         $mahasiswa->nama_ibu,
    //         $mahasiswa->nik_ibu,
    //         $mahasiswa->tempat_lahir_ibu,
    //         $mahasiswa->tanggal_lahir_ibu,
    //         $mahasiswa->pendidikan_ibu,
    //         $mahasiswa->pekerjaan_ibu,
    //         $mahasiswa->penghasilan_ibu,
    //         $mahasiswa->nama_wali,
    //         $mahasiswa->alamat_wali,
    //         $mahasiswa->asal_sekolah,
    //         $mahasiswa->jurusan_asal_sekolah,
    //         $mahasiswa->pengalaman_organisasi,
    //         $mahasiswa->prodi->nama_prodi,
    //         $mahasiswa->ukt,
    //         $mahasiswa->jenis_tinggal_di_cilacap,
    //         $mahasiswa->alat_transportasi_ke_kampus,
    //         $mahasiswa->sumber_biaya_kuliah,
    //         $mahasiswa->penerima_kartu_prasejahtera,
    //         $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah,
    //         $mahasiswa->anak_ke,
    //     ];
    // }
    public function styles(Worksheet $sheet)
    {
        // Menerapkan teks tebal (bold) dan rata tengah (center align) pada heading
        $sheet->getStyle('A1:AR1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:AR'.$lastRow)->applyFromArray([
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
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'U' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_NUMBER,
            'S' => NumberFormat::FORMAT_NUMBER,
            'Z' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}