<?php

namespace App\Filament\Resources\SolusiResource\Pages;

use App\Filament\Resources\SolusiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSolusis extends ListRecords
{
    protected static string $resource = SolusiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
