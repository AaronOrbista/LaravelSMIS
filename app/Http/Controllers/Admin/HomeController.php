<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'        => 'Item Stocks',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\Item',
            'group_by_field'     => 'name',
            'aggregate_function' => 'sum',
            'aggregate_field'    => 'quantity',
            'filter_field'       => 'created_at',
            'filter_period'      => 'week',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'        => 'Frequent Requests',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\ApprovedRequest',
            'group_by_field'     => 'control_number',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_period'      => 'month',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
        ];

        $chart2 = new LaravelChart($settings2);

        return view('home', compact('chart1', 'chart2'));
    }
}
