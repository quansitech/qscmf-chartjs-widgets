<?php
namespace ChartJs;

use ChartJs\ChartType\IChartType;
use Illuminate\Support\Str;

class Chart{

    protected $width;
    protected $height;
    protected $type;
    protected $custom_options;
    protected $labels;
    protected $data_sets;
    protected $title;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function setCustomOptions($options){
        $this->custom_options = $options;
        return $this;
    }

    public function setWidth($width){
        $this->width = $width;
        return $this;
    }

    public function setTitle(string $title) : self{
        $this->title = $title;
        return $this;
    }

    public function setHeight($height){
        $this->height = $height;
        return $this;
    }

    public function setLabels(array $labels){
        $this->labels = $labels;
        return $this;
    }

    public function addDataSet($label, $data, $background_color = null, $border_color = null){
        $this->data_sets[] = [
            'label' => $label,
            'data' => $data,
            'backgroundColor' => $background_color
        ];

        return $this;
    }

    protected function buildOptions(){
        return [
            'type' => $this->type,
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->data_sets
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'position' => 'top',
                        'title' => [
                            'display' => true,
                            'text' => $this->title,
                            'padding' => 5
                        ]
                    ]
                ]
            ]
        ];
    }

    protected function renderOptions(){
        $options = $this->buildOptions();

        $new_options = collect($options)->replaceRecursive($this->custom_options)->all();
        return json_encode($new_options, JSON_PRETTY_PRINT);
    }

    protected function startDiv(){
        if($this->width){
            $width_style = "width:{$this->width}px;";
        }

        if($this->height){
            $height_style = "height:{$this->height}px;";
        }

        if($width_style || $height_style){
            $style = "style='{$width_style}{$height_style}'";
        }

        return <<<html
<div {$style}>
html;
    }

    protected function endDiv(){
        return "</div>";
    }


    public function __toString()
    {
        $gid = Str::uuid()->getHex();

        return <<<html
{$this->startDiv()}
    <canvas id="{$gid}"></canvas>
{$this->endDiv()}
    <script>
    var ctx = document.getElementById('{$gid}');
    var myChart = new Chart(ctx, {$this->renderOptions()});
    </script>
html;

    }
}