# qscmf-chartjs-widgets
基于chartjs封装的qscmf后台模块化组件

## 安装

```php
composer require quansitech/qscmf-chartjs-widgets
```

## 控件列表
+ [Area](https://github.com/quansitech/qscmf-chartjs-widgets#Area)
+ [Bar](https://github.com/quansitech/qscmf-chartjs-widgets#Bar)
+ [Line](https://github.com/quansitech/qscmf-chartjs-widgets#Line)

### 通用用法
Area Bar Line都是Chart的子类，也是简化开发预设好的类，这里介绍父类Chart的通用用法。


```php
//实例化对象
//类型参数可以是chartjs支持的任意类型
//如果是ChartType中已经预设好的类型，会提供一系列内置好的预设属性，简化需要设置的参数
$area = Factory::getInstance('area');

//设置chartjs外层div的宽度和高度，假如不设置，chartjs将会自适应其外层父容器
$area->setWidth(200);
$area->setHeight(200);

//设置x坐标标签
$area->setLabels(['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange']);

//设置图形标题
$area->setTitle("销售量统计")

//添加数据源，可以添加多个维度的数据
//第一个参数该维度数据标题
//第二个参数，数据组
$area->addDataSet('销售量', [12, 19, 3, 5, 2, 3]);

//可自定义详细的chartjs options配置，合并到组件中
//该方法用于有更多自定义需求的业务场景
$options=[
    'data' => [
        'datasets' => [
            [
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                'borderColor' => [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                'borderWidth' => 1
            ]
        ]
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
$area->setCustomOptions($options);
```

### Area
预设的area类型

```php
$area = Factory::getInstance('area');
$lables = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
$area->setLabels($lables);

//area类型扩展了第三个参数，可通过第三个参数来设置维度数据的表现背景色
$area->addDataSet('捐赠金额', [12, 19, 3, 5, 2, 3], '#ff851b');
```

### Bar
预设的bar类型
```php
$bar = Factory::getInstance('bar');
$lables = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
$bar->setLabels($lables);

//area类型扩展了第三个参数，可通过第三个参数来设置维度数据的表现背景色
$bar->addDataSet('捐赠金额', [12, 19, 3, 5, 2, 3], '#ff851b');
```

### Line
预设的line类型
```php
$line = Factory::getInstance('line');
$lables = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
$line->setLabels($lables);

//area类型扩展了第三个参数，可通过第三个参数来设置维度数据的线条颜色
$line->addDataSet('捐赠金额', [12, 19, 3, 5, 2, 3], '#ff851b');
```

### Pie
预设的Pie类型
```php
$line = Factory::getInstance('pie');
$lables = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
$line->setLabels($lables);

//area类型扩展了第三个参数，可通过第三个参数来设置维度数据的线条颜色
$line->addDataSet('捐赠金额', [12, 19, 3, 5, 2, 3], [
    '#4dc9f6',
    '#f67019',
    '#f53794',
    '#537bc4',
    '#acc236',
    '#166a8f',
    '#00a950',
    '#58595b',
    '#8549ba'
]);
```

### 辅助方法

genLastDayLabels 快速生成过去N天的labels
```php
//第一个参数 指定天数
//第二个参数 日期展示模板 默认 'm/d'
Helper::genLastDayLabels(15, 'm/d');
```

genLastMonthLabelsPerDay 快速生成过去N个月以天为单位的labels
```php
//第一个参数 指定月份
//第二个参数 日期展示模板 默认 'm/d'
Helper::genLastMonthLabelsPerDay(1, 'm/d');
```

### 完整样例代码
配合[adminlte](https://github.com/quansitech/qscmf-adminlte-widgets)组件完成一个简单统计页面的开发

```php
$content = new Content($this->view);
$content->title('网站概况');

$join_line = Factory::getInstance('line');
$join_line->setLabels(Helper::genLastDayLabels(15));

$join_data = [1,2,0,4,5,6,7,28,19,0,39, 30,23,12,34];
$join_line->addDataSet('参与人数', $join_data, '#17a2b8');

$read_bar = Factory::getInstance('bar');
$read_bar->setLabels(Helper::genLastDayLabels(15));
$read_data = [1,2,0,4,5,6,7,28,19,0,39, 30,23,12,34];
$read_bar->addDataSet('阅读记录', $read_data, '#28a745');

$doante_area = Factory::getInstance('area');
$doante_area->setLabels(Helper::genLastDayLabels(15));
$donate_data = [1,2,0,4,5,6,7,28,19,0,39, 30,23,12,34];
$doante_area->addDataSet('捐赠金额', $donate_data, '#ff851b');

$card_row = new Row();
$card_row->addColumn($join_line, 4);
$card_row->addColumn($read_bar, 4);
$card_row->addColumn($doante_area, 4);
$content->addRow(new Card($card_row, '统计', 'danger'));

$content->display();
```

