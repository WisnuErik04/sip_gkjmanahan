<?php

namespace App\Filament\Resources\VerifAgendaResource\Pages;

use App\Models\Form;
use Filament\Actions;
use App\Models\AgendaJenis;
use App\Models\AgendaDetail;
use App\Services\FonnteService;
use App\Models\AgendaKeterangan;
use App\Mail\RequestStatusesMail;
use Illuminate\Support\Facades\Mail;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\VerifAgendaResource;

class EditVerifAgenda extends EditRecord
{
    protected static string $resource = VerifAgendaResource::class;
    protected static ?string $title = "Agenda Rapat";

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ambil data dari record langsung (karena ini object Eloquent)
        $record = $this->record;

        $data['dari'] = $data['pemohon_nama'] ?? '';
        $data['tanggal_masuk'] = $data['created_at'] ?? '';
        $data['jenis_id'] = AgendaJenis::where('name', 'Surat Dibahas')->value('id');
        $data['keterangan_id'] = AgendaKeterangan::where('name', 'Kew')->value('id');

        // Pastikan record dan relasi form ada
        if ($record && $record->form) {
            $data['perihal'] = 'Permohonan ' . $record->form->name;
        } else {
            $data['perihal'] = '';
        }

        return $data;
    }

    public function afterSave()
    {

        
        $this->record->update([
            'telah_dijadwalkan_sidang' => true,
        ]);
        AgendaDetail::create([
            'request_id' => $this->record->id,
            'no_surat' => $this->data['no_surat'],
            'dari' => $this->data['dari'],
            'tanggal_masuk' => $this->data['tanggal_masuk'],
            'agenda_id' => $this->data['agenda_id'],
            'jenis_id' => $this->data['jenis_id'],
            'keterangan_id' => $this->data['keterangan_id'],
            'perihal' => $this->data['perihal'],
            'usulan_keputusan' => $this->data['usulan_keputusan'],
        ]);

        $JenisPermohonan = Form::where('id', $this->record->form_id)->value('name');
        $notes = "Permohonan disetujui, menunggu hasil sidang pleno";
        $status = $this->record->requestStatus->name;
        // Kirim email
        $data = [
            'pemohon_nama' => $this->record->pemohon_nama,
            'pemohon_warga_blok' => $this->record->pemohon_warga_blok,
            'pemohon_alamat' => $this->record->pemohon_alamat,
            'form' => $JenisPermohonan,
            'status' => $status,
            'notes' => $notes,
        ];
        if ($this->record->pemohon_email) Mail::to($this->record->pemohon_email)->send(new RequestStatusesMail($data));

        $fonnteService = new FonnteService();
        $message = "Detail Permohonan:\n";
        $message .= "Nama: ".$this->record->pemohon_nama."\n";
        $message .= "Warga Blok/Pepanthan: ".$this->record->pemohon_warga_blok."\n";
        $message .= "Jenis Permohonan: $JenisPermohonan\n";
        $message .= "Status: $status\n";
        $message .= "Keterangan: " . $notes . "\n";
        $message .= "\nTerima kasih,\nAdmin Sekretariat GKJ Manahan Surakarta";
        $fonnteService->sendMessage($this->record->pemohon_hp_telepon, $message);
    }
}
