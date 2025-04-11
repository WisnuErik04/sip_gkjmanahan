<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Attestasi Masuk</title>
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

        <p><b>Hal : Permohonan Ingin Menjadi Warga <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GKJ Manahan</b></p>

        <p>Kepada Yth.<br>
            Majelis GKJ Manahan<br>
            Jl. MT Haryono No. 10<br>
            Surakarta</p>

        <p>Salam Kasih dalam Tuhan Yesus Kristus,<br>
            Yang bertanda tangan dibawah ini :</p>

        <table>
            <tr>
                <td style="width:: 20%">Nama</td>
                <td>: {{ $answers[2] ?? '' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl. Lahir</td>
                <td>: {{ $answers[3] ?? '' }} WIB</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $answers[4] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama orang tua</td>
                <td>: {{ $answers[5] ?? '' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl. Baptis/Sidi</td>
                <td>: {{ $answers[6] ?? '' }}</td>
            </tr>
            <tr>
                <td>No. HP/Telp.</td>
                <td>: {{ $answers[7] ?? '' }}</td>
            </tr>
            <tr>
                <td>Asal Gereja</td>
                <td>: {{ $answers[8] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama Suami/Isteri</td>
                <td>: {{ $answers[9] ?? '' }}</td>
            </tr>
        </table>

        <p>Dengan ini saya mengajukan  permohonan untuk diterima menjadi warga GKJ Manahan.<br>
            Atas terkabulnya permohonan kami, diucapkan terima kasih.</p>


        <!-- Tanda Tangan Kanan & Kiri -->
        {{-- <div class="signature-container">
            <div class="signature">
                <p>Mengetahui,<br>Pengasuh Blok/Pept, ________ </p>
                <br><br><br>
                <p>______________________</p>
            </div>

            <div class="signature">
                <p>&nbsp;<br>Pemohon</p>
                <br><br><br>
                <p><u>{{ $answers[6] ?? '' }}</u></p>
            </div>
        </div> --}}

        <table style="width:100%; margin-top:40px;">
            <tr>
                <td style="width:50%; text-align:center;">
                    {{-- Mengetahui,<br>Pengasuh Blok/Pepanthan --}}
                    <br><br><br><br><br>
                    {{-- <p>______________________</p> --}}
                </td>
                <td style="width:50%; text-align:center;">
                    Pemohon
                    <br><br><br><br><br>
                    <p><u>{{ $request->pemohon_nama ?? '' }}</u></p>
                </td>
            </tr>
        </table>
        <p><i>*) Mohon melampirkan fotocopy Surat Baptis/Sidi/Kartu Keluarga</i></p>


    </div>

</body>

</html>
