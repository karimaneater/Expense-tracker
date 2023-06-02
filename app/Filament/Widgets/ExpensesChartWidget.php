<?php

namespace Filament\Widgets;

use App\Models\Expenses;
use App\Models\ExpensesCategories;
use Filament\Widgets\PieChartWidget;

class ExpensesChartWidget extends PieChartWidget
{
    protected function getType(): string
    {
        return 'pie';
    }
    protected function getHeading(): string
    {
        return 'Expenses';
    }


    protected function getData(): array
    {

        function getRandomColor() {
            $letters = str_split('0123456789ABCDEF');
            $color = '#';
            for ($i = 0; $i < 6; $i++) {
                $color .= $letters[rand(0, 15)];
            }
            return $color;
        }

        $exp_id = Expenses::all()->pluck('expense_category_id');

        // $expenses = Expenses::all()->pluck('amount')->toArray();
        $label  = ExpensesCategories::all()->whereIn('id', $exp_id)->pluck('expense_category');
        $expenses = \App\Models\Expenses::query()
                    ->select('expense_category_id', \DB::raw('SUM(amount) as total_amount'))
                    ->groupBy('expense_category_id')
                    ->get()->toArray();

        $datas = [];
        $labels = [];



        foreach ($expenses as $key => $expense) {
            $expense_cat = \App\Models\ExpensesCategories::first()->where('id',$expense['expense_category_id'])->pluck('expense_category')->toArray();

            if(isset($expense_cat[0])){
                array_push($labels, $expense_cat[0]);
            };

            if(isset($expense['total_amount'])){
                array_push($datas, $expense['total_amount']);
            };



        }

         // Generate random background colors
         $backgroundColor = [];
         foreach ($expenses as $item) {
             $backgroundColor[] = getRandomColor();
         }



            return [

                'labels' => $labels,

                'datasets' => [
                    [
                        'label' => 'Expenses',
                        'data' => $datas,
                        'backgroundColor' => $backgroundColor,
                        'hoverOffset' => 4
                    ],
                ],

            ];



    }
}
