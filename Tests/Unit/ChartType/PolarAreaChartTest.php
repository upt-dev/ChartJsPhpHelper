<?php 

use YusrilHs\ChartJsHelper\ChartType\PolarAreaChart;

class PolarAreaChartTest extends PHPUnit_Framework_TestCase {

    public function testTypeOfChart() {
        $polarAreaChart = new PolarAreaChart();

        // Test Type of chart
        $this->assertEquals('polarArea', $polarAreaChart->getType());
    }

}
