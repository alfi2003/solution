<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Name
                Forms\Components\TextInput::make('name')    ->required()
                                                            ->maxLength(255),
                // Email
                Forms\Components\TextInput::make('email')   ->email()
                                                            ->required()
                                                            ->maxLength(255),
                // Password
                Forms\Components\TextInput::make('password')->password()
                                                            ->required()
                                                            ->minLength(2)
                                                            ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Name
                Tables\Columns\TextColumn::make('name') ->sortable()
                                                        ->icon('heroicon-s-user')
                                                        ->color('primary')
                                                        ->searchable(),
                // Email
                Tables\Columns\TextColumn::make('email')->sortable()
                                                        ->color('success')
                                                        ->icon('heroicon-s-mail')
                                                        ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
