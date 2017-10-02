<?php 
namespace YusrilHs\ChartJsHelper\ChartType;

use YusrilHs\ChartJsHelper\AbstractChartType;
use InvalidArgumentException;

class LineChart extends AbstractChartType {
    /**
     * Type of chart
     * @var string
     */
    protected $chartType = 'line';

    /**
     * Generate chart configuration
     * @return array
     */
    public function generate() {
        
    }
}
