<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class PengajuanImagesExport
{
    protected $prodiId;
    protected $tahunAngkatan;

    public function __construct($prodiId = null, $tahunAngkatan = null)
    {
        $this->prodiId = $prodiId;
        $this->tahunAngkatan = $tahunAngkatan;
    }

    public function export()
    {
        // Mengambil data mahasiswa berdasarkan filter prodi dan tahun angkatan
        $query = Pengajuan::query();
        if ($this->prodiId) {
            $query->where('prodi_id', $this->prodiId);
        }
        if ($this->tahunAngkatan) {
            $query->where('angkatan_id', $this->tahunAngkatan);
        }
        $mahasiswa = $query->get();

        // Membuat direktori sementara untuk menyimpan gambar
        $tempDir = storage_path('app/public/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Menyalin gambar ke direktori sementara
        foreach ($mahasiswa as $mhs) {
            if ($mhs->pas_foto) {
                $fotoPath = Storage::disk('public')->path('pas_foto/' . $mhs->pas_foto);
                if (file_exists($fotoPath)) {
                    $fileName = basename($fotoPath);
                    copy($fotoPath, $tempDir . '/' . $fileName);
                }
            }
        }

        // Membuat file zip dari direktori sementara
        $zipFileName = 'pengajuan_images.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($tempDir));
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($tempDir) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
        }

        // Menghapus direktori sementara
        $this->deleteDirectory($tempDir);

        return $zipFilePath;
    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }
}