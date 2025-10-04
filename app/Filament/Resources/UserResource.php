<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Role;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        $schema = [
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                // Forms\Components\DateTimePicker::make('email_verified_at'),
                
            ];
            // $user_id = auth()->user()->id ?? 'xxx';
            // $schema[] = Forms\Components\TextInput::make('password')
            //             ->password()
            //             ->maxLength(255)
            //             ->revealable()
            //             ->required(fn ($livewire) => $livewire->record->id == $user_id)
            //             ->hidden(fn ($livewire) => $livewire->record->id != $user_id); // Sembunyikan jika user sedang mengedit dirinya sendiri

            // $role_id = auth()->user()->role_id;
            // $verifikator = Role::where('id', $role_id)->first();
            // if ($verifikator->name != 'Admin Sekretariat') {
            //     $schema[] = Forms\Components\Select::make('role_id')
            //         ->required()
            //         ->relationship('role', 'name')
            //         ->searchable()
            //         ->preload();
            // }
        
                $current_user_id = auth()->id();
             $schema[] = Forms\Components\TextInput::make('password')
        ->password()
        ->maxLength(255)
        ->revealable()
        // ->dehydrateStateUsing(fn (string $state): string => Hash::make($state)) // Hash password saat disimpan
            ->dehydrated(fn (?string $state): bool => filled($state)) // Hanya simpan jika diisi
        ->required(fn ($livewire, string $operation): bool => 
            // Wajib diisi saat membuat record BARU
            $operation === 'create' 
            // || 
            // Wajib diisi saat mengedit diri sendiri DAN ada password baru yang diketik
            // ($livewire->record->id == $current_user_id && $operation === 'edit')
        )
        // Sembunyikan field password saat Admin mengedit user lain (Bukan diri sendiri)
        ->hidden(fn ($livewire, string $operation) => 
            $operation === 'edit' && $livewire->record && $livewire->record->id !== $current_user_id
        )
        // Jika sedang Edit diri sendiri, beri label yang jelas
        ->label(fn ($livewire, string $operation) => 
            ($operation === 'edit' && $livewire->record->id == $current_user_id) ? 'Password Baru (Isi jika ingin diubah)' : 'Password'
        );

    // Logika Role ID (Pastikan Role::where() diimpor)
    if ($current_user_id) { // Cek apakah ada user yang login
        $verifikator = optional(auth()->user()->role)->name; // Ambil nama role dengan aman
        
        // Asumsi: Role Admin Sekretariat tidak boleh mengubah Role orang lain
        if ($verifikator != 'Admin Sekretariat') {
             $schema[] = Forms\Components\Select::make('role_id')
                ->required()
                ->relationship('role', 'name')
                ->searchable()
                ->preload();
        }
    }
            return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        $user_id = auth()->user()->id;
        $role_id = auth()->user()->role_id;
        $verifikator = Role::where('id', $role_id)->first();
    
        // Pastikan objek Role ditemukan sebelum mengakses propertinya
        if (!$verifikator) {
            abort(403, 'Role tidak ditemukan.');
        }
    
        if ($verifikator->name == 'Admin Sekretariat') {
            $table = $table->modifyQueryUsing(fn(Builder $query) => 
                $query->whereHas('role', fn($q) => $q->where('id', $user_id))
            );
        }
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('role.name')
                    ->numeric()
                    ->sortable()
                    ->sortable(),
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
                SelectFilter::make('role')
                    ->relationship('role', 'name')
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
