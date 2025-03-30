<?php

namespace App\Filament\Resources\LevelVerificationResource\Pages;

use App\Filament\Resources\LevelVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLevelVerifications extends ListRecords
{
    protected static string $resource = LevelVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
