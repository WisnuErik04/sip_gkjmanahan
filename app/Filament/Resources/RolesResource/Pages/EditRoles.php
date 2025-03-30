<?php

namespace App\Filament\Resources\RolesResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\RolesResource;

class EditRoles extends EditRecord
{
    protected static string $resource = RolesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Data berhasil diperbarui!')
            ->success()
            ->send();

        $this->redirect(RolesResource::getUrl('index')); // Redirect ke index setelah edit
    }
}
