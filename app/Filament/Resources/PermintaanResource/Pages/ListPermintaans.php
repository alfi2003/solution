<?php

namespace App\Filament\Resources\PermintaanResource\Pages;

use App\Filament\Resources\PermintaanResource;
use Filament\Facades\Filament;
use Filament\Pages\Actions;
use App\Filament\Widgets\StatsOverview;
use Filament\Resources\Pages\ListRecords;

class ListPermintaans extends ListRecords
{
    protected static string $resource = PermintaanResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
