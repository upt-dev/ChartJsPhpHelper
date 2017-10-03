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
$chart = ChartJsHelper::createChart('bar');
$chart2 = ChartJsHelper::createChart('bar');
$chart->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
$chart2->setLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December'));
$chart->useFillZero();
$chart2->useFillZero();
$chart2->useRainbowColor();

foreach ($sampleData as $data) {
    $dataset = $chart->hasDataset($data['year']) ?
                    $chart->dataset($data['year']) :
                    $chart->createDataset($data['year'], $data['year']);
    $dataset->setData($data['month'] - 1, $data['value']);
}

foreach ($sampleData as $data) {
    $dataset = $chart2->hasDataset($data['year']) ?
                    $chart2->dataset($data['year']) :
                    $chart2->createDataset($data['year'], $data['year']);
    $dataset->setData($data['month'] - 1, $data['value']);
}

foreach ($colorMap as $key => $value) {
    $chart->dataset($key)->setProperties($value);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bar Chart Example</title>
</head>
<body>
    <canvas id="chart"></canvas>
    <canvas id="chart2"></canvas>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            var ctx = document.getElementById("chart").getContext("2d");
            var ctx2 = document.getElementById("chart2").getContext("2d");
            var config = <?= json_encode($chart->getConfig()); ?>;
            var config2 = <?= json_encode($chart2->getConfig()); ?>;
            var options = {
                responsive: true,
                title:{
                    display:true,
                    text:'Chart.js Bar Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            };
            config.options = options;
            config2.options = options;
            window.bar1 = new Chart(ctx, config);
            window.bar2 = new Chart(ctx2, config2);
        };
    </script>
</body>
</html>
