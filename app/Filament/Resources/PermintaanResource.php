<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermintaanResource\Pages;
use App\Filament\Resources\PermintaanResource\RelationManagers;
use App\Models\Permintaan;
use App\Models\Witel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class PermintaanResource extends Resource
{
    protected static ?string $model = Permintaan::class;

    protected static ?string $navigationLabel = 'Permintaan';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tgl_input')  ->label('Tanggal Input')
                                                                ->required(),

                Forms\Components\Select::make('id_witel')   ->label('Witel')
                                                                ->options(Witel::all()->pluck('witel', 'id'))
                                                                ->required()
                                                                ->searchable(),

                Forms\Components\Select::make('divisi')   ->label('Divisi')
                                                                ->options([
                                                                    'enterprise' => 'Enterprise',
                                                                    'government' => 'Government',
                                                                    'business' => 'Business',
                                                                ]),

                Forms\Components\TextInput::make('name')    ->label('Nama AM/Hero')
                                                            ->required(),

                Forms\Components\TextInput::make('nama_pelanggan')  ->label('Nama Pelanggan')
                                                                    ->required(),

                Forms\Components\TextInput::make('permintaan')  ->label('Permintaan')
                                                                    ->required(),


                Forms\Components\DatePicker::make('tgl_selesai')    ->label('Tanggal Selesai')
                                                                    ->required(),

                Forms\Components\FileUpload::make('solusi') ->label('Solusi')
                                                            ->maxSize(1024)
                                                            ->required(),

                Forms\Components\Select::make('jenis_produk')   ->label('Jenis Produk')
                                                                ->options([
                                                                    'connectivity' => 'Connectivity',
                                                                    'digital' => 'Digital Solution',
                                                                    'data' => 'Data',
                                                                ]),

                Forms\Components\Select::make('kategori')        ->label('Kategori')
                                                                 ->options([
                                                                     'draft' => 'Draft',
                                                                     'reviewing' => 'Reviewing',
                                                                     'published' => 'Published',
                                                                 ]),
                Forms\Components\TextInput::make('jumlah')  ->label('Jumlah')
                                                            ->required(),

                Forms\Components\TextInput::make('lokasi')  ->label('Lokasi')
                                                            ->required(),

                // Forms\Components\TextInput::make('perkiraan_budget')    ->label('Perkiraan Budget')
                //                                                         ->required(),

                Forms\Components\TextInput::make('perkiraan_budget')->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: 'Rp. ', thousandsSeparator: ',', decimalPlaces: 2, isSigned: false))->required(),


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
                // Name
                Tables\Columns\TextColumn::make('name') ->sortable()
                                                        // ->icon('heroicon-s-user')
                                                        ->color('primary')
                                                        ->searchable(),
                // Witel
                Tables\Columns\TextColumn::make('witels.witel') ->label('Witel')
                                                            ->sortable()
                                                            ->searchable(),
                // Tgl Input
                Tables\Columns\TextColumn::make('tgl_input') ->label('Tanggal Input')
                                                                ->sortable()
                                                                ->searchable(),
                // Tgl Selesai
                Tables\Columns\TextColumn::make('tgl_selesai') ->label('Tanggal Selesai')
                                                                ->sortable()
                                                                ->searchable(),
                // Jenis Produk
                Tables\Columns\TextColumn::make('jenis_produk') ->label('Jenis Produk')
                                                                ->sortable()
                                                                ->searchable(),
                // Kategori
                Tables\Columns\TextColumn::make('kategori') ->label('Kategori')
                                                                ->sortable()
                                                                ->searchable(),
                // Jumlah
                Tables\Columns\TextColumn::make('jumlah') ->label('Jumlah')
                                                                ->sortable()
                                                                ->searchable(),
                // Lokasi
                Tables\Columns\TextColumn::make('lokasi') ->label('Lokasi')
                                                                ->sortable()
                                                                ->searchable(),
                // Perkiraan Budget
                Tables\Columns\TextColumn::make('perkiraan_budget') ->label('Perkiraan Budget')
                                                                    ->money('idr')
                                                                    ->sortable()
                                                                    ->searchable(),
                // Keterangan
                Tables\Columns\TextColumn::make('keterangan') ->label('Keterangan')
                                                                ->sortable()
                                                                ->searchable(),
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
            'index' => Pages\ListPermintaans::route('/'),
            'create' => Pages\CreatePermintaan::route('/create'),
            'edit' => Pages\EditPermintaan::route('/{record}/edit'),
        ];
    }
}
