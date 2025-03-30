<?php

namespace App\Filament\Resources\RequestResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use App\Models\RequestStatus;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RequestResource;
use App\Models\Request;

class ListRequests extends ListRecords
{
    protected static string $resource = RequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'Semua' => Tab::make(),
        ];
    
        $counts = Request::selectRaw('request_status_id, COUNT(*) as total')
        ->groupBy('request_status_id')
        ->pluck('total', 'request_status_id');

        foreach (RequestStatus::orderBy('order')->get() as $status) {
            $tabs[Str::slug($status->name)] = Tab::make()
                ->label($status->name)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('request_status_id', $status->id))
                // ->badge(Request::query()->where('request_status_id', $status->id)->count())
                ->badge($counts[$status->id] ?? 0); // Ambil dari hasil query sebelumnya
                ;
        }
    
        return $tabs;
    }
}
