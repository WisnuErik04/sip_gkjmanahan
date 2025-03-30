<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Agenda</title>
    <style>
        body {
            font-size: 12px;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 24px;
        }

        h2 {
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 16px;
        }

        h3 {
            text-align: center;
            font-size: 1.125rem;
            margin-bottom: 24px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #d1d5db;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        
        th {
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="container">
        <h2>MATERI RAPAT PENGURUS HARIAN MAJELIS GKJ MANAHAN <br> 
            {{ \Carbon\Carbon::parse($agenda->tgl_rapat)->locale('id')->translatedFormat('l, d F Y') }}</h2>

        @foreach ($records as $jenisNama => $details)
            {{-- <h4>{{ $jenisNama }}</h4> --}}
            <h4>{{ $jenisNama }} = {{ $details->count() }} surat</h4>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No. Urut</th>
                            <th>No. Srt</th>
                            <th>DARI / TANGGAL MASUK</th>
                            <th>PERIHAL</th>
                            <th>USULAN KEPUTUSAN</th>
                            <th>KET</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($details as $index => $detail)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $detail->no_surat }}</td>
                                <td>{{ $detail->dari }} / {{ \Carbon\Carbon::parse($detail->tanggal_masuk)->locale('id')->translatedFormat('d F Y') }}</td>
                                <td>{{ $detail->perihal }}</td>
                                <td>{{ $detail->usulan_keputusan }}</td>
                                <td>{{ $detail->agendaKeterangan->name ?? '-' }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endforeach
    </div>

</body>

</html>
