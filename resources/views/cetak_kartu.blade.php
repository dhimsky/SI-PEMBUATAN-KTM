<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/') }}images/logoPNC.png">

    <title>Cetak KTMe</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        .main {
            width: 346px;
            height: 214px;
            margin: auto;
            margin-bottom: 30px;
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
            color: #005D90;
        }

        .background-image {
            width: 345px;
            height: 212px;
            border-radius: 6px;
            position: relative;
            border: 1px solid gray;
            position: absolute;
        }

        .main-data {
            width: 345px;
            height: 212px;
            position: absolute;
        }

        .left-div {
            position: absolute;
            float: left;
            width: 100%;
            height: 212px;
            padding-left: 18px;
            padding-top: 78px
        }

        .right-div {
            position: absolute;
            float: left;
            width: 71%;
            height: 212px;
        }

        .logo {
            position: absolute;
            margin: 25px 0 0 18px;
        }

        .info {
            position: absolute;
            padding: 0 4 0 0px;
            height: 120px;
            margin-top: 75px;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .register-hr {
            border-bottom: 1px solid black;
            width: 80px;
        }

        .back-div {
            padding: 10px;
            position: absolute;
            height: 194px;
            margin-left: 120px;
            width: 208px;
        }

        .horizontal {
            width: 90px;
        }

        .vertical-top {
            vertical-align: top;
        }

        .tidak-tersedia{
            font-size:7px;
            color:rgb(39, 39, 39);
            padding-left:3px;
        }

        .text-name{
            font-weight: bold;
            text-transform: uppercase;
        }

        .img{
            height: 80px;
            margin-right:15px;
            margin-top:4px;
            border-radius: 2px;
        }
        img.qrcode {
            padding-top: 175px;
            width: 31px;
            height: 31px;
            left: 2px;
            position: absolute;
        }
    </style>
</head>

<body>
    @foreach ($mahasiswas as $mahasiswa)
    <div>
        <div class="main">
            <img class="background-image" src="{{public_path('images/FrameCard2.png')}}" alt="">
            <div class="main-data">
                <div class="left-div">
                    @if ($mahasiswa->pas_foto)
                    <img class="img"
                    src="{{ public_path('storage/pas_foto/' . $mahasiswa->pas_foto) }}" alt="" width="60">
                    @else
                    <img class="img" src="{{ public_path('/images/profile.jpeg') }}" alt="" width="60">
                    @endif
                </div>
                <div class="right-div" style="font-size:10.3px; line-height: 1; padding-left:90px; padding-top:0px">
                    <div class="info">
                        <table>
                            <tr class="vertical-top">
                                <td class="horizontal">Nama</td>
                                <td> : </td>
                                <td class="text-name">{{$mahasiswa->nama_lengkap}}</td>
                            </tr>
                            <tr class="vertical-top">
                                <td>NIM</td>
                                <td> : </td>
                                <td>{{$mahasiswa->nim}}</td>
                            </tr>
                            <tr class="vertical-top">
                                <td>Tempat/ Tgl. Lahir</td>
                                <td> : </td>
                                <td>
                                    <?php
                                        // Array untuk mengonversi bulan dalam bahasa Inggris ke bahasa Indonesia
                                        $bulan = [
                                            'January'   => 'Januari',
                                            'February'  => 'Februari',
                                            'March'     => 'Maret',
                                            'April'     => 'April',
                                            'May'       => 'Mei',
                                            'June'      => 'Juni',
                                            'July'      => 'Juli',
                                            'August'    => 'Agustus',
                                            'September' => 'September',
                                            'October'   => 'Oktober',
                                            'November'  => 'November',
                                            'December'  => 'Desember'
                                        ];
                                        
                                        // Ubah format tanggal dari "YYYY-MM-DD" menjadi "DD NamaBulan YYYY" dalam bahasa Indonesia
                                        $tanggal_lahir = date('d', strtotime($mahasiswa->tanggal_lahir)) . ' ' . $bulan[date('F', strtotime($mahasiswa->tanggal_lahir))] . ' ' . date('Y', strtotime($mahasiswa->tanggal_lahir));
                                        
                                        echo $mahasiswa->tempat_lahir . '/ ' . $tanggal_lahir;
                                    ?>
                                </td>
                            </tr>
                            <tr class="vertical-top">
                                <td>Jenis Kelamin</td>
                                <td> : </td>
                                <td>{{$mahasiswa->jenis_kelamin}}</td>
                            </tr>
                            <tr class="vertical-top">
                                <td>Agama</td>
                                <td> : </td>
                                <td>{{$mahasiswa->agama->nama_agama}}</td>
                            </tr>
                            <tr class="vertical-top">
                                <td>Program Studi</td>
                                <td> : </td>
                                <td>{{$mahasiswa->prodi->nama_prodi}}</td>
                            </tr>
                        </table>
                    </div>
                        <img src="data:image/png;base64, {!! base64_encode($qrCode) !!}" class="qrcode" />
                </div>
            </div>
        </div>
    </div>
    @if (!$loop->last)
    <div class="page-break"></div>
    @endif
    @endforeach
</body>
</html>