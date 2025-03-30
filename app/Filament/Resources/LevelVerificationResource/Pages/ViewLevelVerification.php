<?php

namespace App\Filament\Resources\LevelVerificationResource\Pages;

use App\Filament\Resources\LevelVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLevelVerification extends ViewRecord
{
    protected static string $resource = LevelVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
