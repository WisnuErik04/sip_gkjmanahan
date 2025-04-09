<?php

namespace App\Filament\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ListUploadForm;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ListUploadFormRelationManager extends RelationManager
{
    protected static string $relationship = 'listUploadForm';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Upload')
                    ->required()
                    ->maxLength(255),
                
                // TextInput::make('name')
                //     ->required(),

                Fieldset::make('Detail')
                    ->schema([
                        Select::make('upload_type')
                            ->label('Jenis Upload')
                            ->options([
                                'image' => 'Gambar',
                                'pdf'    => 'PDF',
                            ])
                            ->reactive()
                            ->required(),
                        
                        TextInput::make('order')
                            ->required()
                            ->label('Urutan')
                            ->default(ListUploadForm::where('form_id', $this->ownerRecord->id)->count() + 1 ?? 111)
                            // ->default(1)
                            ->numeric(),
    
                        Toggle::make('is_required')
                            ->label('Wajib diisi?')
                            ->default(true),
                    ])
                    ->columns(3), 
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextInputColumn::make('order')->label('Urutan')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('upload_type')
                    ->label('Jenis Upload')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'image' => 'warning',
                        'pdf' => 'success',
                    })
                    ->sortable(),
                ToggleColumn::make('is_required')
                    ->label('Wajib?') ,
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
