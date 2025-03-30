<?php

namespace App\Filament\Resources\VerifAgendaResource\Pages;

use App\Filament\Resources\VerifAgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerifAgenda extends EditRecord
{
    protected static string $resource = VerifAgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
