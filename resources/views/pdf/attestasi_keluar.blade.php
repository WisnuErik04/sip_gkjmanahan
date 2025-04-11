<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Attestasi Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }

        .container {
            width: 100%;
            max-width: 700px;
            margin: auto;
        }

        .title {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
            vertical-align: top;
        }

        td:first-child {
            width: 30%;
        }

        /* Atur lebar kolom pertama */
        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature {
            text-align: center;
            width: 40%;
        }

        /* Tanda tangan kiri & kanan */
        .right-align {
            text-align: right;
            margin-top: 20px;
        }

        /* Tanggal di kanan */
    </style>
</head>

<body>

    <div class="container">
        <p class="right-align">Surakarta, {{ \Carbon\Carbon::parse($request->created_at)->locale('id')->translatedFormat('d F Y') }}</p>

        <p><b>Hal : PERMOHONAN PINDAH JEMAAT</b></p>

        <p>Kepada Yth.<br>
            Majelis GKJ Manahan<br>
            Jl. MT Haryono No. 10<br>
            Surakarta</p>

        <p>Yang bertanda tangan dibawah ini :</p>

        <table>
            <tr>
                <td style="width: 35%">Nama</td>
                <td>: {{ $answers[2] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nomor Induk Gereja</td>
                <td>: {{ $answers[3] ?? '' }} WIB</td>
            </tr>
            <tr>
                <td>Tempat/Tgl. Lahir</td>
                <td>: {{ $answers[4] ?? '' }} WIB</td>
            </tr>
            <tr>
                <td>Pekerjaan / Pendidikan</td>
                <td>: {{ $answers[5] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>: {{ $answers[6] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama Kecil Ibu</td>
                <td>: {{ $answers[7] ?? '' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl. Baptis/ Oleh</td>
                <td>: {{ $answers[8] ?? '' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl. Sidi/ Oleh</td>
                <td>: {{ $answers[9] ?? '' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl. Nikah</td>
                <td>: {{ $answers[10] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama Isteri / Suami</td>
                <td>: {{ $answers[11] ?? '' }}</td>
            </tr>
            <tr>
                <td>Alamat Lama</td>
                <td>: {{ $answers[12] ?? '' }}</td>
            </tr>
            <tr>
                <td>Alamat Baru</td>
                <td>: {{ $answers[13] ?? '' }}</td>
            </tr>
            <tr>
                <td>No HP./ Email</td>
                <td>: {{ $answers[14] ?? '' }}</td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td>: {{ $answers[15] ?? '' }}</td>
            </tr>
            <tr>
                <td>Alasan pindah</td>
                <td>: {{ $answers[16] ?? '' }}</td>
            </tr>
        </table>

        <p>Mohon dengan hormat agar kepada kami / keluarga kami dibuatkan Surat Lulusan (Attestasi) pindah ke:</p>
        
        <table>
            <tr>
                <td style="width: 35%">Gereja</td>
                <td>: {{ $answers[18] ?? '' }}</td>
            </tr>
            <tr>
                <td>Alamat Gereja (ditulis dg jelas)</td>
                <td>: {{ $answers[19] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama-nama yg ikut pindah sbb</td>
                <td>: (lihat halaman sebalik)</td>
            </tr>
        </table>
        <p>Sekian dan atas bantuannya kami ucapkan terima kasih.</p>



        <!-- Tanda Tangan Kanan & Kiri -->

        <table style="width:100%; margin-top:40px;">
            <tr>
                <td style="width:50%; text-align:center;">
                    Mengetahui,<br>Pengasuh Blok/Pepanthan ___________
                    <br><br><br><br><br>
                    <p>______________________</p>
                </td>
                <td style="width:50%; text-align:center;">
                    &nbsp;<br>Pemohon
                    <br><br><br><br><br>
                    <p><u>{{ $request->pemohon_nama ?? '' }}</u></p>
                </td>
            </tr>
        </table>
       
        <p>KETERANGAN : <br>
            1.	Yang bersangkutan tidak / diijinkan mengikuti Perjamuan Kudus. <br>
            2.	............................................................................................. <br>
            &nbsp;&nbsp;&nbsp;&nbsp;(1 dan 2, diisi oleh Pengasuh Blok/Pepanthan)

        </p>

    </div>

</body>

</html>
