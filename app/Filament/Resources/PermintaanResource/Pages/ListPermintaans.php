<?php

namespace App\Filament\Resources\PermintaanResource\Pages;

use App\Filament\Resources\PermintaanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermintaans extends ListRecords
{
    protected static string $resource = PermintaanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
