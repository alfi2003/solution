<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;

class ProdukChartBar extends BarChartWidget
{
    protected static ?string $heading = 'Bar Chart';
    protected static ?string $pollingInterval = '10s';
    protected static ?string $maxHeight = '300px';
    public ?string $filter = 'today';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        return [
            'datasets' => [
                [
                    'label' => 'produk created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],[
                    'label' => 'permintaan created',
                    'data' => [ 45, 74, 65, 45, 77, 890, 10, 5, 2, 21, 32,],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
        ],
    ];
}
