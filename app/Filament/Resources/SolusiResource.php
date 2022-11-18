<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolusiResource\Pages;
use App\Filament\Resources\SolusiResource\RelationManagers;
use App\Models\Solusi;
use App\Models\Witel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SolusiResource extends Resource
{
    protected static ?string $model = Solusi::class;
    // protected static ?string $title = 'Solusi';
    // protected static ?string $slug = 'custom-url-slug';
    // protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Solusi';
    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Name
                Forms\Components\TextInput::make('name')->required(),

                //Witel
                Forms\Components\Select::make('id_witel')   ->label('Witel')
                                                            ->options(Witel::all()->pluck('witel', 'id'))
                                                            ->required()
                                                            ->searchable(),
                // Tanggal
                Forms\Components\DatePicker::make('tanggal') ->label('Tanggal')
                                                             ->required(),

                // File
                Forms\Components\FileUpload::make('solusi') ->label('Solusi')
                                                            ->required()
                                                            ->maxSize(1024),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Name
                Tables\Columns\TextColumn::make('name')->label('Nama')
                                                        ->sortable()
                                                        ->searchable(),
                // Witel
                Tables\Columns\TextColumn::make('witels.witel') ->label('Witel')
                                                                ->sortable()
                                                                ->searchable(),
                // Tanggal
                Tables\Columns\TextColumn::make('tanggal')  ->label('Tanggal')
                                                            ->sortable()
                                                            ->searchable(),

                Tables\Columns\ImageColumn::make('solusi')->circular(),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('id_witel')   ->label('Witel')
                                                                ->options(Witel::all()->pluck('witel', 'id'))
                                                                ->searchable(),

                Tables\Filters\Filter::make('tanggal')      ->form([
                                                                    Forms\Components\DatePicker::make('start_date')->label('Start date'),
                                                                    Forms\Components\DatePicker::make('end_date')->label('End date'),
                                                                ])
                                                                ->query(function (Builder $query, array $data): Builder {
                                                                    return $query
                                                                        ->when(
                                                                            $data['start_date'],
                                                                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                                                                        )
                                                                        ->when(
                                                                            $data['end_date'],
                                                                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                                                                        );
                                                            }),

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
            'index' => Pages\ListSolusis::route('/'),
            'create' => Pages\CreateSolusi::route('/create'),
            'edit' => Pages\EditSolusi::route('/{record}/edit'),
        ];
    }
}
