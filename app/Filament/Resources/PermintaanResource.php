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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Widgets\StatsOverviewWidget\Card;
use DB;
use PhpParser\Node\Stmt\Label;

class PermintaanResource extends Resource
{
    protected static ?string $model = Permintaan::class;

    protected static ?string $navigationLabel = 'Permintaan';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\DatePicker::make('tgl_input')
                                                        ->label('Tanggal Input')
                                                        ->default(now())
                                                        ->disabled(),


                Forms\Components\Select::make('id_witel')   ->label('Witel')
                                                                ->options(Witel::all()->pluck('witel', 'id'))
                                                                ->required()
                                                                ->searchable(),

                Forms\Components\TextInput::make('name')    ->label('Nama AM/Hero')
                                                            ->required(),

                Forms\Components\Select::make('divisi')   ->label('Divisi')
                                                            ->options([
                                                                'enterprise' => 'Enterprise',
                                                                'government' => 'Government',
                                                                'business' => 'Business',
                                                            ]),

                Forms\Components\TextInput::make('no_telp')  ->label('No Telp')
                                                                    ->required(),

                Forms\Components\TextInput::make('nama_pelanggan')  ->label('Nama Pelanggan')
                                                                    ->required(),

                Forms\Components\Select::make('jenis_produk')   ->label('Jenis Produk')
                                                                    ->options([
                                                                        'connectivity' => 'Digital Connectivity',
                                                                        'service' => 'Digital Service',
                                                                        'platform' => 'Platform',
                                                                    ]),

                Forms\Components\MarkdownEditor::make('deskripsi')->toolbarButtons([
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
                ]),

                Forms\Components\FileUpload::make('lampiran') ->label('Lampiran')
                                                                    ->maxSize(1024)
                                                                    ->required(),

                Forms\Components\DatePicker::make('dateline')    ->label('Dateline')
                                                                    ->required(),

                // Forms\Components\Select::make('status')   ->label('Status')
                //                                             ->options([
                //                                                         'input' => 'Input',
                //                                                         'progess' => 'On Progress',
                //                                                         'solved' => 'Solved',
                //                                                     ]),

                Forms\Components\Radio::make('status')->label('Status')
                                                         ->options([
                                                         'input' => 'Input',
                                                         'progres' => 'On Progres',
                                                        'solved' => 'Solved',
                                                        'closed' => 'Closed'
                                                         ]),


                Forms\Components\FileUpload::make('lampiran2') ->label('Lampiran Lanjutan')
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
                ]),

                // Forms\Components\Select::make('kategori')        ->label('Kategori')
                //                                                  ->options([
                //                                                      'draft' => 'Draft',
                //                                                      'reviewing' => 'Reviewing',
                //                                                      'published' => 'Published',
                //                                                  ]),
                // Forms\Components\TextInput::make('jumlah')  ->label('Jumlah')
                //                                             ->required(),

                // Forms\Components\TextInput::make('lokasi')  ->label('Lokasi')
                //                                             ->required(),

                // // Forms\Components\TextInput::make('perkiraan_budget')    ->label('Perkiraan Budget')
                // //                                                         ->required(),

                // Forms\Components\TextInput::make('perkiraan_budget')->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: 'Rp. ', thousandsSeparator: ',', decimalPlaces: 2, isSigned: false))->required(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tgl Selesai
                Tables\Columns\TextColumn::make('dateline') ->label('Dateline')
                                                                ->sortable()
                                                                ->searchable(),

                // Witel
                Tables\Columns\TextColumn::make('witels.witel') ->label('Witel')
                                                            ->sortable()
                                                            ->searchable(),

                // Name
                Tables\Columns\TextColumn::make('name') ->sortable()
                                                        // ->icon('heroicon-s-user')
                                                        ->color('primary')
                                                        ->searchable(),
                // Pelanggan
                Tables\Columns\TextColumn::make('nama_pelanggan') ->sortable()
                                                        // ->icon('heroicon-s-user')
                                                        ->color('primary')
                                                        ->searchable(),

                // Jenis Produk
                Tables\Columns\TextColumn::make('jenis_produk') ->label('Jenis Produk')
                                                                ->sortable()
                                                                ->searchable(),

                // Status
                Tables\Columns\TextColumn::make('status') ->label('Status')
                                                                ->sortable()
                                                                ->searchable(),
                // // Tgl Input
                // Tables\Columns\TextColumn::make('tgl_input') ->label('Tanggal Input')
                //                                                 ->sortable()
                //                                                 ->searchable(),


                // // Kategori
                // Tables\Columns\TextColumn::make('kategori') ->label('Kategori')
                //                                                 ->sortable()
                //                                                 ->searchable(),
                // // Jumlah
                // Tables\Columns\TextColumn::make('jumlah') ->label('Jumlah')
                //                                                 ->sortable()
                //                                                 ->searchable(),
                // // Lokasi
                // Tables\Columns\TextColumn::make('lokasi') ->label('Lokasi')
                //                                                 ->sortable()
                //                                                 ->searchable(),
                // // Perkiraan Budget
                // Tables\Columns\TextColumn::make('perkiraan_budget') ->label('Perkiraan Budget')
                //                                                     ->money('idr')
                //                                                     ->sortable()
                //                                                     ->searchable(),
                // // Keterangan
                // Tables\Columns\TextColumn::make('keterangan') ->label('Keterangan')
                //                                                 ->sortable()
                //                                                 ->searchable(),
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
