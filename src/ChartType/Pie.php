<?php
namespace ChartJs\ChartType;


use ChartJs\Chart;

class Pie extends Chart {

    public function addDataSet($label, $data, $background_color = null, $border_color = null){
        $this->data_sets[] = [
            'label' => $label,
            'data' => $data,
            'backgroundColor' => $background_color,
        ];

        return $this;
    }

}