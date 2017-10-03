[![Build Status](https://travis-ci.org/yusrilhs/ChartJsPhpHelper.svg?branch=master)](https://travis-ci.org/yusrilhs/ChartJsPhpHelper)
[![codecov](https://codecov.io/gh/yusrilhs/ChartJsPhpHelper/branch/master/graph/badge.svg)](https://codecov.io/gh/yusrilhs/ChartJsPhpHelper)
[![Latest Stable Version](https://poser.pugx.org/yusrilhs/chartjs-php-helper/v/stable)](https://packagist.org/packages/yusrilhs/chartjs-php-helper)
[![License](https://poser.pugx.org/yusrilhs/chartjs-php-helper/license)](https://packagist.org/packages/yusrilhs/chartjs-php-helper)
# ChartJsPhpHelper
A Simple Helper for Chart.js using PHP

## Installation
`composer require yusrilhs/chartjs-php-helper`

## Usage
#### Initialize Chart
For initialize your chart
```php
use YusrilHs\ChartJsHelper\ChartJsHelper;

$chart = ChartJsHelper::createChart('line');
```
the argument on `createChart` is type of charts on Chart.Js see [here](http://www.chartjs.org/docs/latest/charts/)

#### Labels
To add labels for your chart just add `setLabels`. For example:
```php
use YusrilHs\ChartJsHelper\ChartJsHelper;

$chart = ChartJsHelper::createChart('line');
$chart->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
```
#### Options
To add options for your chart just add `setOptions`. For example:
```php
use YusrilHs\ChartJsHelper\ChartJsHelper;

$chart = ChartJsHelper::createChart('line');
// Set labels
$chart->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
// Set Options
$chart->setOptions(array(
    'responsive'=>true,
    'title' => array(
        'display' => true,
        'text' => 'ChartjsHelper'
     ),
));
```
#### Datasets
Dataset is designed with key and value pair but you can use blank string on value, for create dataset you can use `createDataset(id, label)`. And for reuse dataset you can use `dataset(id)` of course that will thrown an exception if id is not defined. See this example:
```php
use YusrilHs\ChartJsHelper\ChartJsHelper;

$chart = ChartJsHelper::createChart('line');
$chart->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
// create dataset
$visitor2017 = $chart->createDataset('visitor_2017', '2017');
// get dataset
$dataset = $chart->dataset('visitor_2017');
// This will throw an exception
$dataset = $chart->dataset('any_visitor');
// Or you want check is dataset exists?
$dataset = ($chart->hasDataset('any_visitor')) ?
                $chart->dataset('any_visitor') :
                $chart->createDataset('any_visitor', 'Any Visitor');  
```
Dataset is come with manual setup properties. For example:
```php
$dataset = $chart->createDataset('2017','2017');
// Set properties of dataset
$dataset->setProperties(array(
    'backgroundColor'=> 'rgba(237,35,73,.6)',
    'borderColor'=> 'rgba(237,35,73,.8)'
));
// If you want add only one properties
$dataset->setProperty('backgroundColor', 'rgba(237,35,73,.6)');
```
For setup data on dataset, we designed it for reusable. For example:
```php
$dataset = $chart->createDataset('2017','2017');
// Setup data datasets
// This must be a sequence array
$dataset->setData(array(10, 20, 5, 2, 3, 4));

// For update data on datasets
// First argument is index of data and second 
// argument is value of data
$dataset->setData(0, 30);

// if data with that index is not defined
// Then that will throw an exception
try {
    $dataset->setData(30, 1);
} catch(InvalidArgumentException $e) {
    // Something with an errors
}

// You want add more data?
$dataset->appendData(10); // Data will be: [30, 20, 5, 2, 3, 4, 10]
```
#### Fill Zero
Fill Zero will fill data on dataset with zero value. Data will have the same amount as chart labels. For example:
```php
use YusrilHs\ChartJsHelper\ChartJsHelper;

$chart = ChartJsHelper::createChart('line');
// Set labels of chart
$chart->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
// Activate fill zero
$chart->useFillZero();
// create dataset
$visitor2017 = $chart->createDataset('visitor_2017', '2017');
// Data will be: array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
var_dump($visitor2017->getData());
```
#### Rainbow Color
If you are feeling lazy for coloring dataset. We come with automatic coloring feature. Just add `useRainbowColor` see [here](https://github.com/yusrilhs/ChartJsPhpHelper/tree/master/example). For example:
```php
$chart = ChartJsHelper::createChart('line');
// Activate rainbow color
$chart->useRainbowColor();
```
#### How to include into javascript?
This library is just a helper for generating Chart.js using php. You can generate the chart configuration using `getConfig`. For example
```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bar Chart Example</title>
</head>
<body>
    <canvas id="chart"></canvas>
    <script type="text/javascript" src="assets/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            var ctx = document.getElementById("chart").getContext("2d");
            // Include chart config into javascript
            var config = <?= json_encode($chart->getConfig()); ?>;
            
            window.barChart = new Chart(ctx, config);
        };
    </script>
 </body>
</html>
```
### License
ChartJsPhpHelper is licensed under the [MIT License](http://opensource.org/licenses/MIT)
