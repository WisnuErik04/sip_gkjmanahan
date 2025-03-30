<?php

namespace App\Filament\Resources\LevelVerificationResource\Pages;

use App\Filament\Resources\LevelVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLevelVerification extends EditRecord
{
    protected static string $resource = LevelVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
