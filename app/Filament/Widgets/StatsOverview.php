<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use DB;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            // Card::make('Unique views', '192.1k'),
            // Card::make('Unique views', '192.1k')
            // ->description('32k increase')
            // ->descriptionIcon('heroicon-s-trending-up')
            // ->chart([7, 2, 10, 3, 15, 4, 17])
            // ->color('success'),
            Card::make('Produk', DB::table('produk')->count()),
            Card::make('Permintaan', DB::table('permintaan')->count()),
            Card::make('Solusi', DB::table('solusis')->count()),
            Card::make('User', DB::table('users')->count()),
        ];
    }
}
