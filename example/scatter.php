<?php 
$sampleData = array(
    array(
		'x'=>1,
		'y'=>-1.711e-2
	), array(
		'x'=>1.26,
		'y'=>-2.708e-2
	), array(
		'x'=>1.58,
		'y'=>-4.285e-2
	), array(
		'x'=>2.0,
		'y'=>-6.772e-2
	), array(
		'x'=>2.51,
		'y'=>-1.068e-1
	), array(
		'x'=>3.16,
		'y'=>-1.681e-1
	), array(
		'x'=>3.98,
		'y'=>-2.635e-1
	), array(
		'x'=>5.01,
		'y'=>-4.106e-1
	), array(
		'x'=>6.31,
		'y'=>-6.339e-1
	), array(
		'x'=>7.94,
		'y'=>-9.659e-1
	), array(
		'x'=>10.00,
		'y'=>-1.445
	), array(
		'x'=>12.6,
		'y'=>-2.110
	), array(
		'x'=>15.8,
		'y'=>-2.992
	), array(
		'x'=>20.0,
		'y'=>-4.102
	), array(
		'x'=>25.1,
		'y'=>-5.429
	), array(
		'x'=>31.6,
		'y'=>-6.944
	), array(
		'x'=>39.8,
		'y'=>-8.607
	), array(
		'x'=>50.1,
		'y'=>-1.038e1
	), array(
		'x'=>63.1,
		'y'=>-1.223e1
	), array(
		'x'=>79.4,
		'y'=>-1.413e1
	), array(
		'x'=>100.00,
		'y'=>-1.607e1
	), array(
		'x'=>126,
		'y'=>-1.803e1
	), array(
		'x'=>158,
		'y'=>-2e1
	), array(
		'x'=>200,
		'y'=>-2.199e1
	), array(
		'x'=>251,
		'y'=>-2.398e1
	), array(
		'x'=>316,
		'y'=>-2.597e1
	), array(
		'x'=>398,
		'y'=>-2.797e1
	), array(
		'x'=>501,
		'y'=>-2.996e1
	), array(
		'x'=>631,
		'y'=>-3.196e1
	), array(
		'x'=>794,
		'y'=>-3.396e1
	), array(
		'x'=>1000,
		'y'=>-3.596e1
	)
);

require '../vendor/autoload.php';
use YusrilHs\ChartJsHelper\ChartJsHelper;
$chart = ChartJsHelper::createChart('scatter');
$chart2 = ChartJsHelper::createChart('scatter');
$chart->useFillZero();
$chart2->useFillZero();
$chart2->useRainbowColor();

$dataset = $chart->createDataset('voltage', 'V(node2)');
$dataset->setProperty('backgroundColor', 'rgba(56,140,203,.6)');
$dataset->setData($sampleData);

$dataset2 = $chart2->createDataset('voltage', 'V(node2)');
$dataset2->setData($sampleData);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Scatter Chart Example</title>
</head>
<body>
    <canvas id="chart"></canvas>
    <canvas id="chart2"></canvas>
    <script type="text/javascript" src="assets/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            var ctx = document.getElementById("chart").getContext("2d");
            var ctx2 = document.getElementById("chart2").getContext("2d");
            var config = <?= json_encode($chart->getConfig()); ?>;
            var config2 = <?= json_encode($chart2->getConfig()); ?>;
            var options = {
                title: {
                    display: true,
                    text: 'Chart.js Scatter Chart - Logarithmic X-Axis'
                },
                scales: {
                    xAxes: [{
                        type: 'logarithmic',
                        position: 'bottom',
                        ticks: {
                            userCallback: function(tick) {
                                var remain = tick / (Math.pow(10, Math.floor(Chart.helpers.log10(tick))));
                                if (remain === 1 || remain === 2 || remain === 5) {
                                    return tick.toString() + "Hz";
                                }
                                return '';
                            },
                        },
                        scaleLabel: {
                            labelString: 'Frequency',
                            display: true,
                        }
                    }],
                    yAxes: [{
                        type: 'linear',
                        ticks: {
                            userCallback: function(tick) {
                                return tick.toString() + "dB";
                            }
                        },
                        scaleLabel: {
                            labelString: 'Voltage',
                            display: true
                        }
                    }]
                }
            };
            config.options = options;
            config2.options = options;
            window.scatter1 = new Chart(ctx, config);
            window.scatter2 = new Chart(ctx2, config2);
        };
    </script>
</body>
</html>
