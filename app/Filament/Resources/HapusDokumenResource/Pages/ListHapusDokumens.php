<?php

namespace App\Filament\Resources\HapusDokumenResource\Pages;

use App\Filament\Resources\HapusDokumenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHapusDokumens extends ListRecords
{
    protected static string $resource = HapusDokumenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
