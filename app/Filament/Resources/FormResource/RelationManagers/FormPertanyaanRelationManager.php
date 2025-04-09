<?php

namespace App\Filament\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FormPertanyaan;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class FormPertanyaanRelationManager extends RelationManager
{
    protected static string $relationship = 'formPertanyaan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TextInput::make('pertanyaan')
                ->label('Pertanyaan')
                ->required(),
                TextInput::make('placeholder'),
                
                Section::make()->schema([
                    Fieldset::make('Detail')
                        ->schema([
                            Select::make('tipe_jawaban')
                                ->label('Tipe Jawaban')
                                ->options([
                                    'text' => 'Text',
                                    'textarea' => 'Textarea',
                                    'select' => 'Select',
                                    'checkbox' => 'Checkbox',
                                    'radio' => 'Radio',
                                    'header' => 'Header',
                                ])
                                ->reactive()
                                ->required(),

                            TextInput::make('order')
                                ->required()
                                ->label('Urutan')
                                ->default(FormPertanyaan::where('form_id', $this->ownerRecord->id)->count() + 1 ?? 111)
                                // ->default(1)
                                ->numeric(),

                            Toggle::make('required')
                                ->label('Wajib diisi?')
                                ->default(true),
                        ])
                        ->columns(3),


                    Repeater::make('opsi_jawaban')
                        ->label('Opsi Jawaban')
                        ->schema([
                            TextInput::make('label')->label('Opsi')->required(),
                        ])
                        ->collapsed()
                        ->hidden(fn(Forms\Get $get) => !in_array($get('tipe_jawaban'), ['select', 'checkbox', 'radio']))
                        // ->default([]) // Pastikan default adalah array kosong
                        // ->afterStateHydrated(function ($state, Forms\Set $set) {
                        //     // Pastikan data diubah menjadi array jika masih string JSON
                        //     dd('asasasa');
                        //     if (is_string($state)) {
                        //         dd('asasasa');
                        //         $set('opsi_jawaban', json_decode($state, true) ?? []);
                        //     }
                        // })
                        // ->dehydrateStateUsing(fn ($state) => json_encode($state)) // Simpan sebagai JSON di database
                        // ->mutateDehydratedStateUsing(fn ($state) => json_encode($state)) // Pastikan tetap JSON saat save
                        ,
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('pertanyaan')
            ->columns([
                TextInputColumn::make('order')->label('Urutan')->sortable(),
                TextColumn::make('pertanyaan')->label('Pertanyaan')->searchable(),
                TextColumn::make('tipe_jawaban')
                    ->label('Tipe Jawaban')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'text' => 'gray',
                        'textarea' => 'primary',
                        'select' => 'info',
                        'checkbox' => 'warning',
                        'radio' => 'success',
                        'header' => 'danger',
                    })
                    ->sortable(),
                ToggleColumn::make('required')
                    ->label('Wajib?'),

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
