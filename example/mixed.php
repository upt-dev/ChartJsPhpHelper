<?php 
$sampleData = array(
    array(
        'year'=> 2017,
        'month'=> 1,
        'value'=> rand(0, 50)
    ),
    array(
        'year'=> 2017,
        'month'=> 2,
        'value'=> rand(0, 50)
    ),
    array(
        'year'=> 2017,
        'month'=> 4,
        'value'=> rand(0, 50)
    ),
    array(
        'year'=> 2018,
        'month'=> 6,
        'value'=> rand(0, 50)
    ),
    array(
        'year'=> 2018,
        'month'=> 5,
        'value'=> rand(0, 50)
    ),
    array(
        'year'=> 2018,
        'month'=> 1,
        'value'=> rand(0, 50)
    ),
    array(
        'year'=> 2018,
        'month'=> 11,
        'value'=> rand(0, 50)
    )
);
$colorMap = array(
    '2017'=> array(
                    'backgroundColor'=> 'rgba(237,35,73,.6)',
                    'borderColor'=> 'rgba(237,35,73,.8)'
                ),
    '2018'=> array(
                    'backgroundColor'=> 'rgba(56,140,203,.6)',
                    'borderColor'=> 'rgba(56,140,203,.8)',
                )
);

require '../vendor/autoload.php';
use YusrilHs\ChartJsHelper\ChartJsHelper;
$chart = ChartJsHelper::createChart('mixed_1', 'bar');
$chart2 = ChartJsHelper::createChart('mixed_2','bar');
$chart->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
$chart2->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
$chart->useFillZero();
$chart2->useFillZero();
$chart2->useRainbowColor();

foreach ($sampleData as $data) {
    $dataset = $chart->hasDataset($data['year']) ?
                    $chart->dataset($data['year']) :
                    $chart->createDataset($data['year'], $data['year']);
    $dataset->setProperty('type', $data['year'] == 2018 ? 'line' : 'bar');
    $dataset->setProperty('fill', $data['year'] != 2018);
    $dataset->setData($data['month'] - 1, $data['value']);
}

foreach ($sampleData as $data) {
    $dataset = $chart2->hasDataset($data['year']) ?
                    $chart2->dataset($data['year']) :
                    $chart2->createDataset($data['year'], $data['year']);
    
    $dataset->setProperty('type', $data['year'] == 2018 ? 'line' : 'bar');
    $dataset->setProperty('fill', $data['year'] != 2018);
    $dataset->setData($data['month'] - 1, $data['value']);
}

foreach ($colorMap as $key => $value) {
    foreach ($value as $k => $v) {
        $chart->dataset($key)->setProperty($k, $v);
    }
}
$chart->setElementId('chart');
$chart2->setElementId('chart2');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mixed Chart Example</title>
</head>
<body>
    <canvas id="chart"></canvas>
    <canvas id="chart2"></canvas>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <?= ChartJsHelper::createScriptTag(); ?>
</body>
</html>
