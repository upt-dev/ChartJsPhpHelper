<?php 

use YusrilHs\ChartJsHelper\ChartType\LineChart;

class LineChartTest extends PHPUnit_Framework_TestCase {

    public function testTypeOfChart() {
        $lineChart = new LineChart();

        // Test Type of chart
        $this->assertEquals('line', $lineChart->getType());
    }

}
