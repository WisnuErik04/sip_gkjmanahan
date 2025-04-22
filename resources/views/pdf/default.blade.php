<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan</title>
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
        <p><b>Hal : <u>{{ $request->form->name }}</u></b></p>

        <p>Kepada Yth.<br>
            Majelis GKJ Manahan<br>
            Jl. MT Haryono No. 10<br>
            Surakarta</p>

        {{-- <p>Salam Kasih dalam Tuhan Yesus Kristus,<br>
            Yang bertanda tangan dibawah ini :</p> --}}

        <table>
            @foreach ($pertanyaans as $key => $pertanyaan)
                <tr>
                    @if ($pertanyaan->tipe_jawaban === 'header')
                        <td colspan="2">{{ $pertanyaan->pertanyaan }}</td>
                    @else
                        @if ($answers[$pertanyaan->order] && \Carbon\Carbon::hasFormat($answers[$pertanyaan->order], 'Y-m-d')) 
                            @php
                                $formatTanggal = \Carbon\Carbon::parse($answers[$pertanyaan->order])->locale('id')->translatedFormat('d F Y');
                            
                                $answers[$pertanyaan->order] = $formatTanggal; // Selasa, 15 April 2025    
                            @endphp 
                        @endif
                        @if ($answers[$pertanyaan->order] && \Carbon\Carbon::hasFormat($answers[$pertanyaan->order], 'h:i')) 
                            @php                            
                                $answers[$pertanyaan->order] .= " WIB"; // Selasa, 15 April 2025    
                            @endphp 
                        @endif
                        <td style="width:: 20%">{{ $pertanyaan->pertanyaan }}</td>
                        <td>: {{ $answers[$pertanyaan->order] ?? '' }}</td>
                    @endif
                </tr>
                
            @endforeach
            {{-- <tr>
                <td>Jam</td>
                <td>: {{ $answers[3] ?? '' }} WIB</td>
            </tr>
            <tr>
                <td>Di</td>
                <td>: {{ $answers[4] ?? '' }}</td>
            </tr> --}}
        </table>

      

        {{-- <p>Besar harapan kami, Majelis GKJ Manahan berkenan atas permohonan kami ini,<br>
            Atas perhatian dan perkenannya, kami ucapkan terima kasih.</p> --}}

        <p class="right-align">Surakarta, {{ \Carbon\Carbon::parse($request->created_at)->locale('id')->translatedFormat('d F Y') }}</p>

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
                    &nbsp;<br>Pemohon
                    <br><br><br><br><br>
                    <p><u>{{ $request->pemohon_nama ?? '' }}</u></p>
                </td>
            </tr>
        </table>
        {{-- <p>*Coret yang tidak diperlukan, dimohon menyertakan Fotocopy Akte Kelahiran.</p> --}}


    </div>

</body>

</html>
