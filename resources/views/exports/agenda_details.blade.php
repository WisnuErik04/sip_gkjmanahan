<table>
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold;">
                MATERI RAPAT PENGURUS HARIAN MAJELIS GKJ MANAHAN <br>
                {{ \Carbon\Carbon::parse($agenda->tgl_rapat)->locale('id')->translatedFormat('l, d F Y') }}
            </th>
        </tr>
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
        @php $i = 1; @endphp
        @foreach ($records as $jenisNama => $details)
            <tr>
                <td colspan="6" style="font-weight: bold;">{{ $jenisNama }} = {{ $details->count() }} surat</td>
            </tr>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $detail->no_surat }}</td>
                    <td>{{ $detail->dari }} / {{ \Carbon\Carbon::parse($detail->tanggal_masuk)->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>{{ $detail->perihal }}</td>
                    <td>{{ $detail->usulan_keputusan }}</td>
                    <td>{{ $detail->agendaKeterangan->name ?? '-' }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
