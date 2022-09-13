<?php
namespace ChartJs\ChartType;


use ChartJs\Chart;

class Line extends Chart {

    public function addDataSet($label, $data, $background_color = null, $border_color = null){
        $this->data_sets[] = [
            'label' => $label,
            'data' => $data,
            'borderColor' => $border_color,
            'fill' => false
        ];

        return $this;
    }


}