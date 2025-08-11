<?php

namespace App\Filament\Resources\VerificationResource\Pages;

use App\Models\Form;
use App\Models\Role;
use Filament\Actions;
use App\Models\Verification;
use App\Models\RequestStatus;
use App\Services\FonnteService;
use App\Mail\RequestStatusesMail;
use App\Models\VerificationStatus;
use Illuminate\Support\Facades\Mail;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\VerificationResource;

class EditVerification extends EditRecord
{
    protected static string $resource = VerificationResource::class;
    protected static ?string $title = "Verifikasi Permohonan";

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
    
    public function afterSave()
    {
        $sendEmail = 'n';
        $verifName = VerificationStatus::where('id', $this->data['verification_status_id'])->pluck('name')->first();
        if ($verifName == 'Disetujui') {
            $role_id = auth()->user()->role_id;
            $verifikator = Role::with(['levelVerification' => fn($query) => $query->select('id', 'order')])
            ->where('id', $role_id)
            ->first();
            $levelValidator = $verifikator->levelVerification->order;
            $requestStatusUpdate = ($levelValidator == '1')
            ? RequestStatus::where('name', 'Diproses')->pluck('id')->first()
            : RequestStatus::where('name', 'Agenda')->pluck('id')->first();
            // if ($levelValidator == '2') $sendEmail = 'y';
            $sendEmail = 'n';
        } else {
            // DITOLAK
            $requestStatusUpdate = RequestStatus::where('name', $verifName)->pluck('id')->first();
            $sendEmail = 'y';
        }
        // Update status permohonan
        $this->record->update([
            'request_status_id' => $requestStatusUpdate,
        ]);
        Verification::create([
            'request_id' => $this->record->id,
            'verification_status_id' => $this->data['verification_status_id'],
            'user_id' => auth()->user()->id,
            'notes' => $this->data['keterangan'],
            'approved_by' => auth()->user()->name,
        ]);
        // dd($requestStatusUpdate, $levelValidator);

        if ($sendEmail == 'y') {
            $JenisPermohonan = Form::where('id', $this->record->form_id)->value('name');
            $data = [
                'pemohon_nama' => $this->record->pemohon_nama,
                'pemohon_warga_blok' => $this->record->pemohon_warga_blok,
                'pemohon_alamat' => $this->record->pemohon_alamat,
                'form' => $JenisPermohonan,
                'status' => $verifName,
                'notes' => $this->data['keterangan'],
            ];
            if ($this->record->pemohon_email) Mail::to($this->record->pemohon_email)->send(new RequestStatusesMail($data));

            $fonnteService = new FonnteService();
            $message = "Detail Permohonan:\n";
            $message .= "Nama: $this->record->pemohon_nama\n";
            $message .= "Warga Blok/Pepanthan: $this->record->pemohon_warga_blok\n";
            $message .= "Jenis Permohonan: $JenisPermohonan\n";
            $message .= "Status: $verifName\n";
            $message .= "Keterangan: " . $this->data['keterangan'] . "\n";
            $message .= "\nThanks,\nAdmin Sekretariat GKJ Manahan Surakarta";
            $fonnteService->sendMessage($this->record->pemohon_hp_telepon, $message);
        }
    }
}
