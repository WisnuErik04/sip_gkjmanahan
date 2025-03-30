<?php

namespace App\Filament\Resources\VerifAgendaResource\Pages;

use App\Filament\Resources\VerifAgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVerifAgendas extends ListRecords
{
    protected static string $resource = VerifAgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
