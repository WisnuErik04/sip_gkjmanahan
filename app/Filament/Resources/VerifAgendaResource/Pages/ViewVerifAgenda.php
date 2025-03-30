<?php

namespace App\Filament\Resources\VerifAgendaResource\Pages;

use App\Filament\Resources\VerifAgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVerifAgenda extends ViewRecord
{
    protected static string $resource = VerifAgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
