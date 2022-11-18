<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\Witel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')    ->required(),

                Forms\Components\Select::make('id_witel')   ->label('Witel')
                                                            ->options(Witel::all()->pluck('witel', 'id'))
                                                            ->required()
                                                            ->searchable(),

                Forms\Components\DatePicker::make('tgl_input')  ->label('Tanggal Input')
                                                                ->required(),

                Forms\Components\DatePicker::make('tgl_selesai')    ->label('Tanggal Selesai')
                                                                    ->required(),

                Forms\Components\FileUpload::make('solusi') ->label('File Upload')
                                                            ->maxSize(1024)
                                                            ->required(),

                Forms\Components\Select::make('jenis_produk')   ->label('Jenis Produk')
                                                                ->options([
                                                                    'draft' => 'Draft',
                                                                    'reviewing' => 'Reviewing',
                                                                    'published' => 'Published',
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

                Forms\Components\TextInput::make('perkiraan_budget')    ->label('Perkiraan Budget')
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
                // Name
                Tables\Columns\TextColumn::make('name') ->sortable()
                                                        // ->icon('heroicon-s-user')
                                                        ->color('primary')
                                                        ->searchable(),
                // Witel
                Tables\Columns\TextColumn::make('id_witel') ->label('Witel')
                                                            ->sortable()
                                                            ->searchable(),
                // Tgl Input
                Tables\Columns\TextColumn::make('tgl_input') ->label('Tanggal Input')
                                                                ->sortable()
                                                                ->searchable(),
                // Witel
                Tables\Columns\TextColumn::make('tgl_selesai') ->label('Tanggal Selesai')
                                                                ->sortable()
                                                                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
