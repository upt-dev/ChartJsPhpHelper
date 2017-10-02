<?php 
namespace YusrilHs\ChartJsHelper\ChartType;

use YusrilHs\ChartJsHelper\AbstractChartType;
use InvalidArgumentException;

class BarChart extends AbstractChartType {
    /**
     * Type of chart
     * @var string
     */
    protected $chartType = 'bar';

    /**
     * Generate chart configuration
     * @return array
     */
    public function generate() {
        
    }
}
