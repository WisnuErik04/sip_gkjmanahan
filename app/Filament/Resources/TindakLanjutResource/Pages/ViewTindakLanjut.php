<?php

namespace App\Filament\Resources\TindakLanjutResource\Pages;

use App\Filament\Resources\TindakLanjutResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTindakLanjut extends ViewRecord
{
    protected static string $resource = TindakLanjutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
