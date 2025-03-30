<?php

namespace App\Filament\Resources\RolesResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\RolesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRoles extends CreateRecord
{
    protected static string $resource = RolesResource::class;

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Data berhasil disimpan!')
            ->success()
            ->send();

        $this->redirect(RolesResource::getUrl('index')); // Redirect ke index setelah simpan
    }
}
