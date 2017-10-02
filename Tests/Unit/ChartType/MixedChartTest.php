<?php 

use YusrilHs\ChartJsHelper\ChartType\MixedChart;

class MixedChartTest extends PHPUnit_Framework_TestCase {

    public function testTypeOfChart() {
        $mixedChart = new MixedChart();

        // Test Type of chart
        $this->assertEquals('', $mixedChart->getType());
        $mixedChart->setType('bar');
        $this->assertEquals('bar', $mixedChart->getType());
    }
}
