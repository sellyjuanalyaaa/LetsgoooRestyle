<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->autofocus()
                        ->label('Nama Produk'),

                    RichEditor::make('deskripsi')
                        ->label('Deskripsi Produk'),

                    Select::make('kategori_id')
                        ->label('Kategori')
                        ->options(Category::pluck('nama_kategori', 'id'))
                        ->required(),

                    TextInput::make('harga')
                        ->required()
                        ->numeric()
                        ->prefix('IDR')
                        ->label('Harga'),

                    TextInput::make('kondisi')
                        ->required()
                        ->label('Kondisi'),

                    TextInput::make('ukuran')
                        ->nullable()
                        ->label('Ukuran'),

                    TextInput::make('warna')
                        ->nullable()
                        ->label('Warna'),

                    TextInput::make('stok')
                        ->required()
                        ->numeric()
                        ->placeholder('Jumlah stok')
                        ->label('Stok'),

                    FileUpload::make('foto')
                        ->image()
                        ->directory('products')
                        ->nullable()
                        ->label('Foto Produk'),
                        
                    Select::make('penjual_id')
                        ->label('Penjual')
                        ->options(User::pluck('name', 'id'))
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
