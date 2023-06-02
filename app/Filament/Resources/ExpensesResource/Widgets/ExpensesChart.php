<?php

namespace App\Filament\Resources\ExpensesResource\Widgets;

use Filament\Widgets\PieChartWidget;

class ExpensesChart extends PieChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }
}
