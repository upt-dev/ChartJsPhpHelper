<?php 

use YusrilHs\ChartJsHelper\ChartType\RadarChart;

class RadarChartTest extends PHPUnit_Framework_TestCase {

    public function testTypeOfChart() {
        $radarChart = new RadarChart();

        // Test Type of chart
        $this->assertEquals('radar', $radarChart->getType());
    }

}
