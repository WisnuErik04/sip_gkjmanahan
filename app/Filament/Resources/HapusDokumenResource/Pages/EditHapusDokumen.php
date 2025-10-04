<?php

namespace App\Filament\Resources\HapusDokumenResource\Pages;

use App\Filament\Resources\HapusDokumenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHapusDokumen extends EditRecord
{
    protected static string $resource = HapusDokumenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
