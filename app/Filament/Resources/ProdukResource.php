<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')->label('Nama')
                                                        ->required(),


                Forms\Components\FileUpload::make('produk') ->label('Produk')
                ->maxSize(1024)
                ->required(),

                Forms\Components\MarkdownEditor::make('keterangan')->toolbarButtons([
                    'attachFiles',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'edit',
                    'italic',
                    'link',
                    'orderedList',
                    'preview',
                    'strike',
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                //Nama
                Tables\Columns\TextColumn::make('name')->label('Nama')
                                                        ->sortable()
                                                        ->searchable(),
                // Produk
                Tables\Columns\ImageColumn::make('produk')->size(150),

                // Keterangan
                Tables\Columns\TextColumn::make('keterangan')->wrap(),
                                                        // ->sortable()
                                                        // ->icon('heroicon-s-user')
                                                        // ->color('primary')
                                                        // ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
