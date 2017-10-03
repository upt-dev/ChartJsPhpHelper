<?php 

use YusrilHs\ChartJsHelper\ChartJsHelper;

class ChartJsHelperTest extends PHPUnit_Framework_TestCase {

    public function testCreateChart() {
        $barChart = ChartjsHelper::createChart('bar');
        $doughnutChart = ChartjsHelper::createChart('doughnut');
        $lineChart = ChartjsHelper::createChart('line');
        $mixedChart = ChartjsHelper::createChart('mixed');
        $pieChart = ChartjsHelper::createChart('pie');
        $polarChart = ChartjsHelper::createChart('polarArea');
        $radarChart = ChartjsHelper::createChart('radar');

        // Test instance of each chart
        $this->assertInstanceOf('YusrilHs\\ChartjsHelper\\ChartJsLib', $barChart);
        $this->assertInstanceOf('YusrilHs\\ChartjsHelper\\ChartJsLib', $doughnutChart);
        $this->assertInstanceOf('YusrilHs\\ChartjsHelper\\ChartJsLib', $lineChart);
        $this->assertInstanceOf('YusrilHs\\ChartjsHelper\\ChartJsLib', $mixedChart);
        $this->assertInstanceOf('YusrilHs\\ChartjsHelper\\ChartJsLib', $pieChart);
        $this->assertInstanceOf('YusrilHs\\ChartjsHelper\\ChartJsLib', $polarChart);
        $this->assertInstanceOf('YusrilHs\\ChartjsHelper\\ChartJsLib', $radarChart);

        $this->expectException('InvalidArgumentException');
        $invalidChart = ChartjsHelper::createChart('invalid chart');
    }
    
}
