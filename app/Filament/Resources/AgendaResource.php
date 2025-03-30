<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AgendaDetail;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AgendaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgendaResource\RelationManagers;
use App\Filament\Resources\AgendaResouceResource\RelationManagers\AgendaDetailsRelationManager;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    public static function getNavigationLabel(): string{ return 'Agenda'; }
    public static function getPluralLabel(): string{ return 'Agenda'; }

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Pleno';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tgl_rapat')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) =>  
                $query->withCount('agendaDetails')
            )
            ->columns([
                Tables\Columns\TextColumn::make('tgl_rapat')
                    ->date()
                    // ->searchable()
                    ->sortable()
                    // ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->translatedFormat('d F Y')),
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)
                        ->locale('id') // Set locale ke Indonesia
                        ->translatedFormat('d F Y')),
    
                Tables\Columns\TextColumn::make('agenda_details_count')
                    ->label('Total Agenda'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tgl_rapat', 'desc') // Mengurutkan berdasarkan tanggal terbaru
            ->filters([
                Filter::make('tgl_rapat')
                    ->form([
                        DatePicker::make('tgl_rapat_dari'),
                        DatePicker::make('tgl_rapat_hingga'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tgl_rapat_dari'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tgl_rapat', '>=', $date),
                            )
                            ->when(
                                $data['tgl_rapat_hingga'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tgl_rapat', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['tgl_rapat_dari'] ?? null) {
                            $indicators[] = Indicator::make('Tgl pengajuan dari ' . Carbon::parse($data['tgl_rapat_dari'])->toFormattedDateString())
                                ->removeField('tgl_rapat_dari');
                        }

                        if ($data['tgl_rapat_hingga'] ?? null) {
                            $indicators[] = Indicator::make('Tgl pengajuan hingga ' . Carbon::parse($data['tgl_rapat_hingga'])->toFormattedDateString())
                                ->removeField('tgl_rapat_hingga');
                        }

                        return $indicators;
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AgendaDetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'view' => Pages\ViewAgenda::route('/{record}'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}
