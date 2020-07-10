<?php
namespace ChartJs\ChartType;

use ChartJs\Chart;

class Bar extends Chart{

    public function addDataSet($label, $data, $background_color){
        $this->data_sets[] = [
            'label' => $label,
            'data' => $data,
            'backgroundColor' => $background_color,
        ];

        return $this;
    }
}