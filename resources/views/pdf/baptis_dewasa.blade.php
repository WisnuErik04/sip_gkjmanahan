<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Baptis Dewasa</title>
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

        p {
            margin: 0;
        }
        /* Tanggal di kanan */
    </style>
</head>

<body>

    <div class="container">
        <p><b>Hal : <u>PERMOHONAN BAPTIS DEWASA/SIDI *)</u></b></p>

        <p>Kepada Yth.<br>
            Majelis GKJ Manahan<br>
            Jl. MT Haryono No. 10<br>
            Surakarta</p>

        <p>Salam Kasih dalam Tuhan Yesus Kristus,<br>
            Bersamaan dengan akan dilaksanakannya Sakramen Baptis/Sidi*) besok pada :</p>

        <table>
            <tr>
                <td style="width:: 20%">Hari/Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($answers[2])->locale('id')->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>: {{ $answers[3] ?? '' }} WIB</td>
            </tr>
            <tr>
                <td>Di</td>
                <td>: {{ $answers[4] ?? '' }}</td>
            </tr>
        </table>

        <p>Perkenalkanlah saya:</p>

        <table>
            <tr>
                <td style="width:: 20%">Nama</td>
                <td>: {{ $answers[6] ?? '' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>: {{ $answers[7] ?? '' }} / {{ \Carbon\Carbon::parse($answers[8])->locale('id')->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $answers[9] ?? '' }}</td>
            </tr>
            <tr>
                <td>Pekerjaan/Pendidikan</td>
                <td>: {{ $answers[10] ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap Ayah</td>
                <td>: {{ $answers[11] ?? '' }}</td>
            </tr>
            <tr>
                <td><span style="color: white">Nama Lengkap</span> Ibu</td>
                <td>: {{ $answers[12] ?? '' }}</td>
            </tr>
            <tr>
                <td>HP/Telepon</td>
                <td>: {{ $answers[13] ?? '' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $answers[14] ?? '' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $answers[15] ?? '' }}</td>
            </tr>
            <tr>
                <td>Warga Blok/Pepanthan</td>
                <td>: {{ $answers[16] ?? '' }}</td>
            </tr>
            <tr>
                <td>Pengasuh/Tempat Katekisasi</td>
                <td>: {{ $answers[17] ?? '' }}</td>
            </tr>
            <tr>
                <td>Lama Katekisasi</td>
                <td>: {{ $answers[18] ?? '' }}</td>
            </tr>
        </table>

        <p><strong><u>BAGI YANG SIDI</u></strong></p>

        <table>
            <tr>
                <td>Baptis Kecil tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($answers[20])->locale('id')->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Di Gereja</td>
                <td>: {{ $answers[21] ?? '' }}</td>
            </tr>
            <tr>
                <td>Oleh</td>
                <td>: {{ $answers[22] ?? '' }}</td>
            </tr>
        </table>

        <p>Dengan ini saya mengajukan Baptis Dewasa/Sidi *)<br>
            Besar harapan saya, Majelis GKJ Manahan meluluskan permohonan saya ini.<br>
            Atas perhatian dan perkenaannya, kami ucapkan terima kasih.</p>

        <p class="right-align">Surakarta, {{ \Carbon\Carbon::parse($request->created_at)->locale('id')->translatedFormat('d F Y') }}</p>

        <table style="width:100%; margin-top:40px;">
            <tr>
                <td style="width:50%; text-align:center;">
                    Pengasuh Katekisasi
                    <br><br><br><br>
                    <p>(______________________)</p>
                </td>
                <td style="width:50%; text-align:center;">
                    Pemohon
                    <br><br><br><br>
                    <p>(<u>{{ $answers[6] ?? '' }}</u>)</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:50%; text-align:center;">
                    Mengetahui,<br>Pengasuh Blok/Pept.
                    <br><br><br><br>
                    <p>(______________________)</p>
                </td>
            </tr>
        </table>
        <p>*Coret yang tidak diperlukan, dimohon menyertakan Fotocopy Baptis Kecil (bagi yang akan Sidi).</p>


    </div>

</body>

</html>
