<x-mail::message>
   
        <h2>Detail Permohonan:</h2>
        <p><strong>Nama:</strong> {{ $data['pemohon_nama'] }}</p>
        <p><strong>Warga Blok/Pepanthan:</strong> {{ $data['pemohon_warga_blok'] }}</p>
        <p><strong>Jenis Permohonan:</strong> {{ $data['form'] }}</p>
        <p><strong>Status:</strong> {{ $data['status'] }}</p>
        <p><strong>Keterangan:</strong> {{ $data['notes']?? '' }}</p>
  
    

Thanks,<br>Admin Sekretariat GKJ Manahan Surakarta
{{-- {{ config('app.name') }} --}}
</x-mail::message>
