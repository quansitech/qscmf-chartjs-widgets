<?php
namespace ChartJs;

use ChartJs\ChartType\IChartType;

class Factory{

    public static function getInstance($type){
        $type = ucfirst($type);
        $cls = "\\ChartJs\\ChartType\\{$type}";
        if(!class_exists($cls)){
            $cls = "\\ChartJs\\Chart";
        }
        $instance = new $cls(strtolower($type));
        if(!$instance instanceof Chart){
            E("chartjs {$type} 不是有效类型");
        }

        return $instance;
    }
}