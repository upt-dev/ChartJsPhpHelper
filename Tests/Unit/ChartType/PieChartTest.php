<?php 

use YusrilHs\ChartJsHelper\ChartType\PieChart;

class PieChartTest extends PHPUnit_Framework_TestCase {

    public function testTypeOfChart() {
        $pieChart = new PieChart();

        // Test Type of chart
        $this->assertEquals('pie', $pieChart->getType());
    }

}
