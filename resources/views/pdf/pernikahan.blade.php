<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Pernikahan</title>
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
            padding: 4px;
            vertical-align: top;
        }

        /* td:first-child {
            width: 30%;
        } */

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
        .center-align {
            text-align: center;
        }
        .header-title {
            font-family: Tahoma, Arial, sans-serif;
            font-size: 11pt;
        }

        /* Tanggal di kanan */
    </style>
</head>

<body>

    <div class="container">
        <p style="margin-left: 70%;">Kepada : <br>
            Yth. Majelis GKJ Manahan <br>
            Ditempat 
        </p>
        <p class="header-title center-align"><u>SURAT PERMOHONAN PERTUNANGAN / NIKAH GEREJAWI DAN PENCATATAN DI CATATAN SIPIL</u></p>

        <p>Yang bertanda tangan dibawah ini:</p>

        <table>
            <tr>
                <td style="width: 3%">I.</td>
                <td style="width: 30%">Nama Lengkap</td>
                <td>: {{ $answers[2] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Nomor Induk Gereja (NIG)</td>
                <td>: {{ $answers[3] ?? '' }} </td>
            </tr>
            <tr>
                <td></td>
                <td>Tempat dan Tgl. Lahir</td>
                <td>: {{ $answers[4] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Pekerjaan</td>
                <td>: {{ $answers[5] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat Rumah</td>
                <td>: {{ $answers[6] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Nomor Telp.</td>
                <td>: {{ $answers[7] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Warga Gereja</td>
                <td>: {{ $answers[8] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tempat tgl. Baptis/oleh</td>
                <td>: {{ $answers[9] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tempat tgl. Sidi / oleh</td>
                <td>: {{ $answers[10] ?? '' }}</td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="3"></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td >II.</td>
                <td style="width: 25%">Nama Lengkap (Ayah)</td>
                <td>: {{ $answers[12] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tgl. Lahir / Usia/ Agama</td>
                <td>: {{ $answers[13] ?? '' }} </td>
            </tr>
            <tr>
                <td></td>
                <td>Pekerjaan</td>
                <td>: {{ $answers[14] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat Rumah</td>
                <td>: {{ $answers[15] ?? '' }}</td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="3"></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td >III.</td>
                <td style="width: 25%">Nama Kecil (Ibu)</td>
                <td>: {{ $answers[17] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tgl. Lahir / Usia/ Agama</td>
                <td>: {{ $answers[18] ?? '' }} </td>
            </tr>
            <tr>
                <td></td>
                <td>Pekerjaan</td>
                <td>: {{ $answers[19] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat Rumah</td>
                <td>: {{ $answers[20] ?? '' }}</td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="3" class="center-align"><b><u>MOHON DIPERKENANKAN UNTUK</u></b></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td >IV.</td>
                <td style="width: 25%">Tunangan/Hari/Tgl</td>
                <td>: {{ $answers[22] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Nikah Capil/Pemerintah</td>
                <td>: Hari: {{ $answers[23] ?? '' }} &nbsp;&nbsp;&nbsp;Tanggal: {{ $answers[24] ?? '' }} &nbsp;&nbsp;&nbsp;Jam: {{ $answers[25] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tempat di</td>
                <td>: {{ $answers[26] ?? '' }}</td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="3" class="center-align"></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td >V.</td>
                <td style="width: 25%">Nama Calon Suami/Isteri</td>
                <td>: {{ $answers[28] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Nomor Induk Gereja (NIG)</td>
                <td>: {{ $answers[29] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tempat dan Tgl. Lahir</td>
                <td>: {{ $answers[30] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat Rumah</td>
                <td>: {{ $answers[31] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Nomor Telp.</td>
                <td>: {{ $answers[32] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Warga Gereja</td>
                <td>: {{ $answers[33] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tempat tgl. Baptis/oleh</td>
                <td>: {{ $answers[34] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tempat tgl. Sidi / oleh</td>
                <td>: {{ $answers[35] ?? '' }}</td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="3"></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td >VI.</td>
                <td style="width: 25%">Nama Lengkap (Ayah)</td>
                <td>: {{ $answers[37] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tgl. Lahir / Usia/ Agama</td>
                <td>: {{ $answers[38] ?? '' }} </td>
            </tr>
            <tr>
                <td></td>
                <td>Pekerjaan</td>
                <td>: {{ $answers[39] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat Rumah</td>
                <td>: {{ $answers[40] ?? '' }}</td>
            </tr>
            {{-- ========================= --}}
            {{-- ========================= --}}
            <tr>
                <td colspan="3"></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td >VII.</td>
                <td style="width: 25%">Nama Kecil (Ibu)</td>
                <td>: {{ $answers[42] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tgl. Lahir / Usia/ Agama</td>
                <td>: {{ $answers[43] ?? '' }} </td>
            </tr>
            <tr>
                <td></td>
                <td>Pekerjaan</td>
                <td>: {{ $answers[44] ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat Rumah</td>
                <td>: {{ $answers[45] ?? '' }}</td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3" class="center-align"><b><u>SAKSI-SAKSI</u></b></td>
            </tr>
            <tr>
                <td colspan="3"><b>SAKSI I</b></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="2" style="width: 25%">Nama</td>
                <td>: {{ $answers[47] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" >Usia / Agama</td>
                <td>: {{ $answers[48] ?? '' }} </td>
            </tr>
            <tr>
                <td colspan="2" >Pekerjaan</td>
                <td>: {{ $answers[49] ?? '' }} </td>
            </tr>
            <tr>
                <td colspan="2" >Alamat Rumah</td>
                <td>: {{ $answers[50] ?? '' }} </td>
            </tr>
            <tr>
                <td colspan="2" >Hubungan keluarga</td>
                <td>: {{ $answers[51] ?? '' }} </td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="3" class="center-align"></td>
            </tr>
            <tr>
                <td colspan="3"><b>SAKSI II</b></td>
            </tr>
            {{-- ========================= --}}
            <tr>
                <td colspan="2" style="width: 25%">Nama</td>
                <td>: {{ $answers[53] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" >Usia / Agama</td>
                <td>: {{ $answers[54] ?? '' }} </td>
            </tr>
            <tr>
                <td colspan="2" >Pekerjaan</td>
                <td>: {{ $answers[55] ?? '' }} </td>
            </tr>
            <tr>
                <td colspan="2" >Alamat Rumah</td>
                <td>: {{ $answers[56] ?? '' }} </td>
            </tr>
            <tr>
                <td colspan="2" >Hubungan keluarga</td>
                <td>: {{ $answers[57] ?? '' }} </td>
            </tr>
        </table>

        <p>Demikian untuk menjadikan periksa, dan atas segala bantuan Bapak/Ibu Majelis GKJ Manahan,<br>
            kami haturkan banyak terima kasih. </p>

        <p class="right-align">Surakarta, {{ \Carbon\Carbon::parse($request->created_at)->locale('id')->translatedFormat('d F Y') }}</p>

        <table style="width:100%; margin-top:40px;">
            <tr>
                <td style="width:50%; text-align:center;">
                    Calon Suami / Isteri
                    <br><br><br><br><br>
                    <p>(<U>{{ $answers[28] ?? '______________________' }}</U>)</p>
                </td>
                <td style="width:50%; text-align:center;">
                    Pemohon
                    <br><br><br><br><br>
                    <p>(<u>{{ $request->pemohon_nama ?? '' }})</u></p>
                </td>
            </tr>
        </table>
        
        <p class="center-align"><b>Persetujuan Orang Tua <br> Kedua Belah Pihak</b></p>
        
        <table style="width:100%; margin-top:40px;">
            <tr>
                <td colspan="2" style="width:50%; text-align:center;">
                    Orang Tua Calon Suami / Isteri
                    <br><br><br><br><br>
                </td>
                <td colspan="2" style="width:50%; text-align:center;">
                    Orang Tua Pemohon
                    <br><br><br><br><br>
                </td>
            </tr>
            <tr>
                <td style="width:25%; text-align:center;">
                    <p>(Bp <U>{{ $answers[37] ?? '______________________' }}</U>) </p>
                </td>
                <td style="width:25%; text-align:center;">
                    <p>(Ibu <U>{{ $answers[42] ?? '______________________' }}</U>) </p>
                </td>
                <td style="width:25%; text-align:center;">
                    <p>(Bp <U>{{ $answers[12] ?? '______________________' }}</U>) </p>
                </td>
                <td style="width:25%; text-align:center;">
                    <p>(Ibu <U>{{ $answers[17] ?? '______________________' }}</U>) </p>
                </td>
            </tr>
        </table>

        <table style="width:100%; margin-top:40px;">
            <tr>
                <td style="width:50%; text-align:center;">
                    <b>Mengetahui Pengasuh Blok/Pept. _______</b>
                    <br><br><br><br><br>
                    <p>(______________________)</p>
                </td>
            </tr>
        </table>
        <p>*) Coret yang tidak diperlukan.</p>
        <p>Ditulis dengan huruf Balok.</p>


    </div>

</body>

</html>
