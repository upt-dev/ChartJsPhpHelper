<?php 
$sampleData = array(
    array(
        'group' => 'Student',
        'x'=> rand(-100, 150),
        'y'=> rand(-100, 150),
        'r'=> rand(10, 50)
    ),
    array(
        'group' => 'Student',
        'x'=> rand(-100, 150),
        'y'=> rand(-100, 150),
        'r'=> rand(10, 50)
    ),
    array(
        'group' => 'Student',
        'x'=> rand(-100, 150),
        'y'=> rand(-100, 150),
        'r'=> rand(10, 50)
    ),
    array(
        'group' => 'Teacher',
        'x'=> rand(-100, 150),
        'y'=> rand(-100, 150),
        'r'=> rand(10, 50)
    ),
    array(
        'group' => 'Teacher',
        'x'=> rand(-100, 150),
        'y'=> rand(-100, 150),
        'r'=> rand(10, 50)
    ),
    array(
        'group' => 'Teacher',
        'x'=> rand(-100, 150),
        'y'=> rand(-100, 150),
        'r'=> rand(10, 50)
    ),
);
$colorMap = array(
    'Student'=> array(
                    'backgroundColor'=> 'rgba(237,35,73,.6)',
                    'borderColor'=> 'rgba(237,35,73,.8)'
                ),
    'Teacher'=> array(
                    'backgroundColor'=> 'rgba(56,140,203,.6)',
                    'borderColor'=> 'rgba(56,140,203,.8)',
                )
);

require '../vendor/autoload.php';
use YusrilHs\ChartJsHelper\ChartJsHelper;
$chart = ChartJsHelper::createChart('bubble_1', 'bubble');
$chart2 = ChartJsHelper::createChart('bubble_2', 'bubble');
$chart2->useRainbowColor();

foreach ($sampleData as $data) {
    $dataset = $chart->hasDataset($data['group']) ?
                    $chart->dataset($data['group']) :
                    $chart->createDataset($data['group'], $data['group']);
    $dataset->appendData(array(
        'x'=>$data['x'],
        'y'=>$data['y'],
        'r'=>$data['r']
    ));
}

foreach ($sampleData as $data) {
    $dataset = $chart2->hasDataset($data['group']) ?
                    $chart2->dataset($data['group']) :
                    $chart2->createDataset($data['group'], $data['group']);
    $dataset->appendData(array(
        'x'=>$data['x'],
        'y'=>$data['y'],
        'r'=>$data['r']
    ));
}

foreach ($colorMap as $key => $value) {
    $chart->dataset($key)->setProperties($value);
}

$chart->setElementId('chart');
$chart2->setElementId('chart2');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bubble Chart Example</title>
</head>
<body>
    <canvas id="chart"></canvas>
    <canvas id="chart2"></canvas>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
   <?= ChartJsHelper::createScriptTag(); ?>
</body>
</html>
