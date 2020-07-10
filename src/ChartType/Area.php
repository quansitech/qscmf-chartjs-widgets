<?php
namespace ChartJs\ChartType;


use ChartJs\Chart;

class Area extends Chart {

    public function addDataSet($label, $data, $background_color){
        $this->data_sets[] = [
            'label' => $label,
            'data' => $data,
            'backgroundColor' => $background_color,
        ];

        return $this;
    }

    protected function buildOptions(){
        return [
            'type' => 'line',
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->data_sets
            ],
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

}