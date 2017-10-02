<?php 

use YusrilHs\ChartJsHelper\ChartType\BarChart;

class BarChartTest extends PHPUnit_Framework_TestCase {

    public function testTypeOfChart() {
        $barChart = new BarChart();

        // Test Type of chart
        $this->assertEquals('bar', $barChart->getType());
    }
    
}
