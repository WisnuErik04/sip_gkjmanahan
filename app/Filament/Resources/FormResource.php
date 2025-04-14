<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ListUploadForm;
use Filament\Resources\Resource;
use App\Models\Form as FormModel;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FormResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FormResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\FormResource\RelationManagers\FormPertanyaanRelationManager;
use App\Filament\Resources\FormResource\RelationManagers\ListUploadFormRelationManager;

class FormResource extends Resource 
{
    protected static ?string $model = FormModel::class;

    public static function getNavigationLabel(): string{ return 'Master Form'; }
    public static function getPluralLabel(): string{ return 'Master Form'; }

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationGroup = 'Form Permohonan';
    protected static ?int $navigationSort = 3;
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Form Permohonan')
                    ->description('Informasi form yang disediakan')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('order')
                                ->required()
                                ->label('Urutan')
                                ->default(1)
                                ->numeric(),
                        Forms\Components\Toggle::make('is_active')
                                ->label('Aktif')
                                ->default(true),

                        Forms\Components\RichEditor::make('content')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                    ])
                    // ->columns(2)
                    ->collapsible(),
                // Forms\Components\Repeater::make('ListUploadForm')
                //     ->relationship('listUploadForm') // Hubungkan dengan model bahan
                //     ->schema([
                //         Forms\Components\TextInput::make('name')
                //             ->required(),
                //         Forms\Components\Select::make('upload_type')
                //             ->label('Jenis Upload')
                //             ->options([
                //                 'gambar' => 'Gambar',
                //                 'pdf'    => 'PDF',
                //             ])
                //             ->required()
                //             ->preload()
                //             ->searchable(),
                //         Forms\Components\TextInput::make('order')
                //             ->required()
                //             ->label('Urutan')
                //             ->numeric(),
                //         Forms\Components\Checkbox::make('is_required')
                //             ->inline()
                //             ->label('Wajin upload'),
                //     ])
                //     ->minItems(1) // Minimal 1 bahan
                //     ->columnSpanFull()
                //     ->reorderable()
                //     ->reorderableWithButtons()
                //     ->columns(3)
                //     ->afterStateUpdated(fn ($state, $set) => static::updateOrder($state, $set)), // Urutkan saat update
            ]);
    }

    protected static function updateOrder($state, $set)
    {
        if (!$state) return;
        $order = 0;
        foreach ($state as $index => $item) {
            $set("ListUploadForm.{$index}.order", $order + 1);
            $order++;
        }
    } 


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextInputColumn::make('order')->label('Urutan')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
                Tables\Columns\TextColumn::make('listUploadForm.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            FormPertanyaanRelationManager::class,
            ListUploadFormRelationManager::class,
        ];
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            // 'view' => Pages\ViewForm::route('/{record}'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
