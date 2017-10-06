<?php 
$sampleData = array(
    'Like'=> rand(20, 100),
    'Hate'=> rand(20, 100),
    'Simple'=> rand(20, 100)
);
$colorMap = array(
    'Like'=> 'rgba(237,35,73,.6)',
    'Hate'=> 'rgba(56,140,203,.6)',
    'Simple'=> 'rgba(82,203,56,.6)'
);

require '../vendor/autoload.php';
use YusrilHs\ChartJsHelper\ChartJsHelper;
$chart = ChartJsHelper::createChart('doughnut_1', 'doughnut');
$chart2 = ChartJsHelper::createChart('doughnut_2', 'doughnut');
$chart->setLabels(array('Like', 'Hate', 'Simple'));
$chart2->setLabels(array('Like','Hate','Simple'));
$chart->useFillZero();
$chart2->useFillZero();
$chart2->useRainbowColor();

$dataset = $chart->createDataset('vote', 'vote');
$dataset2 = $chart2->createDataset('vote', 'vote');
$dataset->setData(array_values($sampleData));
$dataset2->setData(array_values($sampleData));
$dataset->setProperties(array('backgroundColor'=> array_values($colorMap)));
$chart->setElementId('chart');
$chart2->setElementId('chart2');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Doughnut Chart Example</title>
</head>
<body>
    <canvas id="chart"></canvas>
    <canvas id="chart2"></canvas>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <?= ChartJsHelper::createScriptTag(); ?>
</body>
</html>
