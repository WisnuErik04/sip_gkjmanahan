<?php

namespace App\Filament\Resources\VerificationResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use App\Models\RequestStatus;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VerificationResource;

class ListVerifications extends ListRecords
{
    protected static string $resource = VerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    
}
