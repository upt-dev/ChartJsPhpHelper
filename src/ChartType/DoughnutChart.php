<?php 
namespace YusrilHs\ChartJsHelper\ChartType;

use YusrilHs\ChartJsHelper\AbstractChartType;
use InvalidArgumentException;

class DoughnutChart extends AbstractChartType {
    /**
     * Type of chart
     * @var string
     */
    protected $chartType = 'doughnut';

    /**
     * Generate chart configuration
     * @return array
     */
    public function generate() {
        
    }
}
