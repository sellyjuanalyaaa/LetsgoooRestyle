<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Card; // Diperlukan untuk komponen Card
use Filament\Forms\Components\RichEditor; // Diperlukan untuk RichEditor
use Filament\Forms\Components\Select; // Diperlukan untuk Select
use Filament\Forms\Components\TextInput; // Diperlukan untuk TextInput
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup; // Diperlukan untuk BulkActionGroup
use Filament\Tables\Actions\DeleteAction; // Diperlukan untuk DeleteAction
use Filament\Tables\Actions\DeleteBulkAction; // Diperlukan untuk DeleteBulkAction
use Filament\Tables\Actions\EditAction; // Diperlukan untuk EditAction
use Filament\Tables\Columns\TextColumn; // Diperlukan untuk TextColumn
use Filament\Tables\Filters\SelectFilter; // Diperlukan untuk SelectFilter
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->label('Alamat Email')
                        ->email()
                        ->required()
                        ->maxLength(255),

                    TextInput::make('password')
                        ->label('Kata Sandi')
                        ->password()
                        ->required()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->visibleOn('create'), // Hanya terlihat saat membuat pengguna baru

                    Select::make('role')
                        ->label('Peran')
                        ->options([
                            'pembeli' => 'Pembeli',
                            'penjual' => 'Penjual',
                            'admin' => 'Admin',
                        ])
                        ->required()
                        ->default('pembeli'),

                    RichEditor::make('preferensi_style')
                        ->label('Preferensi Gaya')
                        ->nullable(),

                    TextInput::make('warna_favorit')
                        ->label('Warna Favorit')
                        ->nullable(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->label('Peran')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Bergabung')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Peran')
                    ->options([
                        'pembeli' => 'Pembeli',
                        'penjual' => 'Penjual',
                        'admin' => 'Admin',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}