<?php 

use YusrilHs\ChartJsHelper\ChartType\DoughnutChart;

class DoughnutChartTest extends PHPUnit_Framework_TestCase {

    public function testTypeOfChart() {
        $doughnutChart = new DoughnutChart();

        // Test Type of chart
        $this->assertEquals('doughnut', $doughnutChart->getType());
    }

}
